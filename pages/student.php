<?php require_once("../config/initialize.php"); ?>
<?php
//Import custom Mailer classe into the global namespace
use app\config\Connection;
use app\config\Functions;
use app\config\Session;

use app\includes\Users;

$session = new Session;
$functions = new Functions;

if(!empty($_SESSION["user_token"])) {
  $functions->redirect_to("student/index.php.php");
} else {
  $pdo = new Connection;
  $user = new Users($pdo);

  if(isset($_POST["submit"])){

  $stud_email = $_POST['stud_email'];
  $stud_password = $_POST['stud_password'];

    if($user->AuthenticateUserStudent([$stud_email])){
      $functions->redirect_to("student/index.php");
    }else{
      $session->message("Error: Invalid Login Details.", "error");
    } 
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>login form</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!--bootsrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- font--->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

</head>
<body class=" background2">
	

<form method="post" action="student.php" class="box2 font">
	<div style="margin-left: 40px;" class="col"><?php echo $session->check_message(); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="stud_email">
  
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="stud_password">
  </div>

  <button type="submit" class="btn btn-primary" name="submit" value="login">login</button>
  <hr>
  <a href="staff.php">login as staff</a>
  <br>
  <?php
  if (isset($_GET["newpwd"])) {
  	if($_GET["newpwd"] == "passwordupdated"){
  		echo'<p>your password has been reset!</p>';
  	}
  }

  ?>
<a href="#forgotpassword.php">forgot password</a>

</form>
 </div>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
<?php } ?>