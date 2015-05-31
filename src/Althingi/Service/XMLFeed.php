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

  public function processAssemblyPersons($assemblyId){
    $personsObject = $this->getAssemblyPersonsFromXml($assemblyId);
    $personService = new Person();
    $personService->setDataSource($this->pdo);
    foreach($personsObject->þingmaður as $persons){
      $idPerson = $persons->{'@attributes'}->id;
      //$this->processPerson($persons);
      $assemblySeats = $this->getFromXml($persons->xml->þingseta);
      //$this->processAssemblySeatsForPerson($assemblySeats);
      $cv = $this->getFromXml($persons->xml->lífshlaup);
      //$this->processCvForPerson($cv);
      $interests = $this->getFromXml($persons->xml->hagsmunir);
      if(isset($interests->hagsmunaskráning)){
        //$this->processInterestsForPerson($interests->hagsmunaskráning);
      }
      $comitties = $this->getFromXml($persons->xml->nefndaseta);
      $this->processCommittiesForPerson($comitties);
    }
  }

  public function processPerson($person){
    $personService = new Person();
    $personService->setDataSource($this->pdo);
    $personFromDatabase = $personService->get($person->{'@attributes'}->id);

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

  public function processCvForPerson($cv){
    $data = array();
    $data['family'] = (isset($cv->lífshlaup->fjölskylda)) ? $cv->lífshlaup->fjölskylda : null;
    $data['education'] = (isset($cv->lífshlaup->menntun)) ? $cv->lífshlaup->menntun : null;
    $data['carreer'] = (isset($cv->lífshlaup->starfsferill)) ? $cv->lífshlaup->starfsferill : null;
    $data['social'] = (isset($cv->lífshlaup->félagsmál)) ? $cv->lífshlaup->félagsmál : null;
    $data['parliamentary'] = (isset($cv->lífshlaup->þingmennska)) ? $cv->lífshlaup->þingmennska : null;
    $data['substitue'] = (isset($cv->lífshlaup->varaþingmennska)) ? $cv->lífshlaup->varaþingmennska : null;
    $data['minister'] = (isset($cv->lífshlaup->ráðherra)) ? $cv->lífshlaup->fjölskylda : null;
    $data['speaker'] = (isset($cv->lífshlaup->þingforseti)) ? $cv->lífshlaup->þingforseti : null;
    $data['persidency'] = (isset($cv->lífshlaup->þingflokksformennska)) ? $cv->lífshlaup->þingflokksformennska : null;
    $data['committee'] = (isset($cv->lífshlaup->nefndaseta)) ? $cv->lífshlaup->nefndaseta : null;
    $data['international_comitee'] = (isset($cv->lífshlaup->alþjóðanefndaseta)) ? $cv->lífshlaup->alþjóðanefndaseta : null;
    $data['writing'] = (isset($cv->lífshlaup->ritstörf)) ? $cv->lífshlaup->ritstörf : null;
    $data['editor'] = (isset($cv->lífshlaup->ritstjórn)) ? $cv->lífshlaup->ritstjórn : null;
    $data['hash'] = null;
  }

  public function processInterestsForPerson($interests){
    $data = array();
    $data['sallariedBoard'] = (isset($interests->launuðstjórnarseta)) ? $interests->launuðstjórnarseta->svar : null;
    $data['paidEmployment'] = (isset($interests->launaðstarf)) ? $interests->launaðstarf : null;
    $data['incomeGeneratingActivities'] = (isset($interests->tekjumyndandistarfsemi)) ? $interests->tekjumyndandistarfsemi : null;
    $data['financialSupport'] = (isset($interests->fjárhagslegurstuðningur)) ? $interests->fjárhagslegurstuðningur : null;
    $data['gifts'] = (isset($interests->gjafir)) ? $interests->gjafir : null;
    $data['trips'] = (isset($interests->ferðir)) ? $interests->ferðir : null;
    $data['debtReduction'] = (isset($interests->eftirgjöfskulda)) ? $interests->eftirgjöfskulda : null;
    $data['realEstate'] = (isset($interests->fasteignir)) ? $interests->fasteignir : null;
    $data['assets'] = (isset($interests->eignir)) ? $interests->eignir : null;
    $data['formerEmployer'] = (isset($interests->fyrrverandivinnuveitandi)) ? $interests->fyrrverandivinnuveitandi : null;
    $data['futureEmployer'] = (isset($interests->framtíðarvinnuveitandi)) ? $interests->framtíðarvinnuveitandi : null;
    $data['trust'] = (isset($interests->trúnaðarstörf)) ? $interests->trúnaðarstörf : null;
    $data['logged'] = (isset($interests->skráð)) ? strftime('%Y-%m-%d', strtotime($interests->skráð)) : null;
  }

  public function processCommittiesForPerson($comitties){
    //Get commiteeService in order to find the commitee
    foreach($comitties as $commitie){
      $data = array();
      $data['committee_id'] = null;
      $data['person_id'] = $comitties->{"@attributes"}->id;
      $data['title'] = $commitie->staða;
      $data['row'] = $commitie->röð;
      $data['from'] = strftime('%Y-%m-%d', strtotime($commitie->tímabil->inn));
      $data['to'] = strftime('%Y-%m-%d', strtotime($commitie->tímabil->út));
      $data['assembly_id'] = $commitie->þing;
      $data['party'] = null;
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
    foreach($object->þingsetur->þingseta as $assembly_attendance){
      $dataFromDatabase = $assemblyPersonService->getWithDetailedInfo(
        $assembly_attendance->þing,
        $object->{'@attributes'}->id,
        strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->inn)),
        strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->út))
      );
      //Create a data array with values from XML
      $data['assembly_id'] = $assembly_attendance->þing;
      $data['person_id'] = $object->{'@attributes'}->id;
      $data['abbr'] = $assembly_attendance->skammstöfun;
      $data['type'] = $assembly_attendance->tegund;
      $data['constituency_id'] = $assembly_attendance->kjördæmi->{'@attributes'}->id;
      $data['constituency_number'] = $assembly_attendance->kjördæmanúmer;
      $data['seat'] = $assembly_attendance->þingsalasæti;
      $data['from'] = strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->inn));
      $data['to'] = strftime('%Y-%m-%d', strtotime($assembly_attendance->tímabil->út));
      $data['party'] = $assembly_attendance->þingflokkur;

      if(!$dataFromDatabase){
        $assemblyPersonService->create($data);
      }
      else{
        $assemblyPersonService->update($dataFromDatabase->id, $data);
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