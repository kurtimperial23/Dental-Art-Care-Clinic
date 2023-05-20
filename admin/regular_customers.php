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
    $sql = "SELECT * FROM tbl_regular_customers";
    $result = mysqli_query($con, $sql) or die("Error in executing SELECT statement"); 


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
                        <a href="/DACclinic/admin/admin_dashboard.php"><span class="las la-home"></span>
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
                        <a href="/DACclinic/admin/regular_customers.php" class="active"><span class="las la-user"></span>
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
                        <h2>Regular Customers</h2>
                        </div>
                    </div>
            </header>

            <main>
            <?php
           echo"<table class='table table-bordered table-hover table-dark'>
           <thead>
             <tr>
             <th scope='col'>ID</th>
             <th scope='col'>Fullname</th>
             <th scope='col'>Contact No.</th>
             <th scope='col'>Email</th>
             <th scope='col'>Gender</th>
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
                $fname = $row['f_name'];
                $last_name =$row['l_name'];
                $pnumber =$row['contact_number'];
                $email =$row['email'];
                $id = $row['id'];
                $gender =$row['gender'];
                echo"
                <tr> 
                    <td>$id</td>
                    <td>$fname $last_name</td>
                    <td>$pnumber</td>
                    <td>$email</td>
                    <td>$gender</td>     
                </tr>";
            }
        }
           echo"</table>";  
           ?>
                </div>
            </main>

</body>
</html>