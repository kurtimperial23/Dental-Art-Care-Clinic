<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/DACclinic/styles.css" />
    <link rel="stylesheet" href="/DACclinic/css/appointment.css" /> 
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous" />
        <style>
            main {
                padding-top: 70px;
            }
        </style>
</head>
    <body>
    <?php include 'includes/front_end_header.php';?>
        <main>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-5 wrapper p-3">
                        <h4 class="text-center">Feedback Form</h4>
                        <hr>
                <form action="/DACclinic/processes/feedback_process.php" method="post">
                    <div class="row">
                        <div class="col"><label for="txtfullname">Fullname:</label></div>
                    </div>

                    <div class="row">
                        <div class="col"><input type="text" name="txtfullname" id="fname" required /></div>
                    </div>

                    <div class="row"> 
                        <div class="col"><label for="txtemail">Email:</label></div>
                    </div>

                    <div class="row">
                        <div class="col"><input type="email" name="txtemail" id="email" required></div>
                    </div>

                    <div class="row">
                        <div class="col"><label for="txtgender">Gender</label></div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <select name="txtgender" id="dropdown">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col"><label for="txtfeedback">Feedback:</label></div>
                    </div>

                    <div class="row">
                        <div class="col"><textarea name="txtfeedback" id="feedback"></textarea></div>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <input type="submit" class="btn btn-outline-light" name="submit" value="Submit Review">
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </main>

        <?php include 'includes/footer.php';?>
    </body>
</html>