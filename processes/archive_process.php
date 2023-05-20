<?php
// start session
session_start();

// check if user is logged in
if (!isset($_SESSION["id"])) {  
    header("Location: /DACclinic/login.php");
    exit();
}

// check if user has access to this page
if ($_SESSION["user_role"] != "assistant" && $_SESSION["user_role"] != "dentist") {
    header("Location: /DACclinic/processes/unauthorized.php");
    exit();
}

//prepare database connection
$hostNAME = "localhost";
$hostUsername = "root";
$hostPassword = "";
$hostDB = "dbdacc";

//connect to database
$con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

// get patient id from GET parameter
$patient_id = $_GET['id'];

// execute select statement
$sql = "SELECT * FROM tbl_patient WHERE id='$patient_id'";
$result = mysqli_query($con, $sql) or die("Error in executing SELECT statement"); 

// check if there is a record with the given id
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $first_name = $row['f_name'];
    $last_name = $row['l_name'];
    $contact_number = $row['contact_number'];
    $email = $row['email'];
    $new_patient = $row['new_patient'];
    $gender = $row['gender'];
    $ap_date = $row['ap_date'];
    $ap_time = $row['ap_time'];
    $service_req = $row['service_req'];
    $booked_dentist = $row['booked_dentist'];
    $comments = $row['comments'];

    // start transaction
    mysqli_autocommit($con, false);
    $error = false;

    // execute insert statement
    $insert_sql = "INSERT INTO tbl_appointment_history 
                    (id, f_name, l_name, contact_number, email, new_patient, gender, ap_date, ap_time, service_req, booked_dentist, comments) 
                    VALUES ('$patient_id', '$first_name', '$last_name', '$contact_number', '$email', '$new_patient', '$gender', '$ap_date', '$ap_time', '$service_req', '$booked_dentist', '$comments')";
    $insert_result = mysqli_query($con, $insert_sql);

    // check if insert is successful
    if (!$insert_result) {
        $error = true;
    }

    // delete record in tbl_patient if insert is successful
    if (!$error) {
        $delete_sql = "DELETE FROM tbl_patient WHERE id='$patient_id'";
        $delete_result = mysqli_query($con, $delete_sql);

        // check if delete is successful
        if (!$delete_result) {
            $error = true;
        }
    }

    // commit or rollback transaction depending on error
    if (!$error) {
        mysqli_commit($con);
        header("Location: /DACclinic/error_handling/archive_successful.php");
        exit();
    } else {
        mysqli_rollback($con);
        header("Location: /DACclinic/error_handling/error_inserting_data.php");
        exit();
    }
} else {
    echo "Invalid patient ID.";
}
?>
