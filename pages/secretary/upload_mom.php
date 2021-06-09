<?php require_once("../../config/initialize.php"); 
use app\config\Connection;
use app\config\Functions;
use app\config\Session;
use app\includes\Meeting;

$session = new Session;
$functions = new Functions;
$pdo = new Connection;
$meeting = new Meeting($pdo);

if(empty($_SESSION["user_token"])) {
  $functions->redirect_to("../secretary.php");
} else {

  if (isset($_POST['save_mom'])) {

    // for the database
    $momFileName = time() . '-' . $_FILES["filename"]["name"];
    // For image upload
    $target_dir = "../../docs/";
    $target_file = $target_dir . basename($momFileName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['filename']['size'] > 20000000) {
      $session->message("File size should not be greated than 200Mb", "danger");

    }
    // check if file exists
    if(file_exists($target_file)) {
      $session->message("File already exists", "error");
      $functions->redirect_to("meetings.php");
      
    } else
    // Upload image only if no errors
    {
      if(move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
        
        $meeting->update("UPDATE `meetings` SET minutesOfMeeting=? WHERE id=?", [$momFileName, $_POST['id']]);
        $meeting->uploadmom($_POST['id']);
          $session->message("File uploaded and saved in the Database", "success");
          $functions->redirect_to("meetings.php");
      } else {
        $session->message("There was an error uploading the file", "error");
        $functions->redirect_to("meetings.php");
        
      }
    }
    

  }

  ?>
  <!DOCTYPE html>
<html>
<head>
    <title>Uploading Minute of Meeting</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form id="fileUploadForm" novalidate=""
                  enctype="multipart/form-data" method="POST">
                    <fieldset>
                        <div class="form-horizontal">
                            <div class="form-group">
                            <input type="hidden" id="action" name="action" value="addmom">
                            <input type="hidden" id="id" name="id" value="<?php echo $_GET['meetingid']; ?>">
                            <input type="file" class="form-control-file" id="filename" name="filename">
                            <span class="help-block text-danger">Only docx, doc, pdf, png, jpg is allowed.</span>
                            </div>
                            <button type="submit" class="rounded-0 btn btn-primary" name="save_mom"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                    </fieldset>    
                </form>
            </div>                       
        </div>
   </div>
</body>
</html>
<?php } ?>




