<?php
namespace app\config;
/**
 * class Funtions
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\config
 *
 */

 class Functions
 {
 	
 	public function strip_zeros_from_date($marked_string="") {
		//first remove the marked zeros
		$no_zeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*0','',$no_zeros);
		return $cleaned_string;
	}

	public function redirect_to($location = NULL) {
		if($location != NULL){
			header("Location: {$location}");
			exit;
		}
	}

	public function redirect($location=Null){
		if($location!=Null){
			echo "<script>
					window.location='{$location}'
				</script>";	
		}else{
			echo 'error location';
		}
		 
	}

	public function output_message($message="") {
	
		if(!empty($message)){
		return "<p class=\"message\">{$message}</p>";
		}else{
			return "";
		}
	}

	public function date_toText($datetime=""){
		$nicetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $nicetime);	
	}

	public function __autoload($class_name) {
		$class_name = strtolower($class_name);
		$path = LIB_PATH.DS."{$class_name}.php";
		if(file_exists($path)){
			require_once($path);
		}else{
			die("The file {$class_name}.php could not be found.");
		}
					
	}

 }
?>