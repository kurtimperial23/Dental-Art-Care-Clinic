<?php
// start session
session_start();

// check if user is logged in
    if (!isset($_SESSION["id"])) {  
        header("Location: /DACclinic/login.php");
        exit();
    }

// check if user has access to this page
    if ($_SESSION["user_role"] != "admin") {
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
        $fname = $_POST['txtfname'];
        $last_name = $_POST['txtlname'];
        $username = $_POST['txtuser'];
        $password = $_POST['txtpass'];
        $role = $_POST['txtrole'];
        $verify = $_POST['txtpassverify'];

    // check if passwords match
        if ($password != $verify) {
            echo"Your passwords dont match";
            exit();
        }

    //encrypt password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //prepare statement to update data
        $sql =  "UPDATE tbl_user SET first_name = '$fname', last_name = '$last_name', username = '$username', password ='$hashed_password', user_role = '$role' WHERE id = '$id'";

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
        }
            else {
                header("Location:/DACclinic/admin/admin_dashboard.php");
            }

    
