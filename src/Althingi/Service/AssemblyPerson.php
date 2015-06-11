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
use Althingi\Service\DatabaseService;

class AssemblyPerson implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Gets one item
   *
   * @param $id
   * @return bool|mixed
   * @throws \Althingi\Service\Exception
   */
  public function get($id) {
    try {
      $statement = $this->pdo->prepare("
          SELECT * FROM Assembly_has_Person
          WHERE id = :id
      ");
      $statement->execute(array(
        'id' => $id
      ));
      $person = $statement->fetchObject();

      if (!$person) {
        return FALSE;
      }

      return $person;
    }
    catch (PDOException $e) {
      throw new Exception("Can't get person item. Person:[{$id}]", 0, $e);
    }
  }

  public function getForSpeaker($assembly_number, $person_id, $timestamp){
    try{
      $statement = $this->pdo->prepare("
					SELECT * FROM `Assembly_has_Person` AP
					WHERE assembly_id = :assembly_id
					AND person_id = :person_id
					AND `from` < :timest
					AND (`to` > :timest OR `to` IS NULL)
				");

      $timest = strftime('%Y-%m-%d %H:%M:%S', strtotime($timestamp));
      $statement->execute(array(
        'assembly_id' => $assembly_number,
        'person_id' => $person_id,
        'timest' => $timest
      ));

      $person = $statement->fetchAll();

      if (!$person) {
        return FALSE;
      }

      return $person;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getWithDetailedInfo($assembly_id, $person_id, $from, $to) {
    try {
      if(is_null($to)){
        $statement = $this->pdo->prepare("
					SELECT * FROM `Assembly_has_Person` AP
					WHERE assembly_id = :assembly_id
					AND person_id = :person_id
					AND `from` = :date_from
					AND `to` IS :date_to
				");
      }
      else{
        $statement = $this->pdo->prepare("
					SELECT * FROM `Assembly_has_Person` AP
					WHERE assembly_id = :assembly_id
					AND person_id = :person_id
					AND `from` = :date_from
					AND `to` = :date_to
				");
      }

      $statement->execute(array(
        'assembly_id' => $assembly_id,
        'person_id' => $person_id,
        'date_from' => $from,
        'date_to' => $to,
      ));

      $person = $statement->fetchObject();

      if (!$person) {
        return FALSE;
      }

      return $person;
    }
    catch (PDOException $e) {
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Assembly_has_Person',$data);
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
      throw new Exception("Can't create entry: {$data}",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Assembly_has_Person',$data, "id={$id}");
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