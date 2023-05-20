<?php
// prepare database connection
$hostNAME = "localhost";
$hostUsername = "root";
$hostPassword = "";
$hostDB = "dbdacc";

// connect to database
$con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

// get the service ID from the request
$service_id = $_GET['id'];

// query the tbl_service table for the price of the selected service
$query = "SELECT price FROM tbl_service WHERE id = $service_id";
$result = mysqli_query($con, $query);

// check if the query returned any rows
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo $row['price'];
}
?>