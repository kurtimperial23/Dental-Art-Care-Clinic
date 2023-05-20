<?php                     
    // prepare database connection
    $hostNAME = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "dbdacc";

    // connect to database
    $con = mysqli_connect($hostNAME, $hostUsername, $hostPassword, $hostDB) or die("Error in Database Connection...");

    // prepare SQL statement to fetch start and end times from tbl_dentists
    $sql2 = "SELECT id FROM tbl_dentist";
    $result2 = mysqli_query($con, $sql2) or die("Error in executing SELECT statement");

    if (mysqli_num_rows($result2) == 0) {
        echo "No dentists";
    } else {
        $row2 = mysqli_fetch_assoc($result2);
        $id = $row2['id'];

        $sql = "SELECT starttime, endtime FROM tbl_dentist WHERE id = $id"; // replace 2 with the ID of the dentist you want to get the times for
        $result = mysqli_query($con, $sql);

        // check if the query returned any rows
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // get the start and end times from the row
            $starttime = $row['starttime'];
            $endtime = $row['endtime'];

            // generate a list of time options from the start time to end time
            $time_options = '';
            $time = new DateTime($starttime);
            $end_time = new DateTime($endtime);
            $interval = new DateInterval('PT1H'); // set the time interval to 1 hour
            while ($time <= $end_time) {
                $time_options .= '<option value="' . $time->format('H:i') . '">' . $time->format('h:i A') . '</option>';
                $time->add($interval);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dental Art and Care Clinic</title>

        <link rel="stylesheet" href="/DACclinic/styles.css" />  
        <link rel="stylesheet" href="/DACclinic/css/appointment.css" />

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous" />
    </head>

    <body>
    <header id="mySidenav">
            <div
                class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="logo">
                    <h4>Dental Art Care Clinic</h4>
                </div>
                <nav>
                    <ul class="d-flex flex-column flex-md-row">
                        <li><a href="/DACclinic/index.html">Home</a></li>
                        <li>
                            <a href="/DACclinic/user/service.php">Services</a>
                        </li>
                        <li>
                            <a href="/DACclinic/user/appointment.php" class="active"
                                >Appointment</a
                            >
                        </li>
                        <li>
                            <a href="/DACclinic/user/aboutUs.php">About Us</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <section>
            <div class="openSidebar d-flex justify-content-between">
                <img src="/DACclinic/images/—Pngtree—abstract tooth dental logo_5569405 1 (1).png" alt="" />
                <i class="fa-solid fa-bars" onclick="openNav()"></i>
            </div>
        </section>

        <section class="bg-top">
            <div class="container">
                <div
                    class="row flex-column d-flex justify-content-center align-items-center">
                    <div class="col-6 description">
                        <h2>Smile like never before</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <main >
            <div class="container pt-5">
                <div class="row d-flex justify-content-center align-items-centerflex-column">
              
                    <div class="col-7 wrapper p-5">
                        <h4 class="text-center">Schedule an Appointment</h4>
                        <hr>
                        <form action="/DACclinic/processes/add_appointment.php" method="post">
                            <div class="row">
                                <div class="col"><label for="txtfname">First Name:</label></div>
                                <div class="col"><label for="txtlname">Last Name:</label></div>
                            </div>

                            <div class="row">
                                <div class="col"><input type="text" name="txtfname" id="fname" required /></div>
                                <div class="col"><input type="text" name="txtlname" id="lname" required /></div>
                            </div>

                            <div class="row">
                                <div class="col"><label for="txtnumber">Contact Number:</label></div>
                                <div class="col"><label for="txtemail">Email:</label></div>
                            </div>

                            <div class="row">
                                <div class="col"><input type="number" name="txtnumber" id="pnumber" required /></div>
                                <div class="col"><input type="email" name="txtemail" id="email" required /></div>
                            </div>

                            <div class="row">
                                <div class="col"><label for="txtnumber">New Patient:</label></div>
                                <div class="col"><label for="txtemail">Gender:</label></div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <select name="txtpatient" id="patient"  required>
                                        <option value="">-- New Patient --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>

                                </div>
                                <div class="col">
                                    <select name="txtgender" id="gender"  required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col"><label for="txtservice">Service Required</label></div>
                            <div class="col"><label for="txtdentist">Dentists</label></div>
                                    
                            </div>

                            <div class="row">
                                <div class="col">
                                    <select name="txtservice" id="service" onchange="updatePrice()" required>
                                        <option value="">-- Select Service --</option>
                                        <?php
                                            // Query the tbl_service table to get the list of services
                                            $query = "SELECT * FROM tbl_service";
                                            $result = mysqli_query($con, $query);

                                            // Loop through the results and create an option element for each service
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['service_name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="txtdentist" id="dentist"  onchange="updateSchedule()" required>
                                    <option value="">-- Select Dentist --</option>
                                        <?php
                                        // Query the tbl_dentist table to get the list of dentists
                                        $query = "SELECT * FROM tbl_dentist";
                                        $result = mysqli_query($con, $query);

                                        // Loop through the results and create an option element for each dentist
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['id'] . '">' . 'Dr. ' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
                                        }
                                        ?>
                                    </select>   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col"><label for="txtnumber">Select Appointment Date:</label></div>
                                <div class="col"><label for="txtemail">Select Appointment Time:</label></div>
                            </div>

                            <div class="row">
                                <div class="col"><input type="date" id="date" name="txtdate" /></div>
                                <div class="col">
                                <select id="txttime" name="txttime" required>
                                    <?php echo $time_options; ?>
                                </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col"><label for="price">Price:</label></div>
                            </div>

                            <div class="row">
                                <div class="col"><input type="text" id="price" name="txtprice" readonly /></div>
                            </div>

                            <div class="row">
                                <div class="col"><label for="comments">Comments</label></div>
                            </div>

                            <div class="row">
                                <div class="col text-center"><textarea name="txtcomment" id="comment"></textarea></div>
                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <input type="submit" name="submit" class="btn btn-outline-light" value="Schedule an Appointment"></div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </main>

        <?php include 'includes/footer.php';?>

        <script src="/DACclinic/script.js"></script>
    </body>
</html>

