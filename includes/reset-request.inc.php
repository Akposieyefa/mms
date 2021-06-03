<?php

/*require_once("PHPmailer/PHPmailer.php");

$mail = new PHPmailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ss1';
$mail->Host = 'stmp.gmail.com';
$mail->Port = '465';
$mail-> isHTML();
$mail-> username = 'shaheeda.nazif@gmail.com';
$mail-> password = 'haldiyyah';*/

if (isset($_POST["reset-request-submit"])) {

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "../create-new-password.php?selector=" . $selector ."&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	require '../pages/connect.php';

	$userEmail = $_POST["email"];

	$sql = "DELETE FROM forgotpassword WHERE email=?";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "there was an error!";
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		mysqli_stmt_execute($stmt);
	}

$sql ="INSERT INTO forgotpassword (email, selector, token, tokenexpired) VALUES (?, ?, ?, ?); ";
$sql = "DELETE FROM forgotpassword WHERE email=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "there was an error!";
		exit();
	}
	else{
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
	$to = $userEmail;

	$subject = 'Reset your password';

	$message = '<p>We recieved a password reset request. the link to reset your password is below. if you did not make this request, you can ignore this email </p>';
	$message .='<p>Here is your password reset link: </br>';
	$message .= '<a href ="' . $url . '">' . $url . '</a></p>';

	$header = "from: Zainab <shaheeda.nazif@gmail.com>\r\n";
	$header .= "Reply-To: shaheeda.nazif@gmail.com\r\n";
	$header .= "Content-type: text/html\r\n";

	mail($to, $subject, $message, $header);

	header("Location: ../pages/forgotpassword.php?reset=success");


}

else{
	header("Location: ../index.html");
}