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

class Person implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Gets one Person item
   *
   * @param $id
   * @return bool|mixed
   * @throws \Althingi\Service\Exception
   */
  public function get($id) {
    try {
      $statement = $this->pdo->prepare("
          SELECT * FROM Person
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

  public function getByNameAndTimestamp($name, $timestamp) {
    try {
      $statement = $this->pdo->prepare("
          SELECT * FROM althingi.Person
          WHERE name = :name
          AND id IN (
          SELECT person_id FROM
          althingi.Assembly_has_Person
          WHERE `from` < :timest and `to` > :timest
);
      ");
      $timest = strftime('%Y-%m-%d %H:%M:%S', strtotime($timestamp));
      $statement->execute(array(
        'name' => $name,
        'timest' => $timest,
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

  public function fetchAll() {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `Person` P
					ORDER BY P.name ASC
				");
      $statement->execute();

      return array_map(function ($i) use ($statement) {
        return $i;
      }, $statement->fetchAll());
    } catch (PDOException $e) {
      throw new Exception("Can't get Persons.", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Person',$data);
      $statement = $this->pdo->prepare($insertString);
      $statement->execute($data);
      $id = (int)$this->pdo->lastInsertId();
      return $id;
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't create person entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Person',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update person entry",0,$e);
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