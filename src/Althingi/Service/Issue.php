<?php
/**
 * Created by PhpStorm.
 * User: drupalviking
 * Date: 26/05/15
 * Time: 20:40
 */
namespace Althingi\Service;

use PDOException;
use Althingi\Lib\DataSourceAwareInterface;


class Issue implements DataSourceAwareInterface{
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
        SELECT * FROM `Issue`
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
   * Gets one condition by issue number and assembly number
   *
   * @param $id
   * @return bool|mixed
   * @throws Exception
   */
  public function getByIssueAndAssembly($issueId, $assemblyId){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Issue`
        WHERE issue_id = :issue_id AND
        assembly_id = :assembly_id
      ");

      $statement->execute(array(
        'issue_id' => (int)$issueId,
        'assembly_id' => (int)$assemblyId
      ));

      $issue = $statement->fetchObject();

      if(!$issue){
        return false;
      }

      return $issue;
    }
    catch( PDOException $e ){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get Issue item.", 0, $e);
    }
  }

  /**
   * Gets all conditions
   *
   * @return array
   * @throws Exception
   */
  public function fetchAllForAssembly($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Issue`
        WHERE assembly_id = :id
        ORDER BY issue_id ASC;
      ");

      $statement->execute(array(
        'id' => (int)$id
      ));

      return $statement->fetchAll();
    }
    catch( PDOException $e){
      echo $e->getMessage();
      throw new Exception("Can't get Assemblies");
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Issue',$data);
      $statement = $this->pdo->prepare($insertString);
      $statement->execute($data);
      $id = (int)$this->pdo->lastInsertId();
      return $id;
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't create Issue entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Issue',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update Issue entry",0,$e);
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