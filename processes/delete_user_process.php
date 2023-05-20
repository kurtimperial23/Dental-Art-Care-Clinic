<?php
// start session
session_start();

// check if user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: /DACclinic/login.php");
    exit();
}

// check if id is set and not empty
if (isset($_GET["id"]) && !empty($_GET["id"])) {

    // prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

    // connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

    // prepare and execute delete statement
    $id = $_GET["id"];
    $sql = "DELETE FROM tbl_user WHERE id = $id";

    mysqli_query($con, $sql) or die("Error in executing DELETE statement");

    // redirect back to view users page
    header("Location: /DACclinic/admin/view_users.php");
    exit();
} else {
    // if id is not set or empty, redirect back to view users page
    header("Location: /DACclinic/error_handling/deletion_error.php");
    exit();
}
?>