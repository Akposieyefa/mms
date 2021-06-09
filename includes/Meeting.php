<?php
namespace app\includes;

/**
 * class Meeting
 *
 * @author BobLewis <boblewisu@gmail.com>
 * @package app\includes
 *
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use app\includes\MeetingType;
use app\config\Connection;

class Meeting 
{
	
	function __construct($pdo) {
    	$this->pdo = $pdo;
  	}

  	
	public function singlemeeting($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetch();
	}

	public function meetingRequests($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchAll();
	}

	public function meetings($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchAll();
	}

	public function countMeetings($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args);
	}

	public function countUpcomingMeetings($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function countCompletedMeetings($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function countCancelledMeetings($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function fetchmeetingRequest($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchAll();
	}

	public function countmeetingRequest($sql, $args=NULL){
		return $this->pdo->preparedStatement($sql, $args)->fetchColumn();
	}

	public function meetingRequest($post){
		$pdo = new Connection;
		$mail = new PHPMailer();
		if (!empty($post)) {
			extract($post);

			$this->pdo->preparedStatement("INSERT INTO `meetingrequest`(`userId`, `staffemail`, `purpose`, `meetingDate`, `meetingTime`, `status`) VALUES ('{$_SESSION["userId"]}','$email','$purposeOfmeeting','$meetingDate','$meetingTime','pending') ");
								
			//The link that we will send the user via email.
			$emailBody = "<div> Goodday, This is a meeting request email.<br/><b>Purpose</b>".$purposeOfmeeting.".<br /><b>Date and Time</b>".$meetingDate." ".$meetingTime."Please Acknowledge.<br /><br /><b>Regards.</b></div>";
			
			$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                               // Enable verbose debug output

			/* Recipients */
			$mail->setFrom($_ENV['SENT_EMAIL'], $_ENV['SENT_NAME']);
			$mail->addAddress($email);     // Add a recipient
			$mail->addReplyTo($_ENV['REPLY_TO_EMAIL'],'no-reply');
		
			/* Content */
			$mail->Subject = "Meeting Request";
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Body = $emailBody;

			/* SMTP parameters. */
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = $_ENV['SMTP_HOST'];					// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			//$mail->SMTPAutoTLS = false;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS ENCRYPTION_STARTTLS` also accepted
			$mail->Username = $_ENV['SENT_EMAIL'];                 // SMTP username
			$mail->Password = $_ENV['EMAIL_PASSWORD'];                           // SMTP password
			$mail->Port = $_ENV['SMTP_PORT'];  // or 587                                  // TCP port to connect to

			/* Disable some SSL checks. */
			$mail->SMTPOptions = array(
			  'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			  )
			);


			if(!$mail->send()) {
				return false;
			    
			} else {
				return true;
			    
			}
		}
		return false;	
	}

	public function acceptMeeting($id,$email,$purpose) {
		$this->pdo->preparedStatement("UPDATE meetingrequest SET status=? WHERE id=?", ['accepted', $id]);
		$mail = new PHPMailer();
		//The link that we will send the user via email.
		$emailBody = "<div> Hello Congratulations, Your meeting (".$purpose.") request has been accepted.<br /><br /><b>Regards.</b></div>";
		
		$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                               // Enable verbose debug output

		/* Recipients */
		$mail->setFrom($_ENV['SENT_EMAIL'], $_ENV['SENT_NAME']);
		$mail->addAddress($email);     // Add a recipient
		$mail->addReplyTo($_ENV['REPLY_TO_EMAIL'],'no-reply');
	
		/* Content */
		$mail->Subject = 'Meeting Request Accepted';
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Body = $emailBody;

		/* SMTP parameters. */
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $_ENV['SMTP_HOST'];					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		//$mail->SMTPAutoTLS = false;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS ENCRYPTION_STARTTLS` also accepted
		$mail->Username = $_ENV['SENT_EMAIL'];                 // SMTP username
		$mail->Password = $_ENV['EMAIL_PASSWORD'];                           // SMTP password
		$mail->Port = $_ENV['SMTP_PORT'];  // or 587                                  // TCP port to connect to

		/* Disable some SSL checks. */
		$mail->SMTPOptions = array(
		  'ssl' => array(
		  'verify_peer' => false,
		  'verify_peer_name' => false,
		  'allow_self_signed' => true
		  )
		);


		if(!$mail->send()) {
			return false;
		    
		} else {
			return true;
		    
		}
		return true;
	}

	public function declineMeeting($id,$email,$purpose) {
		$this->pdo->preparedStatement("UPDATE meetingrequest SET status=? WHERE id=?", ['declined', $id]);
		$mail = new PHPMailer();
		//The link that we will send the user via email.
		$emailBody = "<div> Hello Sorry, Your meeting (".$purpose.") request has been declined. <b>Please reschedule your meeting.</b><br /><br /><b>Regards.</b></div>";
		
		$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                               // Enable verbose debug output

		/* Recipients */
		$mail->setFrom($_ENV['SENT_EMAIL'], $_ENV['SENT_NAME']);
		$mail->addAddress($email);     // Add a recipient
		$mail->addReplyTo($_ENV['REPLY_TO_EMAIL'],'no-reply');
	
		/* Content */
		$mail->Subject = 'Meeting Request Declined';
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Body = $emailBody;

		/* SMTP parameters. */
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $_ENV['SMTP_HOST'];					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		//$mail->SMTPAutoTLS = false;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS ENCRYPTION_STARTTLS` also accepted
		$mail->Username = $_ENV['SENT_EMAIL'];                 // SMTP username
		$mail->Password = $_ENV['EMAIL_PASSWORD'];                           // SMTP password
		$mail->Port = $_ENV['SMTP_PORT'];  // or 587                                  // TCP port to connect to

		/* Disable some SSL checks. */
		$mail->SMTPOptions = array(
		  'ssl' => array(
		  'verify_peer' => false,
		  'verify_peer_name' => false,
		  'allow_self_signed' => true
		  )
		);


		if(!$mail->send()) {
			return false;
		    
		} else {
			return true;
		    
		}
		return true;
	}

	public function addMeeting($post){
		$pdo = new Connection;
		$mail = new PHPMailer();
		if (!empty($post)) {
			extract($post);
			
			$stmt = $this->pdo->preparedStatement("SELECT COUNT(*) FROM `meetings` WHERE `meetingDate`='$date'");
			if($stmt->fetchColumn() < 1){

			$this->pdo->preparedStatement("INSERT INTO `meetings` (`subject`, `agenda`, `meetingTypeId`, `greetingText`, `venue`, `meetingDate`, `meetingTime`, `status`, `createdBy`) VALUES ('$subjectOfMeeting','$agenda','$typeOfMeeting','$greetingtxt','$venue','$date','$time','upcoming','{$_SESSION['userType']}') ");

			if($typeOfMeeting == '1'):
				//faculty meeting, send mail to staff
				$results = $this->pdo->preparedStatement("SELECT email, name FROM users WHERE memberType='2'")->fetchAll();
			elseif($typeOfMeeting == '2'):
				//Department meeting, send mail to staff
				$results = $this->pdo->preparedStatement("SELECT email, name FROM users WHERE memberType='2'")->fetchAll();
			elseif($typeOfMeeting == '3'):
				//Staff meeting, send mail to staff
				$results = $this->pdo->preparedStatement("SELECT email, name FROM users WHERE memberType='2'")->fetchAll();
			elseif($typeOfMeeting == '4'):
				//staff and student meeting, send mail to staff
				$results = $this->pdo->preparedStatement("SELECT email, name FROM users WHERE memberType='2' OR memberType='4'")->fetchAll();
			else:
				$results = $this->pdo->preparedStatement("SELECT email, name FROM users")->fetchAll();
			endif;

			$meetingtype = new MeetingType($pdo);
                $res = $meetingtype->meetingtypes("select name from meetingtype where id=?", [$typeOfMeeting]);

			foreach ($results as $result) {
								
				//The link that we will send the user via email.
				$emailBody = "<div> Hello ".$result->name.".<br />There will be a ".$res->name." on ".$date." ".$time."<br />Venue: ".$venue."<br /><br /><b>Regards.</b></div>";
				
				$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                               // Enable verbose debug output

				/* Recipients */
				$mail->setFrom($_ENV['SENT_EMAIL'], $_ENV['SENT_NAME']);
				$mail->addAddress($result->email, $result->name);     // Add a recipient
				$mail->addReplyTo($_ENV['REPLY_TO_EMAIL'],'no-reply');
			
				/* Content */
				$mail->Subject = $res->name.' '.$subjectOfMeeting;
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Body = $emailBody;

				/* SMTP parameters. */
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = $_ENV['SMTP_HOST'];					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				//$mail->SMTPAutoTLS = false;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS ENCRYPTION_STARTTLS` also accepted
				$mail->Username = $_ENV['SENT_EMAIL'];                 // SMTP username
				$mail->Password = $_ENV['EMAIL_PASSWORD'];                           // SMTP password
				$mail->Port = $_ENV['SMTP_PORT'];  // or 587                                  // TCP port to connect to

				/* Disable some SSL checks. */
				$mail->SMTPOptions = array(
				  'ssl' => array(
				  'verify_peer' => false,
				  'verify_peer_name' => false,
				  'allow_self_signed' => true
				  )
				);


				if(!$mail->send()) {
					//return false;
				    
				} else {
					//return true;
				    
				}
			}

			return true;
		}else {

			return false;
		}
			
		}	
	}

	public function uploadmom($meetingid){
		$pdo = new Connection;
		$mail = new PHPMailer();
		if (!empty($meetingid)) {

			$row = $this->pdo->preparedStatement("SELECT subject, attendee, meetingTypeId FROM meetings WHERE id=? LIMIT 1", [$meetingid])->fetch();

			$meetingTypeId = $row->meetingTypeId;

			$results = $this->pdo->preparedStatement("SELECT email, name FROM users WHERE memberType=?", [$meetingTypeId])->fetchAll();

			$meetingtype = new MeetingType($pdo);
                $res = $meetingtype->meetingtypes("select name from meetingtype where id=?", [$meetingTypeId]);

			foreach ($results as $result) {
								
				//The link that we will send the user via email.
				$emailBody = "<div> Hello ".$result->name.". <br>".$row->subject." Minutes has been addded.<br /><b>Regards.</b></div>";
				
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;                               // Enable verbose debug output

				/* Recipients */
				$mail->setFrom($_ENV['SENT_EMAIL'], $_ENV['SENT_NAME']);
				$mail->addAddress($result->email, $result->name);     // Add a recipient
				$mail->addReplyTo($_ENV['REPLY_TO_EMAIL'],'no-reply');
			
				/* Content */
				$mail->Subject = $res->name.' '.$subjectOfMeeting;
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Body = $emailBody;

				/* SMTP parameters. */
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = $_ENV['SMTP_HOST'];					// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				//$mail->SMTPAutoTLS = false;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS ENCRYPTION_STARTTLS` also accepted
				$mail->Username = $_ENV['SENT_EMAIL'];                 // SMTP username
				$mail->Password = $_ENV['EMAIL_PASSWORD'];                           // SMTP password
				$mail->Port = $_ENV['SMTP_PORT'];  // or 587                                  // TCP port to connect to

				/* Disable some SSL checks. */
				$mail->SMTPOptions = array(
				  'ssl' => array(
				  'verify_peer' => false,
				  'verify_peer_name' => false,
				  'allow_self_signed' => true
				  )
				);


				if(!$mail->send()) {
					//return false;
				    
				} else {
					//return true;
				    
				}
			}
			return true;
			
		}else {
			return false;
		}	
	}

	public function update($sql, $args = NULL) 
	{
		$this->pdo->preparedStatement($sql, $args);
	}

	public function deletemeeting($args=NULL){
		return $this->pdo->preparedStatement("delete from meetings WHERE id=?", $args)->rowCount();

	}

}