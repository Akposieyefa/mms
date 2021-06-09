<?php
namespace app\includes;

/**
 * class Tasks
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\includes
 *
 */
use app\config\Connection;

class Tasks
{
	
	function __construct($pdo) {
    	$this->pdo = $pdo;
  	}

  	public function countTasks($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function countCompletedTasks($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function allTasks($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchAll();
	}

	public function addTask($post){
		$pdo = new Connection;
		if (!empty($post)) {
			extract($post);

		$stmt = $this->pdo->preparedStatement("SELECT COUNT(*) FROM `listtask` WHERE `deadline`='$deadline' OR `startTime`='$starttime'");
			if($stmt->fetchColumn() < 1){

		$qry = $this->pdo->preparedStatement("INSERT INTO `listtask`(`userId`, `createdBy`, `title`, `details`, `startTime`, `deadline`, `status`) VALUES ('$user','{$_SESSION["userId"]}','$title','$details',$starttime,'$deadline','active') ");
	
			if($qry) {return true;} 

		}else{
			return false;
		}

		}
	}

	public function updateTask($sql, $args = NULL) 
	{
		$this->pdo->preparedStatement($sql, $args);

	}

}//class