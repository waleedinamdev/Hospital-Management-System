<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/index_header.php");
include_once("../includes/navbar/index_navbar.php");


$email = $_SESSION['user_email'];

$sql = "SELECT appointments.id, appointments.appointment_date,appointments.appointment_time,
appointments.reason, appointments.status,
    doctors.name AS doctor_name, doctors.specialization
    FROM appointments
    INNER JOIN patients ON appointments.patient_id = patients.id
    INNER JOIN doctors ON appointments.doctor_id = doctors.id
    WHERE patients.email = ?
    ORDER BY appointments.appointment_date DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f6fbfc;
            color: #183b4a;
        }

        .appointment-container {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title h1 {
            color: #066B76;
            margin-bottom: 8px;
        }

        .page-title p {
            color: #81939a;
            font-size: 14px;
        }

        .appointment-card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .appointment-header h3 {
            color: #066B76;
            font-size: 19px;
            margin: 0;
        }

        .status {
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .confirmed {
            background: #d1e7dd;
            color: #0f5132;
        }

        .cancelled {
            background: #f8d7da;
            color: #842029;
        }

        .completed {
            background: #cfe2ff;
            color: #084298;
        }

        .appointment-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-box {
            background: #f6fbfc;
            padding: 12px;
            border-radius: 8px;
        }

        .info-box strong {
            display: block;
            color: #36525b;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .info-box span {
            font-size: 14px;
        }

        .reason {
            margin-top: 15px;
            padding: 15px;
            background: #f1f8f9;
            border-radius: 8px;
        }

        .reason p {
            margin: 5px 0 0;
            color: #52717a;
            font-size: 13px;
        }

        .no-appointment {
            background: white;
            text-align: center;
            padding: 50px 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .no-appointment i {
            font-size: 45px;
            color: #066B76;
        }

        .no-appointment h3 {
            margin-top: 15px;
        }

        .no-appointment p {
            color: #81939a;
            font-size: 13px;
        }

        .book-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 20px;
            background: #066B76;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
        }

        .book-btn:hover {
            background: #04545d;
        }

        @media (max-width: 600px) {

            .appointment-info {
                grid-template-columns: 1fr;
            }

            .appointment-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

        }

    </style>

</head>

<body>

<div class="appointment-container">

    <div class="page-title">

        <h1>
            <i class="bi bi-calendar-check"></i>
            My Appointments
        </h1>

        <p>
            View your booked appointments and their status.
        </p>

    </div>


    <?php if (mysqli_num_rows($result) > 0) { ?>

        <?php while ($appointment = mysqli_fetch_assoc($result)) { ?>

            <div class="appointment-card">

                <div class="appointment-header">

                    <h3>
                        <i class="bi bi-person-badge"></i>

                        Dr. <?php echo $appointment['doctor_name']; ?>

                    </h3>

                    <span class="status <?php echo strtolower($appointment['status']); ?>">

                        <?php echo $appointment['status']; ?>

                    </span>

                </div>


                <div class="appointment-info">

                    <div class="info-box">

                        <strong>Specialization</strong>

                        <span>
                            <?php echo $appointment['specialization']; ?>
                        </span>

                    </div>


                    <div class="info-box">

                        <strong>Appointment Date</strong>

                        <span>

                            <i class="bi bi-calendar"></i>

                            <?php echo $appointment['appointment_date']; ?>

                        </span>

                    </div>


                    <div class="info-box">

                        <strong>Appointment Time</strong>

                        <span>

                            <i class="bi bi-clock"></i>

                            <?php echo $appointment['appointment_time']; ?>

                        </span>

                    </div>

                </div>


                <div class="reason">

                    <strong>

                        <i class="bi bi-chat-left-text"></i>

                        Reason

                    </strong>

                    <p>

                        <?php echo $appointment['reason']; ?>

                    </p>

                </div>

            </div>

        <?php } ?>


    <?php } else { ?>

        <div class="no-appointment">

            <i class="bi bi-calendar-x"></i>

            <h3>
                No Appointments Found
            </h3>

            <p>
                You have not booked any appointment yet.
            </p>

            <a href="appointment_book.php" class="book-btn">


                Book Appointment

            </a>

        </div>

    <?php } ?>

</div>

</body>

</html>

<?php

mysqli_stmt_close($stmt);
include_once("../includes/auth.php");

?>