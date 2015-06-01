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


class Commitee implements DataSourceAwareInterface{
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
        SELECT * FROM `Commitee`
        WHERE id = :id
      ");

      $statement->execute(array(
        'id' => (int)$id
      ));

      $condition = $statement->fetchObject();

      if(!$condition){
        return false;
      }

      return $condition;
    }
    catch( PDOException $e ){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get Committee item [{$id}]", 0, $e);
    }
  }

  /**
   * Gets one Committee by name
   *
   * @param $id
   * @return bool|mixed
   * @throws Exception
   */
  public function getByName($name){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Commitee`
        WHERE `name` = :commitee_name
      ");

      $statement->execute(array(
        'commitee_name' => $name
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
      throw new Exception("Can't get Committee item [{$name}]", 0, $e);
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
        SELECT * FROM `Commitee`
        ORDER BY id DESC;
      ");

      $statement->execute();

      return $statement->fetchAll();
    }
    catch( PDOException $e){
      echo $e->getMessage();
      throw new Exception("Can't get Committees");
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Commitee',$data);
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
      throw new Exception("Can't create committee entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Commitee',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update committee entry",0,$e);
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