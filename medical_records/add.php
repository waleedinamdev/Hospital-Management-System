<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/medical_header.php");


// ================= GET PATIENTS =================

$patients = mysqli_query(
    $conn,
    "SELECT id, name FROM patients ORDER BY name ASC"
);


// ================= GET DOCTORS =================

$doctors = mysqli_query(
    $conn,
    "SELECT id, name FROM doctors ORDER BY name ASC"
);

?>


<!-- ================= MEDICAL ADD PAGE ================= -->

<div class="medical-records-page">

    <div class="medical-container">


        <!-- ================= PAGE HEADER ================= -->

        <div class="medical-page-header">

            <div>

                <h2 class="medical-page-title">
                    Add Medical Record
                </h2>

                <p class="medical-page-subtitle">
                    Add a new patient medical record
                </p>

            </div>


            <a
                href="index.php"
                class="medical-btn-back"
            >

                <i class="fa-solid fa-left-long"></i>

                Go Back

            </a>

        </div>


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


        <!-- ================= FORM CARD ================= -->

        <div class="medical-form-card">


            <!-- FORM HEADER -->

            <div class="medical-form-header">

                <h5>
                    Medical Record Information
                </h5>

            </div>


            <!-- FORM BODY -->

            <div class="medical-form-body">


                <form
                    action="../queries/query.php"
                    method="POST"
                >


                    <!-- PATIENT & DOCTOR -->

                    <div class="row g-3 mb-3">


                        <!-- PATIENT -->

                        <div class="col-md-6">

                            <label class="medical-form-label">

                                Patient

                            </label>


                            <select
                                name="patient_id"
                                class="form-control medical-form-control"
                               
                            >

                                <option value="">
                                    Select Patient
                                </option>


                                <?php

                                while(
                                    $patient =
                                    mysqli_fetch_assoc($patients)
                                ){

                                ?>

                                    <option
                                        value="<?php echo $patient['id']; ?>"
                                    >

                                        <?php echo $patient['name']; ?>

                                    </option>

                                <?php } ?>


                            </select>

                        </div>


                        <!-- DOCTOR -->

                        <div class="col-md-6">

                            <label class="medical-form-label">

                                Doctor

                            </label>


                            <select
                                name="doctor_id"
                                class="form-control medical-form-control"
                               
                            >

                                <option value="">
                                    Select Doctor
                                </option>


                                <?php

                                while(
                                    $doctor =
                                    mysqli_fetch_assoc($doctors)
                                ){

                                ?>

                                    <option
                                        value="<?php echo $doctor['id']; ?>"
                                    >

                                        Dr.

                                        <?php echo $doctor['name']; ?>

                                    </option>

                                <?php } ?>


                            </select>

                        </div>

                    </div>


                    <!-- DIAGNOSIS -->

                    <div class="mb-3">

                        <label class="medical-form-label">

                            Diagnosis

                        </label>


                        <input
                            type="text"
                            name="diagnosis"
                            class="form-control medical-form-control"
                            placeholder="Enter diagnosis"
                           
                        >

                    </div>


                    <!-- SYMPTOMS -->

                    <div class="mb-3">

                        <label class="medical-form-label">

                            Symptoms

                        </label>


                        <textarea
                            name="symptoms"
                            class="form-control medical-form-control"
                            rows="4"
                            placeholder="Enter patient symptoms"
                           
                        ></textarea>

                    </div>


                    <!-- PRESCRIPTION -->

                    <div class="mb-3">

                        <label class="medical-form-label">

                            Prescription

                        </label>


                        <textarea
                            name="prescription"
                            class="form-control medical-form-control"
                            rows="4"
                            placeholder="Enter prescription"
                           
                        ></textarea>

                    </div>


                    <!-- DATE -->

                    <div class="mb-4">

                        <label class="medical-form-label">

                            Record Date

                        </label>


                        <input
                            type="date"
                            name="record_date"
                            class="form-control medical-form-control medical-date"
                            value="<?php echo date('Y-m-d'); ?>"
                           
                        >

                    </div>


                    <!-- BUTTONS -->

                    <div class="medical-form-buttons">


                        <button
                            type="submit"
                            name="medical_record_add"
                            class="medical-btn-save"
                        >

                            <i class="fa-solid fa-plus"></i>

                            Add Medical Record

                        </button>


                        <a
                            href="index.php"
                            class="medical-btn-cancel"
                        >

                            Cancel

                        </a>


                    </div>


                </form>

            </div>

        </div>

    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>