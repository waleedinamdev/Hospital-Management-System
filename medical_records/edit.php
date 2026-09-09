<?php

include_once("../includes/auth.php");
include_once("../config/database.php");

// ================= CHECK ID =================

if(!isset($_GET['id'])){

    header("location: index.php");
    exit();

}

$id = $_GET['id'];


// ================= GET RECORD =================

$sql = "SELECT * FROM medical_records WHERE id = $id";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    $record = mysqli_fetch_assoc($result);

}else{

    header("location: index.php");
    exit();

}


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


include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/doctor_header.php");

?>





<div class="container py-5">

    <!-- PAGE HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="page-title mb-1">
                Update Medical Record
            </h2>

            <p class="page-subtitle mb-0">
                Update patient medical information
            </p>

        </div>


        <a href="index.php" class="btn btn-edit">

            <i class="fa-solid fa-left-long"></i>

            Go Back

        </a>

    </div>


    <!-- FORM -->

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

    <div class="card doctor-form-card">

        <div class="card-header doctor-form-header">

            <h5 class="mb-0">
                Medical Record Information
            </h5>

        </div>


        <div class="card-body p-4">

            <form action="../queries/query.php" method="POST">


                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $record['id']; ?>"
                >


                <!-- PATIENT & DOCTOR -->

                <div class="row g-3 mb-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Patient
                        </label>

                        <select
                            name="patient_id"
                            class="form-control"
                            
                        >

                            <option value="">
                                Select Patient
                            </option>


                            <?php

                            while($patient = mysqli_fetch_assoc($patients)){

                            ?>

                                <option
                                    value="<?php echo $patient['id']; ?>"

                                    <?php

                                    if($patient['id'] == $record['patient_id']){
                                        echo "selected";
                                    }

                                    ?>
                                >

                                    <?php echo $patient['name']; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Doctor
                        </label>

                        <select
                            name="doctor_id"
                            class="form-control"
                            
                        >

                            <option value="">
                                Select Doctor
                            </option>


                            <?php

                            while($doctor = mysqli_fetch_assoc($doctors)){

                            ?>

                                <option
                                    value="<?php echo $doctor['id']; ?>"

                                    <?php

                                    if($doctor['id'] == $record['doctor_id']){
                                        echo "selected";
                                    }

                                    ?>
                                >

                                    Dr. <?php echo $doctor['name']; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                </div>


                <!-- DIAGNOSIS -->

                <div class="mb-3">

                    <label class="form-label">
                        Diagnosis
                    </label>

                    <input
                        type="text"
                        name="diagnosis"
                        class="form-control"
                        value="<?php echo $record['diagnosis']; ?>"
                        
                    >

                </div>


                <!-- SYMPTOMS -->

                <div class="mb-3">

                    <label class="form-label">
                        Symptoms
                    </label>

                    <textarea
                        name="symptoms"
                        class="form-control"
                        rows="4"
                        
                    ><?php echo $record['symptoms']; ?></textarea>

                </div>


                <!-- PRESCRIPTION -->

                <div class="mb-3">

                    <label class="form-label">
                        Prescription
                    </label>

                    <textarea
                        name="prescription"
                        class="form-control"
                        rows="4"
                        
                    ><?php echo $record['prescription']; ?></textarea>

                </div>


                <!-- DATE -->

                <div class="mb-4">

                    <label class="form-label">
                        Record Date
                    </label>

                    <input
                        type="date"
                        name="record_date"
                        class="form-control"
                        value="<?php echo $record['record_date']; ?>"
                        
                    >

                </div>


                <!-- BUTTONS -->

                <button
                    type="submit"
                    name="medical_record_edit"
                    class="btn btn-save"
                >

                    <i class="fa-solid fa-pen-to-square"></i>

                    Update Medical Record

                </button>


                <a
                    href="index.php"
                    class="btn btn-cancel"
                >

                    Cancel

                </a>


            </form>

        </div>

    </div>

</div>


<?php

include_once("../includes/footer/footer.php");

?>