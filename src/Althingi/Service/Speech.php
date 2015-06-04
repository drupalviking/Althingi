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
   * Sets the datasource
   * @param \PDO $pdo
   * @return null;
   */
  public function setDataSource(\PDO $pdo){
    $this->pdo = $pdo;
  }
}