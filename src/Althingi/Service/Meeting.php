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

class Meeting implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function getForMeeting($assembly_number, $meeting_number){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Meeting` M
        WHERE assembly_number = :assembly_number AND
        meeting_number = :meeting_number
      ");

      $statement->execute(array("assembly_number" => $assembly_number, 'meeting_number' => $meeting_number));

      $meeting = $statement->fetchObject();

      if(!$meeting){
        return false;
      }

      return $meeting;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getForTimestamp($timestamp){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Meeting` M
        WHERE starts_epoch <= :timest AND
        ends_epoch >= :timest
      ");

      $statement->execute(array(
        "timest" => $timestamp
      ));

      $meeting = $statement->fetchObject();

      if(!$meeting){
        return false;
      }
      return $meeting;
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
      $insertString = $this->insertString('Meeting',$data);
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
      $updateString = $this->updateString('Meeting',
        $data,
        "assembly_number={$data['assembly_number']} AND meeting_number={$data['meeting_number']}" );
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