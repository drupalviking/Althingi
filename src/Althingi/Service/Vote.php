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

class Vote implements DataSourceAwareInterface{
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
        SELECT * FROM `Vote`
        WHERE id = :id
      ");

      $statement->execute(array(
        'id' => (int)$id
      ));

      $vote = $statement->fetchObject();

      if(!$vote){
        return false;
      }

      return $vote;
    }
    catch( PDOException $e ){
      echo "<pre>";
      print_r($e->getMessage());
      throw new Exception("Can't get Vote item [{$id}]", 0, $e);
    }
  }

  public function create(array $data){
    try{
      $insertString = $this->insertString('Vote',$data);
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
      throw new Exception("Can't create Vote entry",0,$e);
    }
  }

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('Vote',$data, "id={$id}");
      $statement = $this->pdo->prepare($updateString);
      $statement->execute($data);
      $data['id'] = $id;
      return $statement->rowCount();
    }
    catch (PDOException $e){
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't update Vote entry",0,$e);
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