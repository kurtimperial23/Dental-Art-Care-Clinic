<?php
//prepare database connection
$hostNAME = "localhost";
$hostUsername = "root";
$hostPassword = "";
$hostDB = "dbdacc";

//connect to database
$con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

// Get the selected dentist ID from the query string
$dentistId = $_GET['id'];

// Prepare an SQL statement to fetch the schedule data for the selected dentist
$sql = "SELECT starttime, endtime FROM tbl_dentist WHERE id = $dentistId";
$result = mysqli_query($con, $sql);

// Check if the query returned any rows
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  // Get the start and end times from the row
  $starttime = new DateTime($row['starttime']);
  $endtime = new DateTime($row['endtime']);

  // Generate an array of schedule data objects for each hour between the start and end times
  $scheduleData = array();
  $interval = new DateInterval('PT1H'); // set the time interval to 1 hour
  while ($starttime < $endtime) {
    $time = $starttime->format('H:i');
    $displayTime = $starttime->format('h:i A');
    $scheduleData[] = array('time' => $time, 'displayTime' => $displayTime);
    $starttime->add($interval);
  }

  // Encode the schedule data as a JSON object and return it
  echo json_encode($scheduleData);
} else {
  // If no rows were returned, return an empty array as the schedule data
  echo json_encode(array());
}
?>