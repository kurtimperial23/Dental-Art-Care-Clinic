<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header id="mySidenav">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="logo">
            <h4>Dental Art Care Clinic</h4>
        </div>
        <nav>
            <ul class="d-flex flex-column flex-md-row">
                <li><a href="/DACclinic/index.html">Home</a></li>
                <li><a href="/DACclinic/user/service.php" <?php if ($current_page == 'service.php' || $current_page == 'general_dentistry.php' || $current_page == 'periodonticsd.php' || $current_page == 'restorative_dentistry.php') echo 'class="active"'; ?>>Services</a></li>
                <li><a href="/DACclinic/user/appointment.php" <?php if ($current_page == '/DACclinic/user/appointment.php') echo 'class="active"'; ?>>Appointment</a></li>
                <li><a href="/aboutUs.php" <?php if ($current_page == '/DACclinic/user/aboutUs.php') echo 'class="active"'; ?>>About Us</a></li>
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
