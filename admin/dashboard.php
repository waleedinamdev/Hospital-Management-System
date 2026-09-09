<?php
include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");

// Total Patients //

$totalPatients_Query = "SELECT COUNT(*) AS total_Patients FROM patients";

$stmt = mysqli_prepare($conn, $totalPatients_Query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$totalPatients = mysqli_fetch_assoc($result);


// Total Doctors //

$totalDoctors_Query = "SELECT COUNT(*) AS total_Doctors FROM doctors";

$stmt = mysqli_prepare($conn, $totalDoctors_Query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$totalDoctors = mysqli_fetch_assoc($result);

// Total Apppointments //

$totalAppointments_Query = "SELECT COUNT(*) AS total_Appointments FROM appointments";

$stmt = mysqli_prepare($conn, $totalAppointments_Query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$totalAppointments = mysqli_fetch_assoc($result);

// Pending Apppointments //

$pendingAppointments_Query = "SELECT COUNT(*) AS pending_Appointments FROM appointments where status='Pending'";

$stmt = mysqli_prepare($conn, $pendingAppointments_Query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$pendingAppointments = mysqli_fetch_assoc($result);

// Completed Apppointments //

$completedAppointments_Query = "SELECT COUNT(*) AS completed_Appointments FROM appointments where status='Completed'";

$stmt = mysqli_prepare($conn, $completedAppointments_Query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$completedAppointments = mysqli_fetch_assoc($result);

?>



<!-- ================================================= -->
<!-- MAIN CONTENT -->
<!-- ================================================= -->

<main class="main-content">

<?php
// echo "<pre>";
// print_r($totalPatients);
// echo "</pre>";
// ?>
    <!-- TOPBAR -->

    <div class="topbar">

        <div class="page-title">

            <h2>Dashboard</h2>

            <p>
                Hospital / Clinic Management System
            </p>

        </div>

    </div>


    <!-- WELCOME -->

    <div class="welcome-card">

        <div>

            <h1>
                Welcome Back,
                <span><?php echo $_SESSION['user_name']; ?></span>
            </h1>

            <p>
                Here's what's happening in your hospital today.
            </p>

        </div>


        <div class="welcome-icon">

            <i class="fa-solid fa-hospital"></i>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- STATISTICS -->
    <!-- ================================================= -->

    <div class="row g-4">


        <!-- PATIENTS -->

        <div class="col-xl-3 col-md-6 ">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa-solid fa-hospital-user"></i>

                </div>

                 <h3><?php echo $totalPatients['total_Patients']?></h3>

                <p>Total Patients</p>

            </div>

        </div>


        <!-- DOCTORS -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa-solid fa-user-doctor"></i>

                </div>

                <h3><?php echo $totalDoctors['total_Doctors']?></h3>

                <p>Total Doctors</p>

            </div>

        </div>


        <!-- APPOINTMENTS -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa-solid fa-calendar-check"></i>

                </div>

                <h3><?php echo $totalAppointments['total_Appointments'];?></h3>

                <p>Total Appointments</p>

            </div>

        </div>


        <!-- PENDING -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <h3><?php echo $pendingAppointments['pending_Appointments'];?></h3>

                <p>Pending Appointments</p>

            </div>

        </div>


         <!-- COMPLETED -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon">

                  <i class="fa-solid fa-circle-check"></i>
                </div>

                <h3><?php echo $completedAppointments['completed_Appointments'];?></h3>

                <p>Completed</p>

            </div>

        </div>

    </div>


  


</main>


</body>

</html>