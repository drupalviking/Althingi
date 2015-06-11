<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 21/05/15
 * Time: 11:17
 */
namespace Althingi\Service;

use Mockery\CountValidator\Exception;
use PDOException;
use Althingi\Lib\DataSourceAwareInterface;


class Assembly implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  /**
   * Gets one condition by id
   *
   * @param $id
   * @return bool|mixed
   */
  public function get($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Assembly`
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
      //echo "<pre>";
      //print_r($e->getMessage());
      throw new Exception("Can't get Assembly item [{$id}]", 0, $e);
    }
  }

  /**
   * Gets all conditions
   *
   * @return array
   */
  public function fetchAll(){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Assembly`
        ORDER BY id DESC;
      ");

      $statement->execute();

      return $statement->fetchAll();
    }
    catch( PDOException $e){
      echo $e->getMessage();
      throw new Exception("Can't get Assemblies");
    }
  }

  /**
   * Gets all conditions
   *
   * @return array
   */
  public function fetchAllWithMetaData(){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Assembly`
        ORDER BY id DESC;
      ");
      $statement->execute();
      $assemblies = $statement->fetchAll();

      $statement = $this->pdo->prepare("
        SELECT assembly_id, count(id) as no_of_issues
        FROM althingi.Issue
        GROUP BY assembly_id;
      ");

      $statement->execute();
      $issueCounts = $statement->fetchAll();

      $statement = $this->pdo->prepare("
        SELECT assembly_number, SUM(to_epoch - from_epoch) as speech_time
        FROM althingi.Speech
        GROUP BY assembly_number
      ");
      $statement->execute();
      $speechTimeCounts = $statement->fetchAll();

      foreach($assemblies as $key => $assembly){
        foreach($issueCounts as $count){
          if($count->assembly_id == $assembly->id){
            $assemblies[$key]->issues = $count->no_of_issues;
          }
        }
        foreach($speechTimeCounts as $count){
          if($count->assembly_number == $assembly->id){
            $assemblies[$key]->speechtime = $this->calculateTime($count->speech_time);
          }
        }
      }

      return $assemblies;
    }
    catch( PDOException $e){
      echo $e->getMessage();
      throw new Exception("Can't get Assemblies");
    }
  }

  protected function calculateTime($seconds){
    $hours = (int)($seconds / 3600);
    $remainder = ($seconds - ($hours * 3600));
    $minutes = (int)($remainder / 60);
    $remainder = ($remainder % 60);
    $minutes = ($minutes < 10) ? "0" . $minutes : $minutes;
    $remainder = ($remainder < 10) ? "0" . $remainder : $remainder;
    return $hours . ":" . $minutes . ":" . $remainder;
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Assembly',$data);
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
      throw new Exception("Can't create airline entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Assembly',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update assembly entry",0,$e);
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