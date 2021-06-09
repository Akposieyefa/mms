<?php
$con = mysqli_connect ('localhost', 'root', '', 'meeting_db');
 if (!$con)
 {
     echo 'not connected to server';
 }
mysqli_select_db($con, 'meeting_db') or die(mysqli_error());

$sqlEvents = "SELECT taskid, title, startTime, deadline FROM listtask LIMIT 20";
$resultset = mysqli_query($con, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {	
	// convert  date to milliseconds
	/*$start = strtotime($rows['startTime']) * 1000;
	$end = strtotime($rows['deadline']) * 1000;*/

    $start = $rows['startTime'];
    $end = $rows['deadline'];	
	$calendar[] = array(
        'id' =>$rows['taskid'],
        'title' => $rows['title'],
        'url' => "#",
		"class" => 'event-important',
        'start' => "$start",
        'end' => "$end"
    );
}
/*$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);*/
echo json_encode($calendar);
?>