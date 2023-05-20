<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dental Art Care Clinic</title>

        <link rel="stylesheet" href="/DACclinic/css/error_handling.css" />

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous" />
    </head>
    <body>
        <main>
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center flex-column">
                    <div class="col-5 pb-5 text-center">
                        <h2>Error in updating a record</h2>
                        <br>
                        <h3>Press the Button to go back.</h3>
                        <a class="btn btn-primary" href="javascript:history.back()">HERE</a>
                    </div>
                </div>
             </div>
       </main>
       <script src="/DACclinic/script.js"></script>
    </body>
</html>
