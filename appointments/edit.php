<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");


// GET APPOINTMENT ID

if (!isset($_GET['id'])) {

    header("Location: index.php");
    exit();

}

$id = $_GET['id'];


// GET APPOINTMENT

$sql = "SELECT
            appointments.*,
            patients.name AS patient_name,
            doctors.name AS doctor_name,
            doctors.specialization

        FROM appointments

        INNER JOIN patients
        ON appointments.patient_id = patients.id

        INNER JOIN doctors
        ON appointments.doctor_id = doctors.id

        WHERE appointments.id = ?";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) == 0) {

    header("Location: index.php");
    exit();

}


$appointment = mysqli_fetch_assoc($result);

?>

<link rel="stylesheet" href="../assets/css/appointments.css">


<div class="appointment-page">


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Edit Appointment
            </h1>

            <p class="page-subtitle">
                Update appointment information
            </p>

        </div>


        <a
            href="index.php"
            class="back-btn">

            <i class="bi bi-arrow-left"></i>

            Go Back

        </a>

    </div>


    <!-- FORM CARD -->
        <!-- ================= ERROR MESSAGE ================= -->

        <?php if(isset($_SESSION['error'])){ ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <?php echo $_SESSION['error']; ?>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        <?php

            unset($_SESSION['error']);

        }

        ?>

    <div class="edit-card">


        <!-- PATIENT + DOCTOR -->

        <div class="patient-doctor">


            <div class="info-box">

                <div class="info-title">
                    Patient
                </div>

                <div class="info-value">

                    <i class="bi bi-person-circle"></i>

                    <?php
                    echo $appointment['patient_name'];
                    ?>

                </div>

            </div>


            <div class="info-box">

                <div class="info-title">
                    Doctor
                </div>

                <div class="info-value">

                    <i class="bi bi-person-badge"></i>

                    Dr.

                    <?php
                    echo $appointment['doctor_name'];
                    ?>

                </div>

            </div>

        </div>


        <!-- FORM -->

        <form
            action="../queries/query.php"
            method="POST">


            <input
                type="hidden"
                name="id"
                value="<?php echo $appointment['id']; ?>"
            >


            <!-- DATE + TIME -->

            <div class="form-row">


                <div class="form-group">

                    <label>

                        <i class="bi bi-calendar3"></i>

                        Appointment Date

                    </label>

                    <input
                        type="date"
                        name="appointment_date"
                        class="form-control"
                        value="<?php echo $appointment['appointment_date']; ?>"
                        
                    >

                </div>


                <div class="form-group">

                    <label>

                        <i class="bi bi-clock"></i>

                        Appointment Time

                    </label>

                    <input
                        type="time"
                        name="appointment_time"
                        class="form-control"
                        value="<?php echo $appointment['appointment_time']; ?>"
                        
                    >

                </div>

            </div>


            <!-- REASON -->

            <div class="form-group">

                <label>

                    <i class="bi bi-chat-left-text"></i>

                    Reason for Appointment

                </label>

                <textarea
                    name="reason"
                    class="form-control"
                    
                ><?php echo $appointment['reason']; ?></textarea>

            </div>


            <!-- STATUS -->

            <div class="form-group">

                <label>

                    <i class="bi bi-flag"></i>

                    Appointment Status

                </label>


                <select
                    name="status"
                    class="form-select"
                    >


                    <option
                        value="Pending"
                        <?php
                        if ($appointment['status'] == "Pending") {
                            echo "selected";
                        }
                        ?>
                    >

                        Pending

                    </option>


                    <option
                        value="Confirmed"
                        <?php
                        if ($appointment['status'] == "Confirmed") {
                            echo "selected";
                        }
                        ?>
                    >

                        Confirmed

                    </option>


                    <option
                        value="Completed"
                        <?php
                        if ($appointment['status'] == "Completed") {
                            echo "selected";
                        }
                        ?>
                    >

                        Completed

                    </option>


                    <option
                        value="Cancelled"
                        <?php
                        if ($appointment['status'] == "Cancelled") {
                            echo "selected";
                        }
                        ?>
                    >

                        Cancelled

                    </option>


                </select>

            </div>


            <!-- BUTTONS -->

            <div class="button-group">


                <a
                    href="index.php"
                    class="back-btn">

                    <i class="bi bi-arrow-left"></i>

                    Cancel

                </a>


                <button
                    type="submit"
                    name="appointment_edit"
                    class="update-btn">

                    <i class="bi bi-check-circle"></i>

                    Update Appointment

                </button>


            </div>


        </form>

    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>