<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 21/05/15
 * Time: 11:17
 */
namespace Althingi\Service;

use PDOException;
use GuzzleHttp;
use Althingi\Lib\DataSourceAwareInterface;
define("DATASOURCE", "http://www.althingi.is/altext/xml/");
define("ASSEMBLY", "loggjafarthing/");



class XMLFeed implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Function that knows the order of how to fetch the newest information from althingi.
   */
  public function bootstrapAssemblies(){
    $this->processAssemblies();
  }

  /**
   * Loops through all assemblies, fetched with getAssemblies(), checks to see if we have it in the database,
   * and if we do, updates the information.
   *
   * If it's not in the database, it creates new entry
   */
  public function processAssemblies(){
    $assembliesObject = $this->getAssemblies();
    $assemblyService = new Assembly();
    $assemblyService->setDataSource($this->pdo);
    foreach($assembliesObject->þing as $assemblies){
      $data = array();
      foreach($assemblies as $assembly){
        $data['id'] = $assembly->númer;
        break;
      }
      $assemblyInDatabase = $assemblyService->get($data['id']);
      if($assemblyInDatabase){
        $data['from'] = strftime('%Y-%m-%d', strtotime($assemblies->þingsetning));
        $data['to'] = (isset($assemblies->þinglok))
          ? strftime('%Y-%m-%d', strtotime($assemblies->þinglok))
          : null;
        $data['period'] = $assemblies->tímabil;

        $assemblyService->update($data['id'], $data);
      }
      else{
        $data['from'] = strftime('%Y-%m-%d', strtotime($assemblies->þingsetning));
        $data['to'] = (isset($assemblies->þinglok))
          ? strftime('%Y-%m-%d', strtotime($assemblies->þinglok))
          : null;
        $data['period'] = $assemblies->tímabil;

        $assemblyService->create($data);
      }
    }
  }

  /**
   * Fetches all assemblies from Althingi XML data service.
   *
   * @return array of stdClass
   */
  public function getAssemblies(){
    $client = new GuzzleHttp\Client();
    $res = $client->get("http://www.althingi.is/altext/xml/loggjafarthing");
    $body = simplexml_load_string($res->getBody()->getContents());
    $obj = json_decode(json_encode($body));
    return $obj;
  }

  public function processAssemblyIssues($assemblyId){
    $issuesObject = $this->getFromXml("http://www.althingi.is/altext/xml/thingmalalisti/?lthing=" . $assemblyId);
    $issueService = new Issue();
    $issueService->setDataSource($this->pdo);
    foreach($issuesObject->mál as $issueOverview){
      $a = 10;


    }
  }

  public function processAssemblyPersons($assemblyId){
    $personsObject = $this->getAssemblyPersonsFromXml($assemblyId);
    $personService = new Person();
    $personService->setDataSource($this->pdo);
    foreach($personsObject->þingmaður as $persons){
      $idPerson = $persons->{'@attributes'}->id;
      $this->processPerson($persons);
      $assemblySeats = $this->getFromXml($persons->xml->þingseta);
      $this->processAssemblySeatsForPerson($assemblySeats);
      $cv = $this->getFromXml($persons->xml->lífshlaup);
      $this->processCvForPerson($cv);
      $interests = $this->getFromXml($persons->xml->hagsmunir);
      if(isset($interests->hagsmunaskráning->launuðstjórnarseta)){
        $this->processInterestsForPerson($idPerson, $interests->hagsmunaskráning);
      }
      $committies = $this->getFromXml($persons->xml->nefndaseta);
      if(isset($committies->nefndasetur->nefndaseta)){
        $this->processCommittiesForPerson($committies);
      }
    }
  }

  public function processPerson($person){
    $personService = new Person();
    $personService->setDataSource($this->pdo);
    $personFromDatabase = $personService->get($person->{'@attributes'}->id);

    $data['id'] = $person->{'@attributes'}->id;
    $data['name'] = $person->nafn;
    $data['abbr'] = (isset($person->skammstöfun)) ? $person->skammstöfun : null;
    $data['dob'] = (isset($person->fæðingardagur)) ? strftime('%Y-%m-%d', strtotime($person->fæðingardagur)) : null;
    $data['website'] = (isset($person->vefur)) ? $person->vefur : null;
    $data['facebook'] = (isset($person->vefur)) ? $person->facebook : null;
    $data['twitter'] = (isset($person->vefur)) ? $person->twitter : null;
    $data['blogg'] = (isset($person->vefur)) ? $person->blogg : null;

    if(!$personFromDatabase){
      $personService->create($data);
    }
    else{
      $personService->update($person->{'@attributes'}->id, $data);
    }
  }

  /**
   * Takes the CV from the datastream, clears the data and stores it in the database.
   *
   * @param $cv
   */
  public function processCvForPerson($cv){
    $cvService = new Cv();
    $cvService->setDataSource($this->pdo);
    $dataFromDatabase = $cvService->get($cv->{'@attributes'}->id);

    $data = array();
    $data['person_id'] = $cv->{'@attributes'}->id;
    $data['family'] = (is_string($cv->lífshlaup->fjölskylda)) ? $cv->lífshlaup->fjölskylda : null;
    $data['education'] = (is_string($cv->lífshlaup->menntun)) ? $cv->lífshlaup->menntun : null;
    $data['career'] = (is_string($cv->lífshlaup->starfsferill)) ? $cv->lífshlaup->starfsferill : null;
    $data['social'] = (is_string($cv->lífshlaup->félagsmál)) ? $cv->lífshlaup->félagsmál : null;
    $data['parliamentary'] = (is_string($cv->lífshlaup->þingmennska)) ? $cv->lífshlaup->þingmennska : null;
    $data['substitute'] = (is_string($cv->lífshlaup->varaþingmennska)) ? $cv->lífshlaup->varaþingmennska : null;
    $data['minister'] = (is_string($cv->lífshlaup->ráðherra)) ? $cv->lífshlaup->fjölskylda : null;
    $data['speaker'] = (is_string($cv->lífshlaup->þingforseti)) ? $cv->lífshlaup->þingforseti : null;
    $data['presidency'] = (is_string($cv->lífshlaup->þingflokksformennska)) ? $cv->lífshlaup->þingflokksformennska : null;
    $data['committee'] = (is_string($cv->lífshlaup->nefndaseta)) ? $cv->lífshlaup->nefndaseta : null;
    $data['international_committee'] = (is_string($cv->lífshlaup->alþjóðanefndaseta)) ? $cv->lífshlaup->alþjóðanefndaseta : null;
    $data['writing'] = (is_string($cv->lífshlaup->ritstörf)) ? $cv->lífshlaup->ritstörf : null;
    $data['editor'] = (is_string($cv->lífshlaup->ritstjórn)) ? $cv->lífshlaup->ritstjórn : null;
    $data['hash'] = null;

    if($dataFromDatabase){
      $cvService->update($cv->{'@attributes'}->id, $data);
    }
    else{
      $cvService->create($data);
    }
  }

  public function processInterestsForPerson($idPerson, $interests){
    $interestsService = new Interests();
    $interestsService->setDataSource($this->pdo);
    $dataFromDatabase = $interestsService->get($idPerson);

    $data = array();
    $data['person_id'] = $idPerson;
    if(isset($interests->launuðstjórnarseta)){
      if(isset($interests->launuðstjórnarseta->svar)){
        if(is_string($interests->launuðstjórnarseta->svar)){
          $data['salariedBoard'] = $interests->launuðstjórnarseta->svar;
        }

      }
      else{
        $data['salariedBoard'] = null;
      }
    }
    if(isset($interests->launaðstarf)){
      if(isset($interests->launaðstarf->svar)){
        if(is_string($interests->launaðstarf->svar)){
          $data['paidEmployment'] = $interests->launaðstarf->svar;
        }
      }
      else{
        $data['paidEmployment'] = null;
      }
    }
    if(isset($interests->tekjumyndandistarfsemi)){
      if(isset($interests->tekjumyndandistarfsemi->svar)){
        if(is_string($interests->tekjumyndandistarfsemi->svar)){
          $data['incomeGeneratingActivities'] = $interests->tekjumyndandistarfsemi->svar;
        }
      }
      else{
        $data['incomeGeneratingActivities'] = null;
      }
    }
    if(isset($interests->fjárhagslegurstuðningur)){
      if(isset($interests->fjárhagslegurstuðningur->svar)){
        if(is_string($interests->fjárhagslegurstuðningur->svar)){
          $data['financialSupport'] = $interests->fjárhagslegurstuðningur->svar;
        }
      }
      else{
        $data['financialSupport'] = null;
      }
    }
    if(isset($interests->gjafir)){
      if(isset($interests->gjafir->svar)){
        if(is_string($interests->gjafir->svar)){
          $data['gifts'] = $interests->gjafir->svar;
        }
      }
      else{
        $data['gifts'] = null;
      }
    }
    if(isset($interests->ferðir)){
      if(isset($interests->ferðir->svar)){
        if(is_string($interests->ferðir->svar)){
          $data['trips'] = $interests->ferðir->svar;
        }
      }
      else{
        $data['trips'] = null;
      }
    }
    if(isset($interests->eftirgjöfskulda)){
      if(isset($interests->eftirgjöfskulda->svar)){
        if(is_string($interests->eftirgjöfskulda->svar)){
          $data['debtReduction'] = $interests->eftirgjöfskulda->svar;
        }
      }
      else{
        $data['debtReduction'] = null;
      }
    }
    if(isset($interests->fasteignir)){
      if(isset($interests->fasteignir->svar)){
        if(is_string($interests->fasteignir->svar)){
          $data['realEstate'] = $interests->fasteignir->svar;
        }
      }
      else{
        $data['realEstate'] = null;
      }
    }
    if(isset($interests->eignir)){
      if(isset($interests->eignir->svar)){
        if(is_string($interests->eignir->svar)){
          $data['assets'] = $interests->eignir->svar;
        }
      }
      else{
        $data['assets'] = null;
      }
    }
    if(isset($interests->fyrrverandivinnuveitandi)){
      if(isset($interests->fyrrverandivinnuveitandi->svar)){
        if(is_string($interests->fyrrverandivinnuveitandi->svar)){
          $data['formerEmployer'] = $interests->fyrrverandivinnuveitandi->svar;
        }
      }
      else{
        $data['formerEmployer'] = null;
      }
    }
    if(isset($interests->framtíðarvinnuveitandi)){
      if(isset($interests->framtíðarvinnuveitandi->svar)){
        if(is_string($interests->framtíðarvinnuveitandi->svar)){
          $data['futureEmployer'] = $interests->framtíðarvinnuveitandi->svar;
        }
      }
      else{
        $data['futureEmployer'] = null;
      }
    }
    if(isset($interests->trúnaðarstörf)){
      if(isset($interests->trúnaðarstörf->svar)){
        if(is_string($interests->trúnaðarstörf->svar)){
          $data['trust'] = $interests->trúnaðarstörf->svar;
        }
      }
      else{
        $data['trust'] = null;
      }
    }
    if(isset($interests->skráð)){
      $data['logged'] = strftime('%Y-%m-%d', strtotime($interests->skráð));
    }

    if($dataFromDatabase){
      $interestsService->update($idPerson, $data);
    }
    else{
      $interestsService->create($data);
    }
  }

  public function processCommittiesForPerson($commitees){
    $commiteePersonService = new CommiteePerson();
    $commiteePersonService->setDataSource($this->pdo);
    $commiteeService = new Commitee();
    $commiteeService->setDataSource($this->pdo);

    //Get commiteeService in order to find the commitee
    foreach($commitees->nefndasetur->nefndaseta as $commitee){
      $commiteeFromDatabase = $commiteeService->getByName($commitee->nefnd);
      $dataFromDatabase = $commiteePersonService->getWithDetailedInfo(
        $commiteeFromDatabase->id,
        $commitees->{"@attributes"}->id,
        $commitee->staða,
        strftime('%Y-%m-%d', strtotime($commitee->tímabil->inn)),
        $commitee->þing
      );

      $data = array();
      $data['commitee_id'] = $commiteeFromDatabase->id;
      $data['person_id'] = $commitees->{"@attributes"}->id;
      $data['title'] = $commitee->staða;
      $data['row'] = $commitee->röð;
      $data['from'] = strftime('%Y-%m-%d', strtotime($commitee->tímabil->inn));
      $data['to'] = (isset($commitee->tímabil->út))
        ? strftime('%Y-%m-%d', strtotime($commitee->tímabil->út))
        : null;
      $data['assembly_id'] = $commitee->þing;
      $data['party'] = null;

      if($dataFromDatabase){
        $commiteePersonService->update($data);
      }
      else{
        $commiteePersonService->create($data);
      }
    }

  }

  /**
   * Takes all Assembly seats for one person and checks if it's in the database.
   * If it is, it updates the info, if not, then it creates the info
   *
   * @param $object
   * @throws \Althingi\Service\Exception
   */
  public function processAssemblySeatsForPerson($object){
    $assemblyPersonService = new AssemblyPerson();
    $assemblyPersonService->setDataSource($this->pdo);
    $partyService = new Party();
    $partyService->setDataSource($this->pdo);

    if(is_array($object->þingsetur->þingseta)){
      foreach($object->þingsetur->þingseta as $assembly_attendance) {
        $dataFromDatabase = $assemblyPersonService->getWithDetailedInfo(
          $assembly_attendance->þing,
          $object->{'@attributes'}->id,
          strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->inn)),
          (is_string($assembly_attendance->tímabil->út))
            ? strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->út))
            : null
        );

        $partyFromDatabase = $partyService->getByName($assembly_attendance->þingflokkur);

        //Create a data array with values from XML
        $data['assembly_id'] = $assembly_attendance->þing;
        $data['person_id'] = $object->{'@attributes'}->id;
        $data['abbr'] = $assembly_attendance->skammstöfun;
        $data['type'] = $assembly_attendance->tegund;
        if(isset($assembly_attendance->deild)){
          $data['department'] = $assembly_attendance->deild;
        }
        if (isset($assembly_attendance->kjördæmi->{'@attributes'})) {
          $data['constituency_id'] = $assembly_attendance->kjördæmi->{'@attributes'}->id;
        }
        elseif (!is_object($assembly_attendance->kjördæmi)) {
          $data['constituency'] = $assembly_attendance->kjördæmi;
        }

        $data['constituency_number'] = $assembly_attendance->kjördæmanúmer;
        if(is_string($assembly_attendance->þingsalssæti)){
          $data['seat'] = $assembly_attendance->þingsalssæti;
        }

        $data['from'] = strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->inn));
        (is_string($assembly_attendance->tímabil->út))
          ? strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->út))
          : null;

        if(!$partyFromDatabase){
          $partyData = array();
          $partyData['name'] = $assembly_attendance->þingflokkur;
          $partyService->create($partyData);
        }
        $data['party'] = $assembly_attendance->þingflokkur;


        if (!$dataFromDatabase) {
          $assemblyPersonService->create($data);
        }
        else {
          $assemblyPersonService->update($dataFromDatabase->id, $data);
        }
      }
    }
    else{
      $assembly_attendance = $object->þingsetur->þingseta;
      $dataFromDatabase = $assemblyPersonService->getWithDetailedInfo(
        $assembly_attendance->þing,
        $object->{'@attributes'}->id,
        strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->inn)),
        (is_string($assembly_attendance->tímabil->út))
          ? strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->út))
          : null
      );
      //Create a data array with values from XML
      $data['assembly_id'] = $assembly_attendance->þing;
      $data['person_id'] = $object->{'@attributes'}->id;
      $data['abbr'] = $assembly_attendance->skammstöfun;
      $data['type'] = $assembly_attendance->tegund;
      if (isset($assembly_attendance->kjördæmi->{'@attributes'})) {
        $data['constituency_id'] = $assembly_attendance->kjördæmi->{'@attributes'}->id;
      }
      elseif (!is_object($assembly_attendance->kjördæmi)) {
        $data['constituency'] = $assembly_attendance->kjördæmi;
      }

      $data['constituency_number'] = $assembly_attendance->kjördæmanúmer;
      $data['seat'] = $assembly_attendance->þingsalssæti;
      $data['from'] = strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->inn));
      (is_string($assembly_attendance->tímabil->út))
        ? strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->út))
        : null;
      $data['party'] = $assembly_attendance->þingflokkur;

      if (!$dataFromDatabase) {
        $assemblyPersonService->create($data);
      }
      else {
        $assemblyPersonService->update($dataFromDatabase->id, $data);
      }
    }
  }

  /**
   * Fetches all commitees from selected Assembly and process it into the database
   *
   * @param $id_assembly
   * @throws \Althingi\Service\Exception
   */
  public function processCommitees($id_assembly){
    $string = "http://www.althingi.is/altext/xml/nefndir/?lthing=" . $id_assembly;
    $obj = $this->getFromXml($string);

    $commiteeService = new Commitee();
    $commiteeService->setDataSource($this->pdo);
    if( isset($obj->nefnd)){
      if(is_array($obj->nefnd)){
        foreach( $obj->nefnd as $item ){
          $dataFromDatabase = $commiteeService->get($item->{'@attributes'}->id);

          $data = array();
          $data['id'] = $item->{'@attributes'}->id;
          $data['name'] = $item->heiti;
          $data['short_abbr'] = $item->skammstafanir->stuttskammstöfun;
          $data['long_abbr'] = $item->skammstafanir->löngskammstöfun;
          $data['first_assembly'] = $item->tímabil->fyrstaþing;
          if(isset($item->tímabil->síðastaþing)){
            $data['last_assembly'] = $item->tímabil->síðastaþing;
          }

          if($dataFromDatabase){
            $commiteeService->update($item->{'@attributes'}->id, $data);
          }
          else{
            $commiteeService->create($data);
          }
        }
      }
      else{
        $item = $obj->nefnd;
        $dataFromDatabase = $commiteeService->get($item->{'@attributes'}->id);

        $data = array();
        $data['id'] = $item->{'@attributes'}->id;
        $data['name'] = $item->heiti;
        $data['short_abbr'] = $item->skammstafanir->stuttskammstöfun;
        $data['long_abbr'] = $item->skammstafanir->löngskammstöfun;
        $data['first_assembly'] = $item->tímabil->fyrstaþing;
        if(isset($item->tímabil->síðastaþing)){
          $data['last_assembly'] = $item->tímabil->síðastaþing;
        }

        if($dataFromDatabase){
          $commiteeService->update($item->{'@attributes'}->id, $data);
        }
        else{
          $commiteeService->create($data);
        }
      }
    }
  }

  public function getAssemblyPersonsFromXml($id_assembly){
    $client = new GuzzleHttp\Client();
    $res = $client->get("http://www.althingi.is/altext/xml/thingmenn/?lthing=" . $id_assembly);
    $body = simplexml_load_string($res->getBody()->getContents());
    $obj = json_decode(json_encode($body));
    return $obj;
  }

  public function getFromXml($querystring){
    $client = new GuzzleHttp\Client();
    $res = $client->get($querystring);
    $body = simplexml_load_string($res->getBody()->getContents(), null, LIBXML_NOCDATA);
    $obj = json_decode(json_encode($body));
    return $obj;
  }

  /**
   * Sets the Datasource
   *
   * @param \PDO $pdo
   * @return null
   */
  public function setDataSource(\PDO $pdo){
    $this->pdo = $pdo;
  }
}