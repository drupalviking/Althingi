<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 01/06/15
 * Time: 15:32
 */
namespace Althingi\Service;

use PDOException;
use Althingi\Lib\DataSourceAwareInterface;

class IssueDocument implements DataSourceAwareInterface{
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
   * @throws Exception
   */
  public function get($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `IssueDocument`
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
      throw new Exception("Can't get IssueDocument item [{$id}]", 0, $e);
    }
  }

  public function getByIssueIdAndDate($issueId, $date){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `IssueDocument`
        WHERE issue_id = :issue_id AND
        `Date` = :distribution_date
      ");

      $statement->execute(array(
        'issue_id' => (int)$issueId,
        'distribution_date' => $date
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
      throw new Exception("Can't get IssueDocument item [{$id}]", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('IssueDocument',$data);
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
      throw new Exception("Can't create IssueDocument entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('IssueDocument',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update IssueDocument entry",0,$e);
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