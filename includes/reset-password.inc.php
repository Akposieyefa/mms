<?php  

if (isset($_POST["reset-password-submit"])) {
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["password"];
	$passwordRepeat = $_POST["pwd-repeat"];

	if (empty($password) || empty($passwordRepeat)) {
	header("location: ../pages/create-new-password.php/password=empty");
	exit();
}
elseif ($password != $passwordRepeat) {
	header("location: ../pages/create-new-password.php/password=passwordnotsame");
	exit()
}
$currentDate = date("U");
require '../pages/connect.php';

$sql = "SELECT * FROM forgotpassword WHERE selector = ? AND tokenexpired >= ?;";
$stmt = msqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "there was an error!";
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $selector);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "you need to resubmit your reset request.";
			exit()
		}

		else{
			$tokenBin = hex2bin($validator);
			$tokencheck = password_verify($tokenBin, $row["token"]);

			if ($tokencheck === false) {
				echo "you need to re-submit your reset request.";
				exit();
			}
			elseif ($tokencheck === true) {
				$tokenEmail =$row['email'];

				$sql = "SELECT * FROM users WHERE email= ?;";
				$stmt = msqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "there was an error!";
				exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
					echo "there was an error";
					exit()
				}

				else{
					$sql = "UPDATE users SET password=? WHERE email=?";
					$stmt = msqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "there was an error!";
				exit();
				}
				else{
					$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
					mysqli_stmt_execute($stmt);

					$sql = "DELETE FROM forgotpassword WHERE email = ?";
					$stmt = msqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "there was an error!";
				exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					header("location: ../pages/student.php?newpwd=passwordupdated");
					}

				}
			}
		}
	}

}


else{
	header("location: ../index.html");
}

?>