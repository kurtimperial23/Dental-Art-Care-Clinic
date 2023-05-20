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

//prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

//connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword,$hostDB) or die("Error in Database Connection...");

//execute select statement
    $sql = "SELECT id, email, contact, starttime, endtime, first_name, last_name FROM tbl_dentist";
    $result = mysqli_query($con, $sql) or die("Error in executing SELECT statement"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Art and Care Clinic</title>

    <link rel="stylesheet" href="/DACclinic/stylesdashboard.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
<input type="checkbox" id="nav-toggle">
        <div class="sidebar">
            <!-- Dashboard Title -->
            <div class="sidebar-brand">
                <h2><span class="las la-tooth"></span> <span>Assistant Panel</span> 
                </h2>
            </div>

            <!-- Sidebar Menu -->
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="/DACclinic/assistant/assistant_dashboard.php" ><span class="las la-home"></span>
                        <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/assistant/view_schedule.php" class="active"><span class="las la-clock"></span>
                        <span>Dentist Schedule</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/assistant/view_service.php"><span class="las la-clipboard"></span>
                        <span>Dentist Services</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/assistant/view_appointments.php"><span class="las la-user-circle"></span>
                        <span>Dentist Appointments</span></a>
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
                        <h2>View Dentist Schedule</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">
           <?php
           
           echo"<table class='table table-bordered table-hover table-dark'>
           <thead>
             <tr>
               <th scope='col'>First Name</th>
               <th scope='col'>Last Name</th>
               <th scope='col'>Email</th>
               <th scope='col'>Contact</th>
               <th scope='col'>Shift Start</th>
               <th scope='col'>Shift End</th>
               <th scope='col'>Action</th>
             </tr>
           </thead>";

        //check if there is a record available otherwise, display a message that no record was found within a table
        if(mysqli_num_rows($result) == 0) {
            echo"
                <tr>
                    <td colspan=6> 
                    NO DENTISTS FOUND. Please add DENTISTS into the database
                    </td>
                </tr>";
        } else {
            while($row=mysqli_fetch_array($result)) {
                $id = $row['id'];
                $fname = $row['first_name'];
                $lname= $row['last_name'];
                $email = $row['email'];
                $contact = $row['contact'];
                $starttime = date("h:i A", strtotime($row['starttime']));
                $endtime = date("h:i A", strtotime($row['endtime']));

                echo"
                <tr> 
                    <td>$fname</td>
                    <td>$lname</td>
                    <td>$email</td>
                    <td>$contact</d>
                    <td>$starttime</td>
                    <td>$endtime</td>
                    <td>
                        <a class='btn btn-primary' href='/DACclinic/assistant/edit_schedule.php?id=$id'>EDIT</a>    
                    </td>
                </tr>";
            }
        }
        
           echo"</table>";  
           ?>
           <a  class="btn btn-primary btn-lg" href="/DACclinic/assistant/assistant_dashboard.php">Back</a>
        </div>
    </main>
    
</body>
</html>