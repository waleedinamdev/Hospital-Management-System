<?php 

include_once("../includes/auth.php"); 
include_once("../config/database.php"); 
include_once("../includes/header/index_header.php"); 
include_once("../includes/navbar/index_navbar.php"); 

?> 


<!-- ================= WELCOME ================= -->

<section class="welcome-section">

    <h2>

        Welcome Back, 

        <span>
            <?php echo $_SESSION['user_name']; ?>
        </span>

        👋

    </h2>


    <p>

        Manage your hospital and clinic activities
        easily from your dashboard.

    </p>

</section>



<!-- ================= SERVICES ================= -->

<section class="services-section">


    <div class="section-title">

        <h2>
            Our Services
        </h2>

        <p>
            Manage all hospital and clinic activities from one place.
        </p>

    </div>



    <div class="services-container">


        <!-- PATIENTS -->

        <a href="" class="service-card">

            <div class="service-icon">

                <i class="fa-solid fa-hospital-user"></i>

            </div>

            <h3>
                Patients
            </h3>

            <p>
                Add, view, edit, delete and search patient records.
            </p>

        </a>



        <!-- DOCTORS -->

        <a href="" class="service-card">

            <div class="service-icon">

                <i class="fa-solid fa-user-doctor"></i>

            </div>

            <h3>
                Doctors
            </h3>

            <p>
                Manage doctors, specializations and doctor information.
            </p>

        </a>



        <!-- APPOINTMENTS -->

        <a href="" class="service-card">

            <div class="service-icon">

                <i class="fa-solid fa-calendar-check"></i>

            </div>

            <h3>
                Appointments
            </h3>

            <p>
                Schedule and manage patient appointments with doctors.
            </p>

        </a>



        <!-- MEDICAL RECORDS -->

        <a href="" class="service-card">

            <div class="service-icon">

                <i class="fa-solid fa-file-medical"></i>

            </div>

            <h3>
                Medical Records
            </h3>

            <p>
                Manage diagnosis, symptoms, prescriptions
                and medical history.
            </p>

        </a>


    </div>

</section>