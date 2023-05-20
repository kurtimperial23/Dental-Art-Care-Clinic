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

//get id from url based on record 

    if(isset($_GET['id'])) $id = $_GET['id'];

//select the record with a specific id  
    $sql = "SELECT * FROM tbl_dentist WHERE id = $id";

//execute the statement
    $result = mysqli_query($con, $sql);
    $starttime = '';
    $endtime = '';
    $id = '';

while($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $starttime = $row['starttime'];
    $endtime = $row['endtime'];
}
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
                        <h2>Edit Dentist Schedules</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">
          
            <form action="/DACclinic/processes/edit_dentist_sched_process.php" method="post">
            <input type="hidden" name="txtid" value="<?php echo $id;?>">

                <div class="row">
                    <div class="col"><label for="txtstarttime">Start of Shift</label></div>
                    <div class="col"><label for="txtendtime">End of Shift</label></div>
                </div>

                <div class="row">
                    <div class="col"><input type="time" name="txtstarttime" id="start" value="<?php echo date('H:00', strtotime('+1 hour')); ?>"/></div>
                    <div class="col"><input type="time" name="txtendtime" id="end" value="<?php echo date('H:00', strtotime('+1 hour')); ?>"/></div>
                </div>

                <div class="row pt-5 pb-3">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-lg" name="submit" value="Edit Schedule">
                    </div>
                </div>
            </form>

            <h5><a  class="btn btn-primary btn-lg" href="/DACclinic/assistant/view_schedule.php">Back</a></h5>
        </div>
    </main>
</body>
</html>