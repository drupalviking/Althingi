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