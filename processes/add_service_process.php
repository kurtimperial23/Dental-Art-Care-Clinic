<?php
    // // start session
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

    //check if submit button is clicked
    if (isset($_POST["submit"])) {

        //prepare database connection
        $hostNAME = "localhost";
        $hostUsername = "root";
        $hostPassword = "";
        $hostDB = "dbdacc";

        //connect to database
        $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");
                
        //get value from textfield 
        $service_name = $_POST["txtservicename"];
        $service_type = $_POST["txtservicetype"];
        $dentist = $_POST["txtdentist"];
        $price = $_POST["txtprice"];
        
        // check user role and insert data into appropriate tables
        $query = "INSERT INTO tbl_service(service_name, service_type, dentist_offer, price) VALUES('$service_name', '$service_type', '$dentist', '$price')";
    }

        //execute statement
    $result = mysqli_query($con, $query) or die("Error in statement execution");

    if($result) {
        header("Location: /DACclinic/error_handling/service_added.php");
        exit();
    }
        

    ?>