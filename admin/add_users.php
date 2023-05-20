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
                        <h2>Add Users</h2>
                        </div>
                    </div>
            </header>
    <main>
        <div class="container">
            <form action="/DACclinic/processes/add_user_process.php" method="post">
                <h1>Personal Information</h1>
                <div class="row">
                    <div class="col"><label for="txtfname">First Name:</label></div>
                    <div class="col"><label for="txtlname">Last Name:</label></div>
                </div>
                
                <div class="row">
                    <div class="col"><input type="text" name="txtfname" id="fname" required /></div>
                    <div class="col"><input type="text" name="txtlname" id="lname" required /></div>
                </div>

                <div class="row">
                    <div class="col"><label for="txtemail">Email:</label></div>
                    <div class="col"><label for="txtpnumber">Contact Number:</label></div>
                </div>
                
                <div class="row">
                    <div class="col"><input type="email" name="txtemail" id="email" required/></div>
                    <div class="col"><input type="number" name="txtpnumber" id="pnumber"/></div>
                </div>

                <div class="row">
                    <div class="col"><label for="txtstarttime">Start of shift:(dentists only)</label></div>
                    <div class="col"><label for="txtendtime">End of shift:(dentists only)</label></div>
                </div>

                <div class="row">
                    <div class="col"><input type="time" name="txtstarttime" id="start" value="<?php echo date('H:00', strtotime('+2 hour')); ?>"/></div>
                    <div class="col"><input type="time" name="txtendtime" id="end" value="<?php echo date('H:00', strtotime('+9 hour')); ?>"/></div>
                </div>

                <h1>Account Information</h1>
                <div class="row">
                    <div class="col"><label for="txtuser">Username:</label></div>
                    <div class="col"><label for="txtpass">Password:</label></div>
                </div>

                <div class="row">
                    <div class="col"><input type="text" name="txtuser" id="user" required></div>
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
                        <input type="submit" class = "btn btn-success btn-lg" name="submit" value="Add Person">
                    </div>
                </div>
            </form>
            <h5><a  class="btn btn-primary btn-lg" href="/DACclinic/admin/admin_dashboard.php">Back</a></h5>
        </div>
    </main>
</body>
</html>