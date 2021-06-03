<?php require_once("../config/initialize.php"); 

if(isset($_POST["submit"])){
$name=$_POST['name'];
$surname=$_POST['surname'];
$phone_no=$_POST['phone_no'];
$email=$_POST['email'];
$sname=$_POST['sname'];
$sdepartment=$_POST['sdepartment'];
$sid=$_POST['sid'];
$rfm=$_POST['rfm'];


$sql =  "INSERT INTO guest (name, surname, phone_no, email, sname, sdepartment, sid, rfm) VALUES ('$name','$surname', '$phone_no', '$email','$sname', '$sdepartment', '$sid', '$rfm')";

if($conn->query($sql)===TRUE){
	echo"New record successfully inserted";
}
else{
	echo "error with your insertion";
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
	<!--bootsrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!--css-->
	<link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body class="bg">
<form method="post" action="guest.php" class="margin">

  
    <div class="col">
      <input type="text" class="form-control" id="name" name="name" placeholder="First name">
    </div></br>
    <div class="col">
      <input type="text" class="form-control" placeholder="Last name" id="surname" name="surname">
    </div>
  </div></br>

  
    <div class="col">
      <input type="email" class="form-control" id="email" placeholder="Email" name="email">
    </div>
<br>
    <div class="col">
      <input type="num" class="form-control" id="phone_no" name="phone_no" placeholder="phone number">
    </div></br>
     <div class="col">
      <input type="text" class="form-control" id="sname" name="sname" placeholder="staff's name">
    </div></br>
    <div class="col">
      <input type="text" class="form-control" id="sdepartment" name="sdepartment" placeholder="staff's department">
    </div></br>
    <div class="col">
      <input type="num" class="form-control" id="sid" name="sid" placeholder="staff's id">
    </div>
<br>
    <div class="col">
      <input type="text" class="form-control" id="rfm" name="rfm" placeholder="Reason for meeting">
    
    <br>
    <button type="submit" class="btn btn-secondary "  name="submit" value="submit">Submit</button>
    </div>
</form>
	



<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
