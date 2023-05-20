<?php
session_start();

if(isset($_POST["submit"])) {
    
    //prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

    //connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

    //get value from text field but escape user and pass to avoid sql injection attacks
    $username = mysqli_real_escape_string($con, $_POST["txtuser"]);
    $password = mysqli_real_escape_string($con, $_POST["txtpass"]);

    // retrieve user information
    $query = "SELECT * FROM tbl_user WHERE username ='$username'";
    $result = mysqli_query($con, $query) or die("Error in query: " . mysqli_error($con));

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // verify password
        if (password_verify($password, $row['password'])) {

            // set session variables
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_role"] = $row["user_role"];
        
            // redirect based on access level
            if ($_SESSION["user_role"] == "admin") {
                header("Location: /DACclinic/admin/admin_dashboard.php");
                exit();
            } else if ($_SESSION["user_role"] == "dentist") {
                header("Location: /DACclinic/dentist/dentist_dashboard.php");
                exit();
            } else if ($_SESSION["user_role"] == "assistant") {
                header("Location: /DACclinic/assistant/assistant_dashboard.php");
                exit();
            }
        } else {
            header("Location: /DACclinic/error_handling/invalid_credentials.php");
            exit();
        }
    } else {
        header("Location: /DACclinic/error_handling/invalid_credentials.php");
        exit();
    }
  }
  ?>