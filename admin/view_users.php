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
    $sql = "SELECT id, first_name, last_name, username, user_role FROM tbl_user";
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
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
        <!-- Send request to delete_user_process.php -->
        <a type="button" class="btn btn-primary" href="" onclick="deleteUser()">Yes</a>
      </div>
    </div>
  </div>
</div>

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
                        <a href="/DACclinic/admin/view_users.php" class="active"><span class="las la-list"></span>
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
                        <div>
                        <h2>View Users</h2>
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
               <th scope='col'>First Name</th>
               <th scope='col'>Last Name</th>
               <th scope='col'>Username</th>
               <th scope='col'>User Role</th>
               <th scope='col' class='text-center'>Action</th>
             </tr>
           </thead>";

        //check if there is a record available otherwise, display a message that no record was found within a table
        if(mysqli_num_rows($result) == 0) {
            echo"
                <tr>
                    <td colspan=6> 
                    NO USERS FOUND. Please add users into the database
                    </td>
                </tr>";
        } else {
            while($row=mysqli_fetch_array($result)) {
                $id = $row['id'];
                $fname = $row['first_name'];
                $lname= $row['last_name'];
                $username = $row['username'];
                $role = $row['user_role'];

                echo"
                <tr> 
                    <th>$id</th>
                    <td>$fname</td>
                    <td>$lname</td>
                    <td>$username</td>
                    <td>$role</td>
                    <td class='text-center'>
                        <a class='btn btn-primary' href='/DACclinic/admin/edit_user.php?id=$id'>Edit</a>
                        <a class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='setDeleteUserId($id)'>Delete</a>
                    </td>
                </tr>";
            }
        }
        
           echo"</table>";  
           ?>
           <a class='btn btn-primary btn-lg' href="/DACclinic/admin/admin_dashboard.php">Back</a>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="/DACclinic/script.js"></script>
</body>
</html>