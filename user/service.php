<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dental Art and Care Clinic</title>

        <link rel="stylesheet" href="/DACclinic/styles.css" />
        <link rel="stylesheet" href="/DACclinic/css/services.css" />

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous" />
    </head>
    <body>
        <header id="mySidenav">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="logo">
                    <h4>Dental Art Care Clinic</h4>
                </div>
                <nav>
                    <ul class="d-flex flex-column flex-md-row">
                        <li><a href="/DACclinic/index.html">Home</a></li>
                        <li>
                            <a href="/DACclinic/user/service.php" class="active">Services</a>
                        </li>
                        <li>
                            <a href="/DACclinic/user/appointment.php">Appointment</a>
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
                <div class="row flex-column d-flex justify-content-center align-items-center">
                    <div class="col-6 description">
                        <h2>Smile like never before</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <main>
            <section id="services">
                <div class="container">
                    <div class="row flex-column justify-content-center">
                        <div class="col pb-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-4">
                                    <img src="/DACclinic/images/general_dent.webp" alt="" class="img-fluid" />
                                </div>
                                <div class="col-5">
                                    <h1>General Dentistry</h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <div class="text-center">
                                        <a type="button" class="btn btn-outline-light px-5" href="/DACclinic/user/general_dentistry.php"> Book Now! </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col pb-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-4">
                                    <img class="img-fluid" src="/DACclinic/images/restorative_dent.webp" alt="" />
                                </div>
                                <div class="col-5">
                                    <h1>Restorative Dentistry</h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <div class="text-center">
                                        <a type="button" class="btn btn-outline-light px-5" href="/DACclinic/user/restorative_dentistry.php"> Book Now! </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col pb-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-4">
                                    <img src="/DACclinic/images/periodontics.jpg" alt="" class="img-fluid" />
                                </div>
                                <div class="col-5 d-flex flex-column">
                                    <h1>Periodontics</h1>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <div class="text-center">
                                        <a type="button" class="btn btn-outline-light px-5"  href="/DACclinic/user/periodontics.php"> Book Now! </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php include 'includes/footer.php';?>

        <script src="/DACclinic/script.js"></script>
    </body>
</html>
