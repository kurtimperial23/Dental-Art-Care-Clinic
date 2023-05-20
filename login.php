<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>

        <link rel="stylesheet" href="/DACclinic/css/login.css" />

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous" />
    </head>
    <body>
        <main>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-4 col-6-xl col-7-lg col-8-md">
                        <div class="text-center py-2">
                            <img src="/DACclinic/images/test.png" alt="" />
                            <h2 class="py-1">Dental Art Care Clinic</h2>
                        </div>

                        <form action="/DACclinic/processes/login.php" method="post">
                            <div class="row login wrapper flex-column d-flex justify-content-center">
                                <div class="col text-center"></div>
                                <div class="col d-flex justify-content-center">
                                    <input type="text" name="txtuser" id="name" placeholder="Enter your username" />
                                </div>
                                <div class="col d-flex justify-content-center">
                                    <input type="password" name="txtpass" id="pass" placeholder="Enter your password" />
                                </div>
                                <div class="col button d-flex align-items-center">
                                    <input class="mx-auto" type="submit" name="submit" value="LOGIN" />
                                </div>
                                <div class="col text-center">
                                    <p>Click <a href="/DACclinic">HERE</a> to go back to the homepage.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="/DACclinic/script.js"></script>
</html>
