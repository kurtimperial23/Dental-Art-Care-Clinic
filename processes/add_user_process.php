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

    //check if submit button is clicked
    if (isset($_POST["submit"])) {

        //prepare database connection
        $hostNAME = "localhost";
        $hostUsername = "root";
        $hostPassword = "";
        $hostDB = "dbdacc";

        //connect to database
        $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");
                
        //get value from textfield 
        $fname = $_POST['txtfname'];
        $last_name = $_POST['txtlname'];
        $username = $_POST['txtuser'];
        $password = $_POST['txtpass'];
        $user_role = $_POST['txtrole'];
        $verify = $_POST['txtpassverify'];
        
        // check if passwords match
        if ($password != $verify) {
            header("Location: /DACclinic/error_handling/password_notmatched.php");
            exit();
        }
        //encrypt password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // check user role and insert data into appropriate tables
        if ($user_role == "admin") {
            // prepare sql statement to add admin to tbl_user
            $sql = "INSERT INTO tbl_user (username, password, user_role, first_name, last_name) VALUES ('$username', '$hashed_password', '$user_role', '$fname', '$last_name')";

            // execute insertion of records into tbl_user
            $result = mysqli_query($con, $sql) or die("Error in insert statement and query execution");

            if (!$result) {
                header("Location: /DACclinic/error_handling/error_inserting_data.php");
                exit();
                
            } else {
                header("Location: /DACclinic/error_handling/user_added.php");
                exit();
            }

        } elseif ($user_role == "dentist") {
            $email = $_POST['txtemail'];
            $contact = $_POST['txtpnumber'];
            $starttime = $_POST['txtstarttime'];
            $endtime = $_POST['txtendtime'];
            
            // prepare sql statement to add dentist to tbl_user
            $sql = "INSERT INTO tbl_user (username, password, user_role, first_name, last_name) VALUES ('$username', '$hashed_password', '$user_role', '$fname', '$last_name')";
            
            // execute insertion of records into tbl_user
            $result = mysqli_query($con, $sql) or die("Error in insert statement and query execution");

            // get the user_id of the newly inserted dentist record in tbl_user
            $user_id = mysqli_insert_id($con);

            // prepare sql statement to add dentist to tbl_dentist
            $sql2 = "INSERT INTO tbl_dentist (user_id, email, contact, starttime, endtime, first_name, last_name) VALUES ('$user_id', '$email', '$contact', '$starttime', '$endtime', '$fname', '$last_name')";
            
            // execute insertion of records into tbl_dentist
            $result2 = mysqli_query($con, $sql2) or die("Error in insert statement and query execution");

            // check if data is successfully added to tbl_dentist
            if (!$result2) {
                header("Location: /DACclinic/error_handling/error_inserting_data.php");
                exit();
            } else {
                header("Location: /DACclinic/error_handling/user_added.php");
                exit();
            }
        } elseif ($user_role == "assistant") {
            $email = $_POST['txtemail'];
            $contact = $_POST['txtpnumber'];
            
            //prep sql statements to add assistant to tbl_user
            $sql = "INSERT INTO tbl_user (username, password, user_role, first_name, last_name) VALUES ('$username', '$hashed_password', '$user_role', '$fname', '$last_name')";

            // execute insertion of records into tbl_user
            $result = mysqli_query($con, $sql) or die("Error in insert statement and query execution");

            $user_id = mysqli_insert_id($con);
            
            //prep sql statements to add assistant to tbl_assistant
            $sql2 = "INSERT INTO tbl_assistant (user_id, email, contact, first_name, last_name) VALUES ('$user_id', '$email', '$contact', '$fname', '$last_name')";

            // execute insertion of records into tbl_assistant
            $result2 = mysqli_query($con, $sql2) or die("Error in insert statement and query execution");

            if (!$result2) {
                header("Location: /DACclinic/error_handling/error_inserting_data.php");
                exit();
            } else {
                header("Location: /DACclinic/error_handling/user_added.php");
                exit();
            }
        } 
    }
    ?>