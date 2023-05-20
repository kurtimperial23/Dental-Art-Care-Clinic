<?php
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
    $fname = mysqli_real_escape_string($con, $_POST['txtfname']);
    $last_name = mysqli_real_escape_string($con, $_POST['txtlname']);
    $pnumber = mysqli_real_escape_string($con, $_POST['txtnumber']);
    $email = mysqli_real_escape_string($con, $_POST['txtemail']);
    $new_patient = mysqli_real_escape_string($con, $_POST['txtpatient']);
    $gender = mysqli_real_escape_string($con, $_POST['txtgender']);
    $appoint_date = mysqli_real_escape_string($con, $_POST['txtdate']);
    $appoint_time = mysqli_real_escape_string($con, $_POST['txttime']);
    $service = mysqli_real_escape_string($con, $_POST['txtservice']);
    $comment = mysqli_real_escape_string($con, $_POST['txtcomment']);
    $dentist = mysqli_real_escape_string($con, $_POST['txtdentist']);

    //sanitize the input for the email field
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    //check if the customer is a regular customer
    $check_query = "SELECT COUNT(*) AS count FROM tbl_regular_customers WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);
    $check_row = mysqli_fetch_assoc($check_result);
    $count = $check_row['count'];

    if ($new_patient == 'No' && $count == 0) {
        //if the customer is not a new patient and is not already in the tbl_regular_customers, insert the customer's data into tbl_regular_customers
        $insert_query = "INSERT INTO tbl_regular_customers (f_name, l_name, contact_number, email, gender) VALUES ('$fname', '$last_name', '$pnumber', '$email', '$gender')";
        mysqli_query($con, $insert_query);
    }   

    //prepare SQL statements to check if date and time combination exists in the database
    $check_query = "SELECT COUNT(*) AS count FROM tbl_patient WHERE ap_date = '$appoint_date' AND ap_time = '$appoint_time'";
    $check_result = mysqli_query($con, $check_query);
    $check_row = mysqli_fetch_assoc($check_result);
    $count = $check_row['count'];

    //prepare SQL statement to check if the selected dentist already has an appointment at the chosen date and time
    $check_dentist_query = "SELECT COUNT(*) AS count FROM tbl_patient WHERE ap_date = '$appoint_date' AND ap_time = '$appoint_time' AND booked_dentist = $dentist";
    $check_dentist_result = mysqli_query($con, $check_dentist_query);
    $check_dentist_row = mysqli_fetch_assoc($check_dentist_result);
    $count_dentist = $check_dentist_row['count'];

    //if the date and time combination exists or the selected dentist already has an appointment at the chosen date and time, output an error message
    if ($count >= 2 || $count_dentist >= 1) {
        header("Location: /DACclinic/error_handling/schedule_taken.php");
        exit();
    } else {

        //prepare SQL statements to add record
        $sql = "INSERT INTO tbl_patient (f_name, l_name, contact_number, email, new_patient, gender, ap_date, ap_time, service_req, comments, booked_dentist) VALUES ('$fname', '$last_name', '$pnumber', '$email', '$new_patient', '$gender', '$appoint_date', '$appoint_time', '$service', '$comment', $dentist)";

        //execute insertion of records
        $result = mysqli_query($con, $sql) or die("Error in insert statement and query execution");

        if ($result) {
            header("Location: /DACclinic/error_handling/successful_booking.php");
            exit();
    }
}
}
?>