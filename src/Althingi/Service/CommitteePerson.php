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

class CommitteePerson implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function getWithDetailedInfo($committee_id, $person_id, $title, $from, $assembly_id) {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `Committee_has_Person` CP
					WHERE committee_id = :committee_id
					AND person_id = :person_id
					AND `title` = :committee_title
					AND `from` = :date_from
					AND `assembly_id` = :assembly_id
				");
      $statement->execute(array(
        'committee_id' => $committee_id,
        'person_id' => $person_id,
        'committee_title' => $title,
        'date_from' => $from,
        'assembly_id' => $assembly_id,
      ));

      $committee = $statement->fetchObject();

      if (!$committee) {
        return FALSE;
      }

      return $committee;
    }
    catch (PDOException $e) {
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Committee_has_Person',$data);
      $statement = $this->pdo->prepare($insertString);
      $statement->execute($data);
      $id = (int)$this->pdo->lastInsertId();
      $data['id'] = $id;
      return $id;
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't create entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Committee_has_Person',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
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
   * Sets the datasource
   * @param \PDO $pdo
   * @return null;
   */
  public function setDataSource(\PDO $pdo){
    $this->pdo = $pdo;
  }
}