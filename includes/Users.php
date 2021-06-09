<?php
namespace app\includes;

/**
 * class Users
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\includes
 *
 */


class Users
{

	function __construct($pdo) {
    	$this->pdo = $pdo;
  	}

	public function AuthenticateUserAdmin($args = NULL){
		$stmt = $this->pdo->preparedStatement("SELECT * FROM `users` WHERE `email`=? AND `memberType`='Admin' LIMIT 1", $args);
		$row_count = $stmt->rowCount();//get the number of count
		 if ($row_count == 1){
	 		if ($found_user = $stmt->fetch()) {
	 			//$session = new Session;
			 	$_SESSION['userId'] 	 = $found_user->id;
	            $_SESSION['userName']    = $found_user->name;
	            $_SESSION['userEmail']= $found_user->email;
	            $_SESSION['userType']    = $found_user->memberType;

	            //create a cryptographically secure token.
	            $userToken = bin2hex(openssl_random_pseudo_bytes(24));
	             
	            //assign the token to a session variable.
	            $_SESSION['user_token'] = $userToken;
			 	return true;
		 	}
		 else{
		 	return false;
		 } 
		}else{
			return false;
		}	
				
	}

	public function AuthenticateUserstaff($args = NULL){
		$stmt = $this->pdo->preparedStatement("SELECT * FROM `users` WHERE `email`=? AND `memberType`='2' LIMIT 1", $args);
		$row_count = $stmt->rowCount();//get the number of count
		 if ($row_count == 1){
	 		if ($found_user = $stmt->fetch()) {
	 			//$session = new Session;
			 	$_SESSION['userId'] 	 = $found_user->id;
	            $_SESSION['userName']    = $found_user->name;
	            $_SESSION['userEmail']= $found_user->email;
	            $_SESSION['userType']    = ($found_user->memberType == '2') ? "Staff" : "Null";

	            //create a cryptographically secure token.
	            $userToken = bin2hex(openssl_random_pseudo_bytes(24));
	             
	            //assign the token to a session variable.
	            $_SESSION['user_token'] = $userToken;
			 	return true;
		 	}
		 else{
		 	return false;
		 } 
		}else{
			return false;
		}	
				
	}

	public function AuthenticateUsersec($args = NULL){
		$stmt = $this->pdo->preparedStatement("SELECT * FROM `users` WHERE `email`=? AND `memberType`='3' LIMIT 1", $args);
		$row_count = $stmt->rowCount();//get the number of count
		 if ($row_count == 1){
	 		if ($found_user = $stmt->fetch()) {
	 			//$session = new Session;
			 	$_SESSION['userId'] 	 = $found_user->id;
	            $_SESSION['userName']    = $found_user->name;
	            $_SESSION['userEmail']= $found_user->email;
	            $_SESSION['userType']    = ($found_user->memberType == '3') ? "Secretary" : "Null";

	            //create a cryptographically secure token.
	            $userToken = bin2hex(openssl_random_pseudo_bytes(24));
	             
	            //assign the token to a session variable.
	            $_SESSION['user_token'] = $userToken;
			 	return true;
		 	}
		 else{
		 	return false;
		 } 
		}else{
			return false;
		}	
				
	}

	public function AuthenticateUserStudent($args = NULL){
		$stmt = $this->pdo->preparedStatement("SELECT * FROM `users` WHERE `email`=? AND `memberType`='4' LIMIT 1", $args);
		$row_count = $stmt->rowCount();//get the number of count
		 if ($row_count == 1){
	 		if ($found_user = $stmt->fetch()) {
	 			//$session = new Session;
			 	$_SESSION['userId'] 	 = $found_user->id;
	            $_SESSION['userName']    = $found_user->name;
	            $_SESSION['userEmail']= $found_user->email;
	            $_SESSION['userType']    = ($found_user->memberType == '4') ? $found_user->name : "Null";

	            //create a cryptographically secure token.
	            $userToken = bin2hex(openssl_random_pseudo_bytes(24));
	             
	            //assign the token to a session variable.
	            $_SESSION['user_token'] = $userToken;
			 	return true;
		 	}
		 else{
		 	return false;
		 } 
		}else{
			return false;
		}	
				
	}

	public function singleUser($args = NULL) {
		return $this->pdo->singleResultList("SELECT * FROM `users` WHERE `id`=?", $args);
	}

	public function singleEmail($sql, $args = NULL) {
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function singleReg($sql, $args = NULL) {
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function fetchStudentUsers() {
		return $this->pdo->loadResultList("SELECT * FROM `users` WHERE `memberType`='4'");
	}

	public function fetchUsers() {
		return $this->pdo->loadResultList("SELECT * FROM `users`");
	}

	public function fetchStaffUsers() {
		return $this->pdo->loadResultList("SELECT * FROM `users` WHERE `memberType`='2'");
	}

	public function fetchSecUsers() {
		return $this->pdo->loadResultList("SELECT * FROM `users` WHERE `memberType`='3'");
	}

	public function create($sql, $args = NULL) 
	{
		$this->pdo->preparedStatement($sql, $args)->rowCount();
	}

	public function update($sql, $args = NULL) 
	{
		$this->pdo->preparedStatement($sql, $args);
	}
	public function delete($sql, $args = NULL) 
	{
		$this->pdo->preparedStatement($sql, $args);
	}

}