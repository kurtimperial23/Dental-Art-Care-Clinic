<?php
// start session
session_start();

// check if user is logged in
    if (!isset($_SESSION["id"])) {  
        header("Location: /DACclinic/login.php");
        exit();
    }

// check if user has access to this page
    if ($_SESSION["user_role"] != "dentist") {
        header("Location: /DACclinic/processes/unauthorized.php");
        exit();
    }

//prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

//connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword,$hostDB) or die("Error in Database Connection...");

//execute select statement
    $sql = "SELECT * FROM tbl_patient";
    $result = mysqli_query($con, $sql) or die("Error in executing SELECT statement"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Art Care Clinic</title>

    <link rel="stylesheet" href="/DACclinic/stylesdashboard.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>

<!-- modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Completed</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Prompt message for the user -->
            <p>Are you sure you want to Archive this appointment?</p>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <!-- Send request to delete_user_process.php -->
            <a type="button" class="btn btn-primary" href="" onclick="deleteUser3()">Yes</a>
        </div>
        </div>
    </div>
    </div> 

        <div class="sidebar">
            <!-- Dashboard Title -->
            <div class="sidebar-brand">
                <h2><span class="las la-tooth"></span> <span>Dentist Panel</span> 
                </h2>
            </div>

            <!-- Sidebar Menu -->
            <div class="sidebar-menu">
                <ul>
                <li>
                        <a href="/DACclinic/dentist/dentist_dashboard.php"><span class="las la-home"></span>
                        <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/dentist/view_appointments.php" class="active"><span class="las la-user-circle"></span>
                        <span>Appointments</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/processes/logout.php"><span class="las la-square"></span>
                        <span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <header class="d-flex justify-content-center">
                    <!-- User Pic and Name -->
                    <div class="user-wrapper">
                        
                        <div>
                        <h2>View Appointments</h2>
                        </div>
                    </div>
            </header>
    <main> 
    <?php
           echo"<table class='table table-bordered table-hover table-dark'>
           <thead>
             <tr>
             <th scope='col'>Fullname</th>
             <th scope='col'>Contact No.</th>
             <th scope='col'>Email</th>
             <th scope='col'>Gender</th>
             <th scope='col'>Schedule</th>
             <th scope='col'>Service</th>
             <th scope='col'>Dentist</th>
             <th scope='col'>Comments</th>
             <th scope='col'>Action</th>

             </tr>
           </thead>";

        //check if there is a record available otherwise, display a message that no record was found within a table
        if(mysqli_num_rows($result) == 0) {
            echo"
                <tr>
                    <td colspan=9> 
                    NO USERS FOUND.
                    </td>
                </tr>";
        } else {
            while($row=mysqli_fetch_array($result)) {
                $id = $row['id'];
                $fname = $row['f_name'];
                $last_name =$row['l_name'];
                $pnumber =$row['contact_number'];
                $email =$row['email'];
                $new_patient =$row['new_patient'];
                $gender =$row['gender'];
                $appoint_date =$row['ap_date'];
                $appoint_time = date("h:i A", strtotime($row['ap_time']));
                $service =$row['service_req'];
                $comment =$row['comments'];
                $dentist =$row['booked_dentist'];

                echo"
                <tr> 
                    <td>$fname $last_name</td>
                    <td>$pnumber</td>
                    <td>$email</td>
                    <td>$gender</td>
                    <td>$appoint_date at $appoint_time</td>
                    <td>$service</td>
                    <td>$dentist</td>
                    <td>$comment</td>
                    <td>
                    <a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='setDeleteUserId3($id)'>Done</a>
                </td>
                </tr>";
            }
        }
        
           echo"</table>";  
           ?>
    <a href="/DACclinic/dentist/dentist_dashboard.php" class='btn btn-primary'>Back</a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="/DACclinic/script.js"></script>
</body>
</html>