<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/medical_header.php");


// ================= PAGINATION =================

$page = 1;
$limit = 3;

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;


// ================= SEARCH =================

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}


// ================= GET MEDICAL RECORDS =================

if($search != ""){

    $searchValue = "%" . $search . "%";

    $sql = "SELECT medical_records.*,
                   patients.name AS patient_name,
                   doctors.name AS doctor_name
            FROM medical_records
            INNER JOIN patients
            ON medical_records.patient_id = patients.id
            INNER JOIN doctors
            ON medical_records.doctor_id = doctors.id
            WHERE patients.name LIKE ?
            OR doctors.name LIKE ?
            OR medical_records.diagnosis LIKE ?
            OR medical_records.symptoms LIKE ?
            OR medical_records.prescription LIKE ?
            ORDER BY medical_records.id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $totalpages = 0;

}else{

    $sql = "SELECT medical_records.*,
                   patients.name AS patient_name,
                   doctors.name AS doctor_name
            FROM medical_records
            INNER JOIN patients
            ON medical_records.patient_id = patients.id
            INNER JOIN doctors
            ON medical_records.doctor_id = doctors.id
            ORDER BY medical_records.id DESC
            LIMIT $offset,$limit";

    $result = mysqli_query($conn, $sql);


    // ================= TOTAL RECORDS =================

    $countSql = "SELECT COUNT(*) AS total FROM medical_records";

    $countResult = mysqli_query($conn, $countSql);

    $countData = mysqli_fetch_assoc($countResult);

    $totalRecords = $countData['total'];

    $totalpages = ceil($totalRecords / $limit);
}

?>


<!-- ================= MEDICAL RECORDS PAGE ================= -->

<div class="medical-records-page">

    <div class="medical-container">


        <!-- PAGE HEADER -->

        <div class="medical-page-header">

            <div style=" bacground-color:none;">

                <h2 class="medical-page-title">
                    Medical Records
                </h2>

                <p class="medical-page-subtitle">
                    Manage patient medical records
                </p>

            </div>


            <a href="add.php" class="medical-btn-add">

                <i class="fa-solid fa-plus"></i>

                Add Medical Record

            </a>

        </div>


        <!-- SEARCH -->

        <div class="medical-search-card">

            <form method="GET">

                <div class="row g-3 align-items-center">

                    <div class="col-md-8">

                        <input
                            type="text"
                            name="search"
                            class="form-control medical-search-input"
                            placeholder="Search patient, doctor, diagnosis..."
                            value="<?php echo $search; ?>"
                        >

                    </div>


                    <div class="col-md-4 medical-search-buttons">

                        <button
                            type="submit"
                            class="medical-btn-search"
                        >

                            <i class="fa-solid fa-magnifying-glass"></i>

                            Search

                        </button>


                        <a
                            href="index.php"
                            class="medical-btn-reset"
                        >

                            <i class="fa-solid fa-rotate-left"></i>

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>


        <!-- SUCCESS MESSAGE -->

        <?php if(isset($_SESSION['success'])){ ?>

            <div class="alert alert-info alert-dismissible fade show">

                <?php echo $_SESSION['success']; ?>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        <?php

            unset($_SESSION['success']);

        }

        ?>


        <!-- MEDICAL CARD -->

        <div class="medical-record-card">


            <!-- CARD HEADER -->

            <div class="medical-record-header">

                <div>

                    <h3>
                        Medical Records
                    </h3>

                    <small>
                        All patient medical information
                    </small>

                </div>

            </div>


            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table align-middle medical-table">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Diagnosis</th>
                            <th>Symptoms</th>
                            <th>Prescription</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    if($result && mysqli_num_rows($result) > 0){

                        while($show = mysqli_fetch_assoc($result)){

                    ?>

                        <tr>

                            <td>
                                <?php echo $show['id']; ?>
                            </td>


                            <td>
                                <?php echo $show['patient_name']; ?>
                            </td>


                            <td>
                                Dr. <?php echo $show['doctor_name']; ?>
                            </td>


                            <td>

                                <span class="medical-diagnosis">

                                    <?php echo $show['diagnosis']; ?>

                                </span>

                            </td>


                            <td>

                                <?php echo $show['symptoms']; ?>

                            </td>


                            <td>

                                <?php echo $show['prescription']; ?>

                            </td>


                            <td>

                                <?php

                                echo date(
                                    "d M Y",
                                    strtotime($show['record_date'])
                                );

                                ?>

                            </td>


                            <td class="medical-actions">


                                <!-- EDIT -->

                                <a
                                    href="edit.php?id=<?php echo $show['id']; ?>"
                                    class="medical-edit-btn"
                                    title="Edit"
                                >

                                    <i class="fa-solid fa-pen-to-square"></i>

                                </a>


                                <!-- DELETE -->

                                <a
                                    href="../queries/query.php?medical_record_delete=<?php echo $show['id']; ?>"
                                    class="medical-delete-btn"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this medical record?')"
                                >

                                    <i class="fa-solid fa-trash-can"></i>

                                </a>


                            </td>

                        </tr>


                    <?php

                        }

                    }else{

                    ?>

                        <tr>

                            <td
                                colspan="8"
                                class="medical-no-data"
                            >

                                No Data Found

                            </td>

                        </tr>

                    <?php } ?>


                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->

            <?php if($totalpages > 0){ ?>

                <div class="medical-pagination">

                    <ul class="pagination">


                        <?php if($page > 1){ ?>

                            <li class="page-item">

                                <a
                                    class="page-link"
                                    href="index.php?page=<?php echo $page - 1; ?>"
                                >

                                    <i class="fa-solid fa-chevron-left"></i>

                                </a>

                            </li>

                        <?php } ?>


                        <?php

                        for($i = 1; $i <= $totalpages; $i++){

                        ?>

                            <li
                                class="page-item
                                <?php
                                if($page == $i){
                                    echo "active";
                                }
                                ?>"
                            >

                                <a
                                    class="page-link"
                                    href="index.php?page=<?php echo $i; ?>"
                                >

                                    <?php echo $i; ?>

                                </a>

                            </li>

                        <?php } ?>


                        <?php if($page < $totalpages){ ?>

                            <li class="page-item">

                                <a
                                    class="page-link"
                                    href="index.php?page=<?php echo $page + 1; ?>"
                                >

                                    <i class="fa-solid fa-chevron-right"></i>

                                </a>

                            </li>

                        <?php } ?>


                    </ul>

                </div>

            <?php } ?>


        </div>

    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>