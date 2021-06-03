<?php
namespace app\includes;

/**
 * class MeetingType
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\includes
 *
 */

class MeetingType
{
	
	function __construct($pdo) {
    	$this->pdo = $pdo;
  	}

	public function singlemeetingtypes($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetch();
	}

	public function meetingtypes($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchAll();
	}
}