<?php

include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/patient_header.php");

if(!isset($_GET['id'])){
    header("location: index.php");
    exit();
}

$id=$_GET['id'];

$sql="SELECT * FROM patients WHERE id=$id";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

    $student=mysqli_fetch_array($result);

}


?>


<div class="patients-page">

    <div class="container py-5">

        <!-- PAGE HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="page-title mb-1">
                    Update Patient
                </h2>

                <p class="page-subtitle mb-0">
                    Update patient of the hospital
                </p>

            </div>


            <a href="index.php" class="btn btn-edit">

                <i class="fa-solid fa-left-long"></i>

                Go Back

            </a>

        </div>


        <!-- ERROR MESSAGE -->

        <div class="container-fluid mt-5">

            <?php

            if(isset($_SESSION['error'])){

            ?>

                <div class="alert alert-info alert-dismissible fade show">

                    <?php echo $_SESSION['error']; ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            <?php

            }

            unset($_SESSION['error']);

            ?>

        </div>


        <!-- PATIENT FORM -->

        <div class="card patient-form-card">


            <!-- FORM HEADER -->

            <div class="card-header patient-form-header">

                <h5 class="mb-0">
                    Patient Information
                </h5>

            </div>


            <!-- FORM BODY -->

            <div class="card-body p-4">

                <form
                    action="/hospital/queries/query.php"
                    method="POST"
                    enctype="multipart/form-data"
                >


                    <!-- ID -->

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $student['id']; ?>"
                    >


                    <!-- NAME & EMAIL -->

                    <div class="row g-3 mb-3">


                        <div class="col-md-6">

                            <label class="form-label">
                                Patient Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter patient name"
                                value="<?php echo $student['name']; ?>"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="text"
                                name="email"
                                class="form-control"
                                placeholder="Enter email address"
                                value="<?php echo $student['email']; ?>"
                            >

                        </div>

                    </div>


                    <!-- PHONE & GENDER -->

                    <div class="row g-3 mb-3">


                        <div class="col-md-6">

                            <label class="form-label">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                placeholder="Enter phone number"
                                value="<?php echo $student['phone']; ?>"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Gender
                            </label>

                            <select
                                name="gender"
                                class="form-control"
                            >

                                <option
                                    value="Male"
                                    <?php
                                    if($student['gender']=="Male"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Male
                                </option>


                                <option
                                    value="Female"
                                    <?php
                                    if($student['gender']=="Female"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Female
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- DOB & BLOOD GROUP -->

                    <div class="row g-3 mb-3">


                        <div class="col-md-6">

                            <label class="form-label">
                                Date Of Birth
                            </label>

                            <input
                                type="date"
                                name="date_of_birth"
                                class="form-control"
                                value="<?php echo $student['date_of_birth']; ?>"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Blood Group
                            </label>

                            <select
                                name="blood_group"
                                class="form-control"
                            >

                                <option
                                    value="A+"
                                    <?php
                                    if($student['blood_group']=="A+"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    A+
                                </option>


                                <option
                                    value="B+"
                                    <?php
                                    if($student['blood_group']=="B+"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    B+
                                </option>


                                <option
                                    value="AB+"
                                    <?php
                                    if($student['blood_group']=="AB+"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    AB+
                                </option>


                                <option
                                    value="AB-"
                                    <?php
                                    if($student['blood_group']=="AB-"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    AB-
                                </option>


                                <option
                                    value="O+"
                                    <?php
                                    if($student['blood_group']=="O+"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    O+
                                </option>


                                <option
                                    value="O-"
                                    <?php
                                    if($student['blood_group']=="O-"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    O-
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- ADDRESS & STATUS -->

                    <div class="row g-3 mb-4">


                        <div class="col-md-6">

                            <label class="form-label">
                                Address
                            </label>

                            <input
                                type="text"
                                name="address"
                                class="form-control"
                                placeholder="Enter address"
                                value="<?php echo $student['address']; ?>"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-control"
                            >

                                <option
                                    value="Active"
                                    <?php
                                    if($student['status']=="Active"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Active
                                </option>


                                <option
                                    value="Inactive"
                                    <?php
                                    if($student['status']=="Inactive"){
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- BUTTONS -->

                    <div class="d-flex gap-2">


                        <button
                            type="submit"
                            name="patient_edit"
                            class="btn btn-save"
                        >

                            <i class="fa-solid fa-pen-to-square"></i>

                            Update Patient

                        </button>


                        <a
                            href="index.php"
                            class="btn btn-cancel"
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