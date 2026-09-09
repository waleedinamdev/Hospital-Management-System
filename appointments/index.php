<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/appointments_header.php");


// =====================================================
// SEARCH
// =====================================================

$search = "";

if(isset($_GET['search'])){
    $search = trim($_GET['search']);
}


// =====================================================
// PAGINATION
// =====================================================

$page = 1;
$limit = 5;

if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
}

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;


// =====================================================
// COUNT APPOINTMENTS
// =====================================================

$countSql = "SELECT COUNT(*) AS total
             FROM appointments
             INNER JOIN patients
             ON appointments.patient_id = patients.id
             INNER JOIN doctors
             ON appointments.doctor_id = doctors.id";


if($search){

    $countSql .= " WHERE patients.name LIKE ?
                   OR doctors.name LIKE ?
                   OR appointments.reason LIKE ?";

    $searchValue = "%$search%";

    $countStmt = mysqli_prepare($conn, $countSql);

    mysqli_stmt_bind_param(
        $countStmt,
        "sss",
        $searchValue,
        $searchValue,
        $searchValue
    );

}
else{

    $countStmt = mysqli_prepare($conn, $countSql);
}


mysqli_stmt_execute($countStmt);

$countResult = mysqli_stmt_get_result($countStmt);

$countData = mysqli_fetch_assoc($countResult);

$totalRecords = $countData['total'];

$totalPages = ceil($totalRecords / $limit);


// =====================================================
// GET APPOINTMENTS
// =====================================================

$sql = "SELECT appointments.*,
               patients.name AS patient_name,
               doctors.name AS doctor_name,
               doctors.specialization

        FROM appointments

        INNER JOIN patients
        ON appointments.patient_id = patients.id

        INNER JOIN doctors
        ON appointments.doctor_id = doctors.id";


if($search){

    $sql .= " WHERE patients.name LIKE ?
              OR doctors.name LIKE ?
              OR appointments.reason LIKE ?";
}


$sql .= " ORDER BY appointments.appointment_date DESC,
                   appointments.appointment_time DESC

          LIMIT $offset, $limit";


$stmt = mysqli_prepare($conn, $sql);


if($search){

    $searchValue = "%$search%";

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $searchValue,
        $searchValue,
        $searchValue
    );

}


mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>


