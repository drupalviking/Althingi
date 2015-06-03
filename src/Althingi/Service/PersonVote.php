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

class PersonVote implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function getForVoteAndPerson($vote_id, $person_id) {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `Person_has_Vote` PV
					WHERE vote_id = :vote_id
					AND person_id = :person_id
				");
      $statement->execute(array(
        'vote_id' => $vote_id,
        'person_id' => $person_id,
      ));

      $personVote = $statement->fetchObject();

      if (!$personVote) {
        return FALSE;
      }

      return $personVote;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getForVote($vote_id) {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `Person_has_Vote` PV
					WHERE vote_id = :vote_id
				");
      $statement->execute(array(
        'vote_id' => $vote_id,
      ));

      $personVote = $statement->fetchAll();

      if (!$personVote) {
        return FALSE;
      }

      return $personVote;
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
      $insertString = $this->insertString('Person_has_Vote',$data);
      $statement = $this->pdo->prepare($insertString);
      $statement->execute($data);
      return;
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($data);
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't create entry",0,$e);
    }
  }

  public function update(array $data){
    try{
      $updateString = $this->updateString(
        'Person_has_Vote',
        $data,
        "vote_id={$data['vote_id']} AND
        person_id = {$data['person_id']}
      ");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($data);
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update entry",0,$e);
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