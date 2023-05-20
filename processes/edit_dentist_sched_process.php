<?php
// start session
session_start();

// check if user is logged in
if (!isset($_SESSION["id"])) {  
    header("Location: /DACclinic/login.php");
    exit();
}

// check if user has access to this page
if ($_SESSION["user_role"] != "assistant") {
    header("Location: /DACclinic/processes/unauthorized.php");
    exit();
}

//check if  submit button is clicked
if (isset($_POST["submit"])) {

    //prepare database connection
    $hostNAME = "localhost";    
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

    //connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword,$hostDB) or die("Error in Database Connection...");

    //get value from textfield
    $id = $_POST['txtid'];
    $starttime = $_POST['txtstarttime'];
    $endtime = $_POST['txtendtime'];

    //prepare statement to update data
    $sql =  "UPDATE tbl_dentist SET starttime = '$starttime', endtime = '$endtime' WHERE id = '$id'";

    //execute statement
    $result = mysqli_query($con, $sql) or die("Error in statement execution"); 

    //confirmation that record has been updated
    if ($result) {
        header("Location: /DACclinic/error_handling/update_successful.php");
        exit();
    } else {
        header("Location: /DACclinic/error_handling/update_error.php");
        exit();
    }
} else {
    header("Location:/DACclinic/assistant/assistant_dashboard.php");
}
