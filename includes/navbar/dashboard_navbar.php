<!-- ================================================= -->
<!-- SIDEBAR -->
<!-- ================================================= -->

<aside class="sidebar">


    <!-- LOGO -->

    <div class="sidebar-logo">

        <a href="../admin/dashboard.php">

            <img
                src="../assets/images/logo.png"
                alt="Hospital Management System"
            >

        </a>

    </div>


    <!-- MENU -->

    <div class="menu-title">
        Main Menu
    </div>


    <ul class="sidebar-menu">


        <!-- DASHBOARD -->

        <li>

            <a
                href="../admin/dashboard.php"
                class="active"
            >

                <i class="fa-solid fa-house"></i>

                <span>Dashboard</span>

            </a>

        </li>


        <!-- PATIENTS -->

        <li>

            <a href="../patients/index.php">

                <i class="fa-solid fa-hospital-user"></i>

                <span>Patients</span>

            </a>

        </li>


        <!-- DOCTORS -->

        <li>

            <a href="../doctors/index.php">

                <i class="fa-solid fa-user-doctor"></i>

                <span>Doctors</span>

            </a>

        </li>


        <!-- APPOINTMENTS -->

        <li>

            <a href="../appointments/index.php">

                <i class="fa-solid fa-calendar-check"></i>

                <span>Appointments</span>

            </a>

        </li>


        <!-- MEDICAL RECORDS -->

        <li>

            <a href="../medical_records/index.php">

                <i class="fa-solid fa-file-medical"></i>

                <span>Medical Records</span>

            </a>

        </li>

    </ul>


    <!-- PROFILE -->

    <div class="sidebar-bottom">

        <a
            href="../admin/admin_profile.php"
            class="profile-link"
        >

            <div class="profile-icon">

                <i class="fa-solid fa-circle-user"></i>

            </div>

            <div class="profile-text">

                <strong>My Profile</strong>

                <small>Manage account</small>

            </div>

        </a>



        <a
            href="../logout.php"
            class="profile-link"
        >

            <div class="profile-icon">

                <i class="fa-solid fa-right-from-bracket"></i>

            </div>

            <div class="profile-text">

                <strong>Logout</strong>

                <small>Sign out</small>

            </div>

        </a>

    </div>

</aside>