<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 31/05/15
 * Time: 17:49
 */
namespace Althingi\Service;

use PDOException;
use Althingi\Lib\DataSourceAwareInterface;

class Interests implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Gets one CV by id
   *
   * @param $id
   * @return bool|mixed
   * @throws Exception
   */
  public function get($person_id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Interests`
        WHERE person_id = :person_id
      ");

      $statement->execute(array(
        'person_id' => (int)$person_id
      ));

      $condition = $statement->fetchObject();

      if(!$condition){
        return false;
      }

      return $condition;
    }
    catch( PDOException $e ){
      //echo "<pre>";
      //print_r($e->getMessage());
      throw new Exception("Can't get Interest item [{$person_id}]", 0, $e);
    }
  }

  /**
   * Gets all Interests
   *
   * @return array
   * @throws Exception
   */
  public function fetchAll(){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Interests`
        ORDER BY person_id;
      ");

      $statement->execute();

      return $statement->fetchAll();
    }
    catch( PDOException $e){
      echo $e->getMessage();
      throw new Exception("Can't get Interests");
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Interests',$data);
      $statement = $this->pdo->prepare($insertString);
      $statement->execute($data);
      return;
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't create Interests entry",0,$e);
    }
  }

  public function update($person_id, array $data){
    try{
      $updateString = $this->updateString('Interests',$data, "person_id={$person_id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update Interests entry",0,$e);
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

