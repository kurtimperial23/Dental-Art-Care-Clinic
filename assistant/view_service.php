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
$con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

//execute select statement
$sql = "SELECT s.id, s.service_name, s.service_type,s.price, d.first_name , d.last_name
        FROM tbl_service s 
        INNER JOIN tbl_dentist d ON s.dentist_offer = d.id";
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

    <!-- modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Prompt message for the user -->
        <p>Are you sure you want to delete this Service??</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
        <!-- Send request to delete_user_process.php -->
        <a type="button" class="btn btn-primary" href="" onclick="deleteUser2()">Yes</a>
      </div>
    </div>
  </div>
</div>

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
                        <h2>View Dentist Service</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">
            <?php

            echo "<table class='table table-bordered table-hover table-dark'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Service Name</th>
                        <th scope='col'>Service Type</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Dentist Name</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>";

            //check if there is a record available otherwise, display a message that no record was found within a table
            if (mysqli_num_rows($result) == 0) {
                echo "
                    <tr>
                        <td colspan=6> 
                            NO SERVICE FOUND. Please add SERVICES into the database
                        </td>
                    </tr>";
            } else {
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $service_name = $row['service_name'];
                    $service_type = $row['service_type'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $price= $row['price'];

                    echo "
                    <tr> 
                        <td>$id</td>
                        <td>$service_name</td>
                        <td>$service_type</td>
                        <td>₱$price</td>
                        <td>Dr. $first_name $last_name</td>
                        <td>
                            <a  class='btn btn-primary' href='/DACclinic/assistant/edit_service.php?id=$id'>Edit</a>
                            <a class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='setDeleteUserId2($id)'>Delete</a>
                        </td>
                    </tr>";
                }
            }
            echo "</table>";
            ?>
        <a  class="btn btn-primary btn-lg" href="/DACclinic/assistant/add_service.php">Add Services</a>
            <a class="btn btn-primary btn-lg" href="/DACclinic/assistant/assistant_dashboard.php">Back</a> 
        </div>
        
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="/DACclinic/script.js"></script>

</body>
</html>