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

class CommiteePerson implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function getWithDetailedInfo($commitee_id, $person_id, $title, $from, $assembly_id) {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `Commitee_has_Person` CP
					WHERE commitee_id = :commitee_id
					AND person_id = :person_id
					AND `title` = :commitee_title
					AND `from` = :date_from
					AND `assembly_id` = :assembly_id
				");
      $statement->execute(array(
        'commitee_id' => $commitee_id,
        'person_id' => $person_id,
        'commitee_title' => $title,
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
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Commitee_has_Person',$data);
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

  public function update(array $data){
    try{
      $updateString = $this->updateString(
        'Commitee_has_Person',
        $data,
        "commitee_id={$data['commitee_id']} AND
        person_id = {$data['person_id']} AND
        title = \"{$data['title']}\" AND
        `from` = \"{$data['from']}\" AND
        assembly_id = {$data['assembly_id']}");
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
   * Sets the datasource
   * @param \PDO $pdo
   * @return null;
   */
  public function setDataSource(\PDO $pdo){
    $this->pdo = $pdo;
  }
}