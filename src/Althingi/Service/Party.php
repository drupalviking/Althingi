<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 21/05/15
 * Time: 11:17
 */
namespace Althingi\Service;

use PDOException;
use Althingi\Lib\DataSourceAwareInterface;


class Party implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Gets one Committee by id
   *
   * @param $id
   * @return bool|mixed
   * @throws Exception
   */
  public function get($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Party`
        WHERE id = :id
      ");

      $statement->execute(array(
        'id' => (int)$id
      ));

      $party = $statement->fetchObject();

      if(!$party){
        return false;
      }

      return $party;
    }
    catch( PDOException $e ){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get Party item [{$id}]", 0, $e);
    }
  }

  /**
   * Gets one Party by name
   *
   * @param $id
   * @return bool|mixed
   * @throws Exception
   */
  public function getByName($name){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Party`
        WHERE `name` = :party_name
      ");

      $statement->execute(array(
        'party_name' => $name
      ));

      $commitee = $statement->fetchObject();

      if(!$commitee){
        return false;
      }

      return $commitee;
    }
    catch( PDOException $e ){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get Party item [{$name}]", 0, $e);
    }
  }

  /**
   * Gets all commitees
   *
   * @return array
   * @throws Exception
   */
  public function fetchAll(){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Party`
        ORDER BY id DESC;
      ");

      $statement->execute();

      return $statement->fetchAll();
    }
    catch( PDOException $e){
      echo $e->getMessage();
      throw new Exception("Can't get Parties");
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Party',$data);
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
      throw new Exception("Can't create Party entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Party',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update party entry",0,$e);
    }
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