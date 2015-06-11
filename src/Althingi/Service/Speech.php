<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 31/05/15
 * Time: 15:25
 */
namespace Althingi\Service;

use PDOException;
use Althingi\Lib\DataSourceAwareInterface;

class Speech implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function get($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Speech` S
        WHERE id = :id
      ");

      $statement->execute(array("id" => $id));

      $speech = $statement->fetchObject();

      if(!$speech){
        return false;
      }

      return $speech;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getForIssueAndAssembly($issueId, $assemblyId){
    try{
      $statement = $this->pdo->prepare("
        SELECT S.*, P.* FROM `Speech` S
		    INNER JOIN Person P
		    ON P.id = S.person_id
        WHERE issue_id = :issue_id
        AND assembly_number = :assembly_number
      ");

      $statement->execute(array(
        "issue_id" => $issueId,
        "assembly_number" => $assemblyId,
      ));

      $speech = $statement->fetchAll();

      if(!$speech){
        return false;
      }

      return $speech;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getMetadataForIssueAndAssembly($issueId, $assemblyId){
    $returnArray = array();
    try{
      $statement = $this->pdo->prepare("
        SELECT count(id) as speech_count FROM `Speech` S
        WHERE issue_id = :issue_id
        AND assembly_number = :assembly_number
      ");

      $statement->execute(array(
        "issue_id" => $issueId,
        "assembly_number" => $assemblyId,
      ));

      $speechCount = $statement->fetchObject();

      $returnArray['speechCount'] = $speechCount->speech_count;

      $totalSpeechTimeObject = $this->getSpeechTimesForAssemblyAndIssue($assemblyId, $issueId);
      $returnArray['totalSpeechTime'] = $totalSpeechTimeObject[0]->speech_time;
      $returnArray['speechTimeByParties'] = $this->getSpeechTimesForAssemblyIsuueAndParty($assemblyId, $issueId);

      return $returnArray;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getWithStartTimestamp($timestamp){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Speech` S
        WHERE from_epoch = :timest
      ");

      $statement->execute(array("timest" => $timestamp));

      $speech = $statement->fetchObject();

      if(!$speech){
        return false;
      }

      return $speech;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Speech',$data);
      $statement = $this->pdo->prepare($insertString);
      $statement->execute($data);
      return;
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't create entry",0,$e);
    }
  }

  public function update($speech_id, array $data){
    try{
      $updateString = $this->updateString('Speech',
        $data,
        "id={$speech_id}" );
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update entry",0,$e);
    }
  }

  /**
   * Gets the combined speech times for all issues for one assembly
   *
   * @param $assemblyNumber
   * @return array|bool
   * @throws \Althingi\Service\Exception
   */
  public function getSpeechTimesForAssembly($assemblyNumber){
    try{
      $statement = $this->pdo->prepare("
        SELECT issue_id, SUM(to_epoch - from_epoch) as speech_time
        FROM althingi.Speech WHERE assembly_number = :assembly_number
        GROUP BY issue_id
      ");

      $statement->execute(array("assembly_number" => $assemblyNumber));

      $speechTimes = $statement->fetchAll();

      if(!$speechTimes){
        return false;
      }

      return $speechTimes;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  /**
   * Gets the combined speech times for one issue for one assembly
   *
   * @param int $assemblyNumber
   * @param int $issue_id
   * @return array|bool
   * @throws \Althingi\Service\Exception
   */
  public function getSpeechTimesForAssemblyAndIssue($assemblyNumber, $issue_id){
    try{
      $statement = $this->pdo->prepare("
        SELECT issue_id, SUM(to_epoch - from_epoch) as speech_time
        FROM althingi.Speech
        WHERE assembly_number = :assembly_number AND
        issue_id = :issue_id
      ");

      $statement->execute(array(
        "assembly_number" => $assemblyNumber,
        "issue_id" => $issue_id,
      ));

      $speechTimes = $statement->fetchAll();

      if(!$speechTimes){
        return false;
      }

      return $speechTimes;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  /**
   * Gets the combined speech times for all issues for one assembly,
   * grouped by the parties
   *
   * @param $assemblyNumber
   * @return array|bool
   * @throws \Althingi\Service\Exception
   */
  public function getSpeechTimesForAssemblyAndParty($assemblyNumber){
    try{
      $statement = $this->pdo->prepare("
        SELECT issue_id, party, SUM(to_epoch - from_epoch) as speech_time
        FROM althingi.Speech WHERE assembly_number = :assembly_number
        GROUP BY issue_id, party
      ");

      $statement->execute(array("assembly_number" => $assemblyNumber));

      $speechTimes = $statement->fetchAll();

      if(!$speechTimes){
        return false;
      }

      return $speechTimes;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  /**
   * Gets the combined speech times for all issues for one assembly
   * grouped by parties
   *
   * @param int $assemblyNumber
   * @param int $issue_id
   * @return array|bool
   * @throws \Althingi\Service\Exception
   */
  public function getSpeechTimesForAssemblyIsuueAndParty($assemblyNumber, $issue_id){
    try{
      $statement = $this->pdo->prepare("
        SELECT issue_id, party, SUM(to_epoch - from_epoch) as speech_time
        FROM althingi.Speech
        WHERE assembly_number = :assembly_number AND
        issue_id = :issue_id
        GROUP BY issue_id, party
      ");

      $statement->execute(array(
        "assembly_number" => $assemblyNumber,
        "issue_id" => $issue_id,
      ));

      $speechTimes = $statement->fetchAll();

      if(!$speechTimes){
        return false;
      }

      return $speechTimes;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  /**
   * Gets the combined speech times for each assemblies
   *
   * @param int $assemblyNumber
   * @param int $issue_id
   * @return array|bool
   * @throws \Althingi\Service\Exception
   */
  public function getSpeechTimesForAssemblies(){
    try{
      $statement = $this->pdo->prepare("
        SELECT assembly_number, SUM(to_epoch - from_epoch) as speech_time
        FROM althingi.Speech
        GROUP BY assembly_number
      ");

      $statement->execute();

      $speechTimes = $statement->fetchAll();

      if(!$speechTimes){
        return false;
      }

      return $speechTimes;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  /**
   * Sets the datasource
   * @param \PDO $pdo
   * @return null;
   */
  public function setDataSource(\PDO $pdo){
    $this->pdo = $pdo;
  }
}