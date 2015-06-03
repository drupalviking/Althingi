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

class Review implements DataSourceAwareInterface{
  use DatabaseService;

  /**
   * @var \PDO
   */
  private $pdo;

  public function get($id){
    try{
      $statement = $this->pdo->prepare("
        SELECT * FROM `Review` R
        WHERE id = :id
      ");

      $statement->execute(array("id" => $id));

      $review = $statement->fetchObject();

      if(!$review){
        return false;
      }

      return $review;
    }
    catch (PDOException $e) {
      echo "<pre>";
      print_r($e->getMessage());
      echo "</pre>";
      throw new Exception("Can't get item.", 0, $e);
    }
  }

  public function getWithDetailedInfo($diary_number, $sender, $issue_number, $assembly_number) {
    try {
      $statement = $this->pdo->prepare("
					SELECT * FROM `Review` CP
					WHERE diary_number = :diary_number
					AND sender = :sender
					AND `issue_number` = :issue_number
					AND `assembly_number` = :assembly_number
				");
      $statement->execute(array(
        'diary_number' => $diary_number,
        'sender' => $sender,
        'issue_number' => $issue_number,
        'assembly_number' => $assembly_number,
      ));

      $review = $statement->fetchObject();

      if (!$review) {
        return FALSE;
      }

      return $review;
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
      $insertString = $this->insertString('Review',$data);
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
      $updateString = $this->updateString('Review', $data, "id={$id}" );
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