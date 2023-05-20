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

//prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

//connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword,$hostDB) or die("Error in Database Connection...");

//execute select statement
    $sql = "SELECT id, fullname, email, gender, feedback FROM tbl_feedback";
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
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous" />
</head>
<body>
        <div class="sidebar">
            <!-- Dashboard Title -->
            <div class="sidebar-brand">
            <h2><span class="las la-tooth"></span> <span>Admin Panel</span> 
                </h2>
            </div>
            

            <!-- Sidebar Menu -->
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="/DACclinic/admin/admin_dashboard.php"><span class="las la-home"></span>
                        <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/admin/view_users.php"><span class="las la-list"></span>
                        <span>User List</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/admin/view_feedback.php" class="active"><span class="las la-user-circle"></span>
                        <span>User Feedback</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/admin/appointment_history.php"><span class="las la-history"></span>
                        <span>Appointment History</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/admin/regular_customers.php"><span class="las la-user"></span>
                        <span>Regular Customers</span></a>
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
                        <h2>View Feedback</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">

           <?php
           
           echo"<table class='table table-bordered table-hover table-dark'>
           <thead>
             <tr>
               <th scope='col'>ID</th>
               <th scope='col'>Fullname</th>
               <th scope='col'>Email</th>
               <th scope='col'>Gender</th>
               <th scope='col' rowspan='3'>Feedback</th>
             </tr>
           </thead>";

        //check if there is a record available otherwise, display a message that no record was found within a table
        if(mysqli_num_rows($result) == 0) {
            echo"
                <tr>
                    <td colspan=6> 
                    NO USERS FOUND.
                    </td>
                </tr>";
        } else {
            while($row=mysqli_fetch_array($result)) {
                $id = $row['id'];
                $fullname = $row['fullname'];
                $email= $row['email'];
                $gender = $row['gender'];
                $feedback = $row['feedback'];

                echo"
                <tr> 
                    <th>$id</th>
                    <td>$fullname</td>
                    <td>$email</td>
                    <td>$gender</td>
                    <td>$feedback</td>
                </tr>";
            }
        }
        
           echo"</table>";  
           ?>
           <a  class="btn btn-primary btn-lg" href="/DACclinic/admin/admin_dashboard.php">Back</a>
        </div>
    </main>
    
</body>
</html>