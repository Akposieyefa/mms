<?php require_once("../../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\config\Session;
use app\includes\Meeting;
use app\includes\Tasks;


$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$meeting = new Meeting($pdo);
$task = new Tasks($pdo);

if(empty($_SESSION["user_token"])) {
  $functions->redirect_to("../student.php");
} else {

	$action = (isset($_POST['action'])) ? $_POST['action'] : $_POST['action'];

	switch ($action) {
		case 'meetingrequest':
			$response = $meeting->meetingRequest($_POST);
			if ($response):
				$session->message("New meeting request sent", "success");
				$functions->redirect_to("meetings.php");
			endif;
		break;

		case 'studaddtask':
			$response = $task->addTask($_POST);
			if ($response === true):
				$session->message("New task set", "success");
				$functions->redirect_to("task.php");
			else:
				$session->message("Your entry is already in the tale/list. please choose another schedule.", "error");
				$functions->redirect_to("task.php");
			endif;
		break;
		
		default:
			# code...
			break;
	}

}