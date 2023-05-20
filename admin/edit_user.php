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

//get id from url based on record 
    $id = '';

    if(isset($_GET['id'])) $id = $_GET['id'];

//select the record with a specific id
    $sql = "SELECT * FROM tbl_user WHERE id = $id";

//execute the statement
    $result = mysqli_query($con, $sql);
    $firstname = '';
    $lastname = '';
    $username = '';
    $password = '';
    $role = '';

while($row = mysqli_fetch_array($result)) {
    $firstname = $row['first_name'];
    $lastname = $row['last_name'];
    $username = $row['username'];
    $password = $row['password'];
    $role = $row['user_role'];
}

if (isset($_POST['submit']) && $password != $_POST['txtpassverify']) {
    echo "Your passwords don't match";
    exit();
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
                        <h2>Edit Users</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">
            <h1>Edit User Information</h1>
            <form action="/DACclinic/processes/edit_user_process.php" method="post">
            <input type="hidden" name="txtid" value="<?php echo $id;?>">
                <div class="row">
                    <div class="col"><label for="txtfname">First Name:</label></div>
                    <div class="col"><label for="txtlname">Last Name:</label></div>
                </div>

                <div class="row">
                    <div class="col"><input type="text" name="txtfname" id="fname" required value="<?php echo $firstname;?>"/></div>
                    <div class="col"><input type="text" name="txtlname" id="lname" required value="<?php echo $lastname;?>"/></div>
                </div>

                <div class="row">
                    <div class="col"><label for="txtuser">Username:</label></div>
                    <div class="col"><label for="txtpass">Password:</label></div>
                </div>

                <div class="row">
                    <div class="col"><input type="text" name="txtuser" id="user" required value="<?php echo $username;?>"></div>
                    <div class="col"><input type="password" name="txtpass" id="pass" required></div>
                </div>

                <div class="row">
                    <div class="col"><label for="txtrole">User role:</label></div>
                    <div class="col"><label for="txtpassverify">Verify password:</label></div>
                </div>

                <div class="row">
                    <div class="col">
                        <select name="txtrole" id="dropdown">
                            <option value="admin">Admin</option>
                            <option value="dentist">Dentist</option>
                            <option value="assistant">Assistant</option>
                        </select>
                    </div>
                    <div class="col"><input type="password" name="txtpassverify" id="passverify" required></div>
                </div>

                <div class="row pt-5 pb-2">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-lg" name="submit" value="Edit Person">
                    </div>
                </div>
            </form>

            <h5><a  class="btn btn-primary btn-lg" href="/DACclinic/admin/view_users.php">Back</a></h5>
        </div>
    </main>
</body>
</html>