<div class="appointment-page">


    <div class="page-header">

        <div>

            <h1 class="page-title">
                Appointments
            </h1>

            <p class="page-subtitle">
                Manage hospital appointments
            </p>

        </div>

    </div>


    <!-- SUCCESS MESSAGE -->

    <?php if(isset($_SESSION['appointment_success'])){ ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?php

            echo $_SESSION['appointment_success'];

            unset($_SESSION['appointment_success']);

            ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php } ?>


    <!-- SEARCH -->

    <div class="filter-card">

        <div class="filter-title">

            <i class="bi bi-funnel-fill"></i>

            Search Appointments

        </div>


        <form
            method="GET"
            class="filter-form"
        >

            <input
                type="text"
                name="search"
                class="form-control w-50 filter-input"
                placeholder="Search patient, doctor or reason..."
                value="<?php echo ($search); ?>"
            >


            <button
                type="submit"
                class="filter-btn"
            >

                <i class="bi bi-search"></i>

                Search

            </button>


            <a
                href="index.php"
                class="reset-btn"
            >

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </a>

        </form>

    </div>


    <!-- TABLE -->

    <div class="table-card">


        <div class="table-header">

            <h2>
                Appointment List
            </h2>

            <p>
                All patient appointments
            </p>

        </div>


        <div class="table-responsive">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>


                <?php

                if(mysqli_num_rows($result) > 0){

                    while($appointment = mysqli_fetch_assoc($result)){

                ?>

                    <tr>


                        <!-- ID -->

                        <td>

                            <?php echo $appointment['id']; ?>

                        </td>


                        <!-- PATIENT -->

                        <td>

                            <div class="patient-box">

                                <span class="patient-name">

                                    <?php
                                    echo ($appointment['patient_name']);
                                    ?>

                                </span>

                            </div>

                        </td>


                        <!-- DOCTOR -->

                        <td>

                            <span class="doctor-name">

                                Dr.

                                <?php
                                echo ($appointment['doctor_name']);
                                ?>

                            </span>


                            <span class="specialization">

                                <?php
                                echo ($appointment['specialization']);
                                ?>

                            </span>

                        </td>


                        <!-- DATE -->

                        <td>

                            <span class="date-box">

                                <?php

                                echo date(
                                    "d M Y",
                                    strtotime(
                                        $appointment['appointment_date']
                                    )
                                );

                                ?>

                            </span>

                        </td>


                        <!-- TIME -->

                        <td>

                            <span class="time-box">

                                <?php

                                echo date(
                                    "h:i A",
                                    strtotime(
                                        $appointment['appointment_time']
                                    )
                                );

                                ?>

                            </span>

                        </td>


                        <!-- REASON -->

                        <td>

                            <?php
                            echo ($appointment['reason']);
                            ?>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <?php

                            $appointmentStatus = $appointment['status'];

                            $statusClass = strtolower($appointmentStatus);

                            ?>

                            <span
                                class="status <?php echo $statusClass; ?>"
                            >

                                <span class="status-dot"></span>

                                <?php
                                echo ($appointmentStatus);
                                ?>

                            </span>

                        </td>


                        <!-- ACTIONS -->

                        <td>

                            <div class="actions">


                                <!-- EDIT -->

                                <a
                                    href="edit.php?id=<?php echo $appointment['id']; ?>"
                                    class="action-btn edit"
                                    title="Edit"
                                >

                                    <i class="bi bi-pencil-square"></i>

                                </a>


                                <?php

                                if($appointment['status'] == "Pending"){

                                ?>


                                    <!-- APPROVE -->

                                    <a
                                        href="../queries/query.php?approve_appointment=<?php echo $appointment['id']; ?>"
                                        class="action-btn approve"
                                        title="Approve"
                                        onclick="return confirm('Are you sure you want to approve this appointment?');"
                                    >

                                        <i class="bi bi-check-circle"></i>

                                    </a>


                                    <!-- CANCEL -->

                                    <a
                                        href="../queries/query.php?cancel_appointment=<?php echo $appointment['id']; ?>"
                                        class="action-btn cancel"
                                        title="Cancel"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?');"
                                    >

                                        <i class="bi bi-x-circle"></i>

                                    </a>


                                <?php

                                }

                                elseif($appointment['status'] == "Confirmed"){

                                ?>


                                    <!-- COMPLETE -->

                                    <a
                                        href="../queries/query.php?complete_appointment=<?php echo $appointment['id']; ?>"
                                        class="action-btn complete"
                                        title="Complete"
                                        onclick="return confirm('Mark this appointment as completed?');"
                                    >

                                        <i class="bi bi-check2-all"></i>

                                    </a>


                                <?php

                                }

                                ?>


                                <!-- DELETE -->

                                <a
                                    href="../queries/query.php?appointment_delete=<?php echo $appointment['id']; ?>"
                                    class="action-btn delete"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this appointment?');"
                                >

                                    <i class="bi bi-trash"></i>

                                </a>


                            </div>

                        </td>


                    </tr>


                <?php

                    }

                }

                else{

                ?>


                    <!-- NO RECORDS -->

                    <tr>

                        <td
                            colspan="8"
                            class="empty"
                        >

                            <i class="bi bi-calendar-x"></i>

                            <strong>
                                No appointments found
                            </strong>

                            <span>
                                There are no appointments matching your search.
                            </span>

                        </td>

                    </tr>


                <?php

                }

                ?>


                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->

        <?php if(!$search && $totalPages > 1){ ?>

            <ul class="pagination justify-content-center mt-4 mb-4">


                <!-- PREVIOUS -->

                <?php if($page > 1){ ?>

                    <li class="page-item">

                        <a
                            class="page-link"
                            href="?page=<?php echo $page - 1; ?>"
                        >

                            <i class="bi bi-chevron-left"></i>

                        </a>

                    </li>

                <?php } ?>


                <!-- PAGE NUMBERS -->

                <?php for($i = 1; $i <= $totalPages; $i++){ ?>

                    <li
                        class="page-item <?php if($page == $i) echo 'active'; ?>"
                    >

                        <a
                            class="page-link"
                            href="?page=<?php echo $i; ?>"
                        >

                            <?php echo $i; ?>

                        </a>

                    </li>

                <?php } ?>


                <!-- NEXT -->

                <?php if($page < $totalPages){ ?>

                    <li class="page-item">

                        <a
                            class="page-link"
                            href="?page=<?php echo $page + 1; ?>"
                        >

                            <i class="bi bi-chevron-right"></i>

                        </a>

                    </li>

                <?php } ?>


            </ul>

        <?php } ?>


    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>