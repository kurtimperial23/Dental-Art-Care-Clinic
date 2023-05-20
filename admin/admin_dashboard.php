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

// prepare database connection
$hostNAME = "localhost";
$hostUsername = "root";
$hostPassword = "";
$hostDB = "dbdacc";

// connect to database
$con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

// retrieve user information
$id = $_SESSION["id"];
$query = "SELECT first_name FROM tbl_user WHERE id='$id'";
$result = mysqli_query($con, $query) or die("Error in query: " . mysqli_error($con));

// fetch the first name from the result set
$row = mysqli_fetch_array($result);
$firstName = $row['first_name'];

// get count of user accounts
$query1 = "SELECT COUNT(*) as total_users FROM tbl_user";
$result1 = mysqli_query($con, $query1) or die("Error in query: " . mysqli_error($con));
$row1 = mysqli_fetch_assoc($result1);
$totalUsers = $row1['total_users'];

// get count of services offered
$query2 = "SELECT COUNT(*) as total_services FROM tbl_service";
$result2 = mysqli_query($con, $query2) or die("Error in query: " . mysqli_error($con));
$row2 = mysqli_fetch_assoc($result2);
$totalServices = $row2['total_services'];

// get count of appointments received
$query3 = "SELECT COUNT(*) as total_appointments FROM tbl_patient";
$result3 = mysqli_query($con, $query3) or die("Error in query: " . mysqli_error($con));
$row3 = mysqli_fetch_assoc($result3);
$totalAppointments = $row3['total_appointments'];

// get count of feedback received
$query4 = "SELECT COUNT(*) as total_feedback FROM tbl_feedback";
$result4 = mysqli_query($con, $query4) or die("Error in query: " . mysqli_error($con));
$row4 = mysqli_fetch_assoc($result4);
$totalFeedback = $row4['total_feedback'];

// get count of regular customers
$query5 = "SELECT COUNT(*) as total_customers FROM tbl_regular_customers";
$result5 = mysqli_query($con, $query5) or die("Error in query: " . mysqli_error($con));
$row5 = mysqli_fetch_assoc($result5);
$totalCustomers = $row5['total_customers'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
                        <a href="/DACclinic/admin/admin_dashboard.php" class="active"><span class="las la-home"></span>
                        <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/admin/view_users.php"><span class="las la-list"></span>
                        <span>User List</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/admin/view_feedback.php"><span class="las la-user-circle"></span>
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
                        <div >
                        <h2>Welcome Admin <?php echo"$firstName";?></h2>
                        </div>  
                    </div>
            </header>

            <main>
                <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 appointments text-center pt-2"><h5>User Accounts:  <?php echo $totalUsers; ?></h5></div>
                        <div class="col-3 appointments text-center pt-2"><h5>Services Offered:  <?php echo $totalServices; ?></h5></div>
                        <div class="col-3 appointments text-center pt-2"><h5>Appointments Received: <?php echo $totalAppointments; ?></h5></div>
                        
                        <div class="col-3 appointments text-center pt-2 "><h5>Feedback Received:  <?php echo $totalFeedback; ?></h5></div>
                        <div class="col-3 appointments text-center pt-2 "><h5>Regular Customers: <?php echo $totalCustomers; ?></h5>
                        </div>  
                    </div>      
                <hr class="two">    
                <div class="container">
                    
                    <a  class="btn btn-primary btn-lg" href="/DACclinic/admin/add_users.php">Add Users</a>
                    <br><br>
                    
                </div>
            </main>

</body>
</html>