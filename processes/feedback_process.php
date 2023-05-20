<?php

//check if  submit button is clicked
if (isset($_POST["submit"])) {

//prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

//connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

//get values from textfield
    $fullname = $_POST["txtfullname"];
    $email = $_POST["txtemail"];
    $gender = $_POST["txtgender"];
    $feedback = $_POST["txtfeedback"];

//prep sql statement
    $sql = "INSERT INTO tbl_feedback(fullname, email, gender, feedback) VALUES('$fullname', '$email', '$gender', '$feedback')";
    }

//execute statement
    $result = mysqli_query($con, $sql) or die("Error in statement execution");

    if($result) {
        header("Location: /DACclinic/error_handling/feedback_sent.php");
        exit();
    }