<?php
namespace app\config;
/**
 * class Session
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\config
 *
 */

class Session
{
	
	function __construct()
	{
		$this->start_session();
	}

	public function start_session(){
		return session_start();
	}

	//create a new function to check if the session variable member_id is on set
	public function logged_in() {
		return isset($_SESSION['userToken']);
        
	}

	//this function if session member is not set then it will be redirected to login.php
	public function confirm_logged_in() {
		if (!logged_in()) {?>
			<script type="text/javascript">
				window.location = "login.php";
			</script>

		<?php
		}
	}

	public function studlogged_in() {
		return isset($_SESSION['id']);
        
	}

	public function studconfirm_logged_in() {
		if (!studlogged_in()) {?>
			<script type="text/javascript">
				window.location = "login.php";
			</script>

		<?php
		}
	}

	public function message($msg="", $msgtype="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	    $_SESSION['msgtype'] = $msgtype;

	    return true;
	  } else {
	    // then this is "get message"
			return $message;
	  }
	}

	public function check_message(){
		if (isset($_SESSION['message'])) {
			if(isset($_SESSION['msgtype'])){
				if ($_SESSION['msgtype']=="info"){
		 		echo  '<div class="alert alert-info alert-dismissible fade show" role="alert">'. $_SESSION['message'] . '<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button></div>';
		 	}elseif($_SESSION['msgtype']=="error"){
				echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['message'] . '<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button></div>';
									
			}elseif($_SESSION['msgtype']=="success"){
				echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['message'] . '<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button></div>';
			}

			unset($_SESSION['message']);
	 		unset($_SESSION['msgtype']);
		 } 
		}	
	}

	public function logout($token, $queryStrToken)
	{
		//For backward compatibility with the hash_equals function.
		//The hash_equals function was released in PHP 5.6.0.
		//It allows us to perform a timing attack safe string comparison.
		if(!function_exists('hash_equals')) {
		    function hash_equals($str1, $str2) {
		        if(strlen($str1) != strlen($str2)) {
		            return false;
		        } else {
		            $res = $str1 ^ $str2;
		            $ret = 0;
		            for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
		            return !$ret;
		        }
		    }
		}
 
		//Get the token from the query string.
		//$queryStrToken = isset($_GET['token']) ? $_GET['token'] : '';
		 
		//If the token in the query string matches the token in the user's
		//session, then we can destroy the session and log them out.
		//$token = Session::get('user_token');
		if(hash_equals($token, $queryStrToken)){

			// Four steps to closing a session
			// (i.e. logging out)

			// 1. Find the session
			//session_start();

			// 2. Unset all the session variables
			$_SESSION = array();

			// 3. Destroy the session cookie
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time()-42000, '/');
			}

			// 4. Destroy the session
			session_destroy();
	    
	    return true;
		}
	}

}
?>
