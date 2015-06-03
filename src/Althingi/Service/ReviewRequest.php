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

class ReviewRequest implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function get($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `ReviewRequest` RR
        WHERE id = :id
      ");

      $statement->execute(array("id" => $id));

      $review_request = $statement->fetchObject();

      if(!$review_request){
        return false;
      }

      return $review_request;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getWithDetailedInfo($review_request_number, $reciever, $issue_number, $assembly_number) {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `ReviewRequest` CP
					WHERE review_request_number = :review_request_number
					AND reciever = :reciever
					AND `issue_number` = :issue_number
					AND `assembly_number` = :assembly_number
				");
      $statement->execute(array(
        'review_request_number' => $review_request_number,
        'reciever' => $reciever,
        'issue_number' => $issue_number,
        'assembly_number' => $assembly_number,
      ));

      $review_request = $statement->fetchObject();

      if (!$review_request) {
        return FALSE;
      }

      return $review_request;
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
      $insertString = $this->insertString('ReviewRequest',$data);
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

  public function update($id, array $data){
    try{
      $updateString = $this->updateString('ReviewRequest', $data, "id={$id}" );
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