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
    $assemblyService = new Assembly();
    $assemblyService->setDataSource($this->pdo);
    $this->processAssemblies();
    $assemblies = $assemblyService->fetchAll();
    foreach($assemblies as $assembly){
      $this->processCommitees($assembly->id);
    }
  }

  public function bootstrapAssembly($assembly_id){
    $this->processAssemblyPersons($assembly_id);
    echo "Done with Assembly Persons, Ass: " . $assembly_id . "<br>";
    $this->processAssemblyMeetings($assembly_id);
    echo "Done with Assembly Meetings, Ass: " . $assembly_id . "<br>";
    $this->processAssemblyIssues($assembly_id);
    echo "Done with Assembly Issues, Ass: " . $assembly_id . "<br>";
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
    $this->processAssemblyMeetings($assemblyId);
    $issuesObject = $this->getFromXml("http://www.althingi.is/altext/xml/thingmalalisti/?lthing=" . $assemblyId);
    $issueService = new Issue();
    $issueService->setDataSource($this->pdo);
    foreach($issuesObject->mál as $issueOverview){
      $this->processAdditionalIssueMatters($issueOverview);
    }
  }

  public function processAssemblyMeetings($assemblyId){
    $meetings = $this->getFromXml('http://www.althingi.is/altext/xml/thingfundir/?lthing=' . $assemblyId);

    $meetingService = new Meeting();
    $meetingService->setDataSource($this->pdo);
    foreach($meetings->þingfundur as $meeting){
      $meetingFromDatabase = $meetingService->getForMeeting($assemblyId, $meeting->{'@attributes'}->númer);

      $data['assembly_number'] = $assemblyId;
      $data['meeting_number'] = $meeting->{'@attributes'}->númer;
      $data['name'] = $meeting->fundarheiti;
      $data['starts'] = strftime('%Y-%m-%d %H:%M:%S', strtotime($meeting->fundursettur));
      $data['starts_epoch'] = strtotime($meeting->fundursettur);
      $data['ends'] = strftime('%Y-%m-%d %H:%M:%S', strtotime($meeting->fuslit));
      $data['ends_epoch'] = strtotime($meeting->fuslit);
      $data['seating'] = $meeting->sætaskipan;
      $data['document_xml'] = $meeting->fundarskjöl->xml;

      if($meetingFromDatabase){
        $meetingService->update($data);
      }
      else{
        $meetingService->create($data);
      }
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

  public function processIssue($issueOverview, $issue){
    $issueService = new Issue();
    $issueService->setDataSource($this->pdo);
    $issueFromDatabase = $issueService->getByIssueAndAssembly(
      $issueOverview->{'@attributes'}->málsnúmer, $issueOverview->{'@attributes'}->þingnúmer
    );


    $data['issue_id'] = $issueOverview->{'@attributes'}->málsnúmer;
    $data['assembly_id'] = $issueOverview->{'@attributes'}->þingnúmer;
    $data['name'] = $issueOverview->málsheiti;
    $data['type'] = $issueOverview->málstegund->{'@attributes'}->málstegund;
    $data['type_name'] = $issueOverview->málstegund->heiti;
    $data['tag'] = $issueOverview->málstegund->heiti2;
    $data['issue_analysis'] = (is_string($issueOverview->efnisgreining)) ? $issueOverview->efnisgreining : null;
    $data['category'] = $issueOverview->{'@attributes'}->málsflokkur;
    $data['status'] = (isset($issue->staðamáls)) ? $issue->staðamáls : null;

    if($issueFromDatabase){
      $issueService->update($issueFromDatabase->id, $data);
    }
    else{
      $issueService->create($data);
    }
  }

  public function processIssueDocuments($documents){
    $issueService = new Issue();
    $issueService->setDataSource($this->pdo);
    $issueDocumentService = new IssueDocument();
    $issueDocumentService->setDataSource($this->pdo);

    if(is_array($documents->þingskjal)){
      $issue = $issueService->getByIssueAndAssembly(
        $documents->þingskjal[0]->{'@attributes'}->málsnúmer, $documents->þingskjal[0]->{'@attributes'}->þingnúmer
      );

      foreach($documents->þingskjal as $document) {
        $documentFromDatabase = $issueDocumentService->getByIssueIdAndDate($issue->id, $document->útbýting);

        $data['issue_id'] = $issue->id;
        $data['document_number'] = $document->{'@attributes'}->skjalsnúmer;
        $data['date'] = $document->útbýting;
        $data['type'] = $document->skjalategund;
        $data['html'] = $document->slóð->html;
        $data['pdf'] = $document->slóð->pdf;
        $data['issue_number'] = $document->{'@attributes'}->málsnúmer;
        $data['assembly_number'] = $document->{'@attributes'}->þingnúmer;

        if ($documentFromDatabase) {
          $issueDocumentService->update($documentFromDatabase->id, $data);
        }
        else {
          $issueDocumentService->create($data);
        }
      }
    }
    else{
      $issue = $issueService->getByIssueAndAssembly(
        $documents->þingskjal->{'@attributes'}->málsnúmer, $documents->þingskjal->{'@attributes'}->þingnúmer
      );

      $document = $documents->þingskjal;
      $documentFromDatabase = $issueDocumentService->getByIssueIdAndDate($issue->id, $document->útbýting);

      $data['issue_id'] = $issue->id;
      $data['document_number'] = $document->{'@attributes'}->skjalsnúmer;
      $data['date'] = $document->útbýting;
      $data['type'] = $document->skjalategund;
      $data['html'] = $document->slóð->html;
      $data['pdf'] = $document->slóð->pdf;
      $data['issue_number'] = $document->{'@attributes'}->málsnúmer;
      $data['assembly_number'] = $document->{'@attributes'}->þingnúmer;

      if ($documentFromDatabase) {
        $issueDocumentService->update($documentFromDatabase->id, $data);
      }
      else {
        $issueDocumentService->create($data);
      }
    }
  }

  public function processIssueVoting($votes){
    $issueService = new Issue();
    $issueService->setDataSource($this->pdo);
    $issueVoteService = new Vote();
    $issueVoteService->setDataSource($this->pdo);
    $commiteeService = new Commitee();
    $commiteeService->setDataSource($this->pdo);

    if(is_array($votes->atkvæðagreiðsla)) {
      $issue = $issueService->getByIssueAndAssembly(
        $votes->atkvæðagreiðsla[0]->{'@attributes'}->málsnúmer, $votes->atkvæðagreiðsla[0]->{'@attributes'}->þingnúmer
      );

      foreach ($votes->atkvæðagreiðsla as $vote) {
        $voteFromDatabase = $issueVoteService->get($vote->{'@attributes'}->atkvæðagreiðslunúmer);

        $data = array();
        $data['id'] = $vote->{'@attributes'}->atkvæðagreiðslunúmer;
        $data['issue_id'] = $issue->id;
        $data['time'] = strftime('%Y-%m-%d %H:%M:%S', strtotime($vote->tími));
        $data['time_epoch'] = strtotime($vote->tími);
        $data['progress_type'] = $vote->tegund;
        if(isset($vote->samantekt->aðferð)){
          $data['vote_type'] = $vote->samantekt->aðferð;

          if($vote->samantekt->aðferð == 'atkvæðagreiðslukerfi'){
            $data['yes'] = (isset($vote->samantekt->já->fjöldi)) ? $vote->samantekt->já->fjöldi : null;
            $data['no'] = (isset($vote->samantekt->nei->fjöldi)) ? $vote->samantekt->nei->fjöldi : null;
            $data['abstrained'] = (isset($vote->samantekt->sátuhjá->fjöldi)) ? $vote->samantekt->sátuhjá->fjöldi : null;
          }
        }

        if(isset($vote->samantekt->afgreiðsla)){
          $data['result'] = $vote->samantekt->afgreiðsla;
        }

        $data['more'] = (is_string($vote->nánar)) ? $vote->nánar : null;

        //If the Issue is sent to a Commitee, get the commitee id
        if(isset($vote->til)){
          $commitee = $commiteeService->getByName($vote->til);
          $data['commitee_id'] = (isset($commitee)) ? $commitee->id : null;
          $data['commitee'] = $vote->til;
        }

        if(isset($vote->þingskjal)){
          $data['document_id'] = $vote->þingskjal->{'@attributes'}->skjalsnúmer;
          $data['assembly_id'] = $vote->þingskjal->{'@attributes'}->þingnúmer;
        }

        if($voteFromDatabase){
          $issueVoteService->update($vote->{'@attributes'}->atkvæðagreiðslunúmer, $data);
        }
        else{
          $issueVoteService->create($data);
        }

        if(isset($vote->samantekt->aðferð)){
          if($vote->samantekt->aðferð == 'atkvæðagreiðslukerfi') {
            $this->processIndividualVoteForIssue($vote);
          }
        }
      }
    }
    else{

    }
  }

  public function processIndividualVoteForIssue($votes){
    $personVoteService = new PersonVote();
    $personVoteService->setDataSource($this->pdo);
    $votes = $this->getFromXml($votes->slóð->xml);
    if(isset($votes->atkvæðaskrá)){
      foreach($votes->atkvæðaskrá->þingmaður as $vote) {
        $vote_id = $votes->{'@attributes'}->atkvæðagreiðslunúmer;
        $person_id = $vote->{'@attributes'}->id;

        $voteFromDatabase = $personVoteService->getForVoteAndPerson($vote_id, $person_id);

        $data['vote_id'] = $vote_id;
        $data['person_id'] = $person_id;
        $data['vote'] = $vote->atkvæði;

        if ($voteFromDatabase) {
          $personVoteService->update($data);
        }
        else {
          $personVoteService->create($data);
        }
      }
    }
  }

  public function processReviewRequests($reviewRequests){
    $reviewRequestService = new ReviewRequest();
    $reviewRequestService->setDataSource($this->pdo);
    $commiteeService = new Commitee();
    $commiteeService->setDataSource($this->pdo);

    if(is_array($reviewRequests->umsagnabeiðni)){
      foreach($reviewRequests->umsagnabeiðni as $reviewRequest){
        $dataFromDatabase = $reviewRequestService->getWithDetailedInfo(
          $reviewRequest->{'@attributes'}->umsagnabeiðnanúmer,
          $reviewRequest->viðtakandi,
          $reviewRequest->{'@attributes'}->málsnúmer,
          $reviewRequest->{'@attributes'}->þingnúmer
        );

        $data['review_request_number'] = $reviewRequest->{'@attributes'}->umsagnabeiðnanúmer;
        $data['date'] = strftime('%Y-%m-%d', strtotime($reviewRequest->dagsetning));
        $data['date_epoch'] = strtotime($reviewRequest->dagsetning);
        $data['reciever'] = $reviewRequest->viðtakandi;
        $data['commitee'] = $reviewRequest->nefnd;

        $commiteeFromDatabase = $commiteeService->getByName($reviewRequest->nefnd);

        $data['commitee_id'] = $commiteeFromDatabase->id;
        $data['diary_number'] = (isset($reviewRequest->umsögn))
          ? $reviewRequest->umsögn->{'@attributes'}->dagbókarnúmer
          : null;
        $data['issue_number'] = $reviewRequest->{'@attributes'}->málsnúmer;
        $data['assembly_number'] = $reviewRequest->{'@attributes'}->þingnúmer;

        if($dataFromDatabase){
          $reviewRequestService->update($dataFromDatabase->id, $data);
        }
        else{
          $reviewRequestService->create($data);
        }
      }
    }
    else{
      $reviewRequest = $reviewRequests->umsagnabeiðni;
      $dataFromDatabase = $reviewRequestService->getWithDetailedInfo(
        $reviewRequest->{'@attributes'}->umsagnabeiðnanúmer,
        $reviewRequest->viðtakandi,
        $reviewRequest->{'@attributes'}->málsnúmer,
        $reviewRequest->{'@attributes'}->þingnúmer
      );

      $data['review_request_number'] = $reviewRequest->{'@attributes'}->umsagnabeiðnanúmer;
      $data['date'] = strftime('%Y-%m-%d', strtotime($reviewRequest->dagsetning));
      $data['date_epoch'] = strtotime($reviewRequest->dagsetning);
      $data['reciever'] = $reviewRequest->viðtakandi;
      $data['commitee'] = $reviewRequest->nefnd;

      $commiteeFromDatabase = $commiteeService->getByName($reviewRequest->nefnd);

      $data['commitee_id'] = $commiteeFromDatabase->id;
      $data['diary_number'] = (isset($reviewRequest->umsögn))
        ? $reviewRequest->umsögn->{'@attributes'}->dagbókarnúmer
        : null;
      $data['issue_number'] = $reviewRequest->{'@attributes'}->málsnúmer;
      $data['assembly_number'] = $reviewRequest->{'@attributes'}->þingnúmer;

      if($dataFromDatabase){
        $reviewRequestService->update($dataFromDatabase->id, $data);
      }
      else{
        $reviewRequestService->create($data);
      }
    }
  }

  public function processReviews($reviews){
    $reviewService = new Review();
    $reviewService->setDataSource($this->pdo);
    $commiteeService = new Commitee();
    $commiteeService->setDataSource($this->pdo);

    if(is_array($reviews->erindi)) {
      foreach ($reviews->erindi as $review) {
        $dataFromDatabase = $reviewService->getWithDetailedInfo(
          $review->{'@attributes'}->dagbókarnúmer,
          $review->sendandi,
          $review->{'@attributes'}->málsnúmer,
          $review->{'@attributes'}->þingnúmer
        );

        $data['diary_number'] = $review->{'@attributes'}->dagbókarnúmer;
        $data['sender'] = $review->sendandi;
        $data['commitee'] = (is_string($review->nefnd)) ? $review->nefnd : null;

        if($review->nefnd != "forseti"){
          $commiteeFromDatabase = $commiteeService->getByName($review->nefnd);

          $data['commitee_id'] = $commiteeFromDatabase->id;
        }
        $data['arrival_date'] = strftime('%Y-%m-%d', strtotime($review->komudagur));
        $data['arrival_date_epoch'] = strtotime($review->komudagur);
        $data['send_date'] = (is_string($review->sendingadagur))
          ? strftime('%Y-%m-%d', strtotime($review->sendingadagur))
          : null;
        $data['send_date_epoch'] = (is_string($review->sendingadagur))
          ? strtotime($review->sendingadagur)
          : null;
        $data['review_type'] = $review->tegunderindis;
        $data['path'] = $review->slóð->pdf;
        $data['issue_number'] = $review->{'@attributes'}->málsnúmer;
        $data['assembly_number'] = $review->{'@attributes'}->þingnúmer;

        if($dataFromDatabase){
          $reviewService->update($dataFromDatabase->id, $data);
        }
        else{
          $reviewService->create($data);
        }
      }
    }
    else{
      $review = $reviews->erindi;
      $dataFromDatabase = $reviewService->getWithDetailedInfo(
        $review->{'@attributes'}->dagbókarnúmer,
        $review->sendandi,
        $review->{'@attributes'}->málsnúmer,
        $review->{'@attributes'}->þingnúmer
      );

      $data['diary_number'] = $review->{'@attributes'}->dagbókarnúmer;
      $data['sender'] = $review->sendandi;
      $data['commitee'] = (is_string($review->nefnd)) ? $review->nefnd : null;

      if($review->nefnd != "forseti"){
        $commiteeFromDatabase = $commiteeService->getByName($review->nefnd);

        $data['commitee_id'] = $commiteeFromDatabase->id;
      }

      $data['arrival_date'] = strftime('%Y-%m-%d', strtotime($review->komudagur));
      $data['arrival_date_epoch'] = strtotime($review->komudagur);
      $data['send_date'] = strftime('%Y-%m-%d', strtotime($review->sendingadagur));
      $data['send_date_epoch'] = strtotime($review->sendingadagur);
      $data['review_type'] = $review->tegunderindis;
      $data['path'] = $review->slóð->pdf;
      $data['issue_number'] = $review->{'@attributes'}->málsnúmer;
      $data['assembly_number'] = $review->{'@attributes'}->þingnúmer;

      if($dataFromDatabase){
        $reviewService->update($dataFromDatabase->id, $data);
      }
      else{
        $reviewService->create($data);
      }
    }
  }

  public function processSpeeches($issue, $speeches){
    $speechService = new Speech();
    $speechService->setDataSource($this->pdo);
    $partyService = new Party();
    $partyService->setDataSource($this->pdo);
    $personService = new Person();
    $personService->setDataSource($this->pdo);
    $assemblyPersonService = new AssemblyPerson();
    $assemblyPersonService->setDataSource($this->pdo);
    $issueService = new Issue();
    $issueService->setDataSource($this->pdo);
    $issueFromDatabase = $issueService->getByIssueAndAssembly(
      $issue->{'@attributes'}->málsnúmer, $issue->{'@attributes'}->þingnúmer
    );

    if(is_array($speeches->ræða)){
      foreach($speeches->ræða as $speech){
        $speaker = $personService->get($speech->{'@attributes'}->þingmaður);
        $speakerInfo = $assemblyPersonService->getForSpeaker(
          $speech->{'@attributes'}->þingnúmer,
          $speaker->id,
          $speech->ræðahófst
        );

       $speechFromDatabase = $speechService->getWithStartTimestamp(strtotime($speech->ræðahófst));
        $data['issue_id'] = $issueFromDatabase->id;
        $data['person_id'] = $speaker->id;
        $data['person_type'] = (isset($speech->ráðherra)) ? $speech->ráðherra : "þingmaður";
        $data['from'] = str_replace('T', ' ', $speech->ræðahófst);
        $data['from_epoch'] = strtotime($speech->ræðahófst);
        $data['to'] = str_replace('T', ' ', $speech->ræðulauk);
        $data['to_epoch'] = strtotime($speech->ræðulauk);
        $data['speech_length'] = strtotime($speech->ræðulauk) - strtotime($speech->ræðahófst);
        $data['speech_type'] = $speech->tegundræðu;
        $data['iteration'] = (is_string($speech->umræða)) ? $speech->umræða : null;
        $data['meeting'] = $speech->{'@attributes'}->fundarnúmer;
        $data['assembly_number'] = $speech->{'@attributes'}->þingnúmer;
        $data['speech_xml'] = (isset($speech->slóðir->xml)) ? $speech->slóðir->xml : null;
        $data['speech_html'] = (isset($speech->slóðir->html)) ? $speech->slóðir->html : null;
        if($speakerInfo[0]){
          $data['party_id'] = $partyService->getByName($speakerInfo[0]->party)->id;
          $data['party'] = $speakerInfo[0]->party;
        }
        $data['foreperson'] = isset($speech->forsetiAlþingis) ? 1 : 0;

        if($speechFromDatabase){
          $speechService->update($speechFromDatabase->id, $data);
        }
        else{
          $speechService->create($data);
        }
      }
    }
  }

  public function processAdditionalIssueMatters($issueOverview){
    echo "Processing Additional Issue Matters: " . $issueOverview->{'@attributes'}->málsnúmer . "<br>";
    $issue = $this->getFromXml($issueOverview->xml);
    $this->processIssue($issueOverview, $issue->mál);
    echo "Done with issue<br>";
    if(isset($issue->þingskjöl->þingskjal)){
      $this->processIssueDocuments($issue->þingskjöl);
      echo "Done with documents<br>";
    }
    if(isset($issue->atkvæðagreiðslur->atkvæðagreiðsla)){
      $this->processIssueVoting($issue->atkvæðagreiðslur);
      echo "Done with voting<br>";
    }
    if(isset($issue->umsagnabeiðnir->umsagnabeiðni)){
      $this->processReviewRequests($issue->umsagnabeiðnir);
      echo "Done with Review Requests<br>";
    }
    if(isset($issue->erindaskrá->erindi)){
      $this->processReviews($issue->erindaskrá);
      echo "Done with Reviews<br>";
    }
    if(isset($issue->ræður->ræða)){
      $this->processSpeeches($issue->mál, $issue->ræður);
      echo "Done with Speeches<br>";
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
        $data['to'] = (is_string($assembly_attendance->tímabil->út))
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
      $data['to'] = (is_string($assembly_attendance->tímabil->út))
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