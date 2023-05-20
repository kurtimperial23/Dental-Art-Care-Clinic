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

//prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

    //connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");
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
                        <a href="/DACclinic/assistant/view_schedule.php"><span class="las la-clock"></span>
                        <span>Dentist Schedule</span></a>
                    </li>
                    <li>
                        <a href="/DACclinic/assistant/view_service.php" class="active"><span class="las la-clipboard"></span>
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
                        <h2 >Add Dentist Services</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">
            <form action="/DACclinic/processes/add_service_process.php" method="post">
                <div class="row">
                    <div class="col"><label for="txtservicename">Service Name:</label></div>
                    <div class="col"><label for="txtservicetype">Service Type:</label></div>
                </div>
                
                <div class="row">
                    <div class="col"><input type="text" name="txtservicename" id="servicename" required /></div>
                    <div class="col">
                        <select name="txtservicetype" id="dropdown">
                            <option value="General Dentistry">General Dentistry</option>
                            <option value="Restorative Dentistry">Restorative Dentistry</option>
                            <option value="Periodontics">Periodontics</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col"><label for="txtdoctor">Dentist:</label></div>
                    <div class="col"><label for="txtprice">Price:</label></div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <select name="txtdentist" id="dentist">
                            <option value="">-- Select Dentist -- </option>
                            <?php 
                                $query = "SELECT * FROM tbl_dentist";
                                $result = mysqli_query($con, $query);
                                
                                while ( $row =mysqli_fetch_assoc($result)) {
                                    echo '<option value="'.$row['id'].'">'.'Dr. '.$row['first_name'].' '.$row['last_name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col"><input type="number" name="txtprice" id="price" required /></div>
                </div>

                <div class="row pt-5 pb-3">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-lg" name="submit" value="Add Service">
                    </div>
                </div>
            </form>

            <a class="btn btn-primary btn-lg"  href="/DACclinic/assistant/assistant_dashboard.php">Back</a> 
        </div>
    </main>
</body>
</html>