<?php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!-- ================= USER NAVBAR ================= -->

<header class="user-navbar">

    <!-- LOGO -->

    <a href="../hospital/index.php" class="navbar-logo">

        <img
            src="../assets/images/logo.png"
            alt="Hospital Management System"
        >

    </a>


    <!-- NAVIGATION -->

    <nav class="user-nav-links">


        <!-- BOOK APPOINTMENTS -->

        <a href="../hospital/appointment_book.php" class="active">

            <i class="fa-solid fa-calendar-check me-1"></i>

            Book Appointments

        </a>


        <!-- MY APPOINTMENTS -->

        <a
            href="/hospital/hospital/my_appointments.php"
            class="active"
        >

            <i class="fa-solid fa-calendar-check me-1"></i>

            My Appointments

        </a>


        <!-- PROFILE -->

        <div class="profile-menu">

            <button
                type="button"
                class="profile-btn"
            >

                <i class="fa-solid fa-circle-user"></i>

                <?php
                echo htmlspecialchars(
                    $_SESSION['user_name'] ?? 'Profile'
                );
                ?>

                <i class="fa-solid fa-chevron-down ms-1"></i>

            </button>


            <!-- PROFILE DROPDOWN -->

            <div class="profile-dropdown">


                <!-- MY PROFILE -->

                <a href="../hospital/profile.php">

                    <i class="fa-solid fa-user me-2"></i>

                    My Profile

                </a>


               


                <!-- LOGOUT -->

                <a
                    href="../logout.php"
                    class="logout"
                >

                    <i class="fa-solid fa-right-from-bracket me-2"></i>

                    Logout

                </a>

            </div>

        </div>


    </nav>

</header>