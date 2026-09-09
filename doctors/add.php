<?php
include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/doctor_header.php");

?>


<div class="container py-5">

    <!-- Page Header -->

    <div class="mb-4">

        <h2 class="page-title mb-1">
            Add Doctor
        </h2>

        <p class="page-subtitle mb-0">
            Add a new doctor to the hospital
        </p>

    </div>


    <!-- Doctor Form -->
     <div class="container-fluid mt-5">
             <?php if(isset($_SESSION['error'])){?>
             <div class="alert alert-info alert-dismissible fade show">
             <?php echo $_SESSION['error'] ;?>
             <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
             </div>
             <?php }unset($_SESSION['error'])?>
        </div>

    <div class="card doctor-form-card">

        <div class="card-header doctor-form-header">

            <h5 class="mb-0">
                Doctor Information
            </h5>

        </div>


        <div class="card-body p-4">

            <form action="/hospital/queries/query.php" method="POST" enctype="multipart/form-data">


                <!-- Name & Email -->

                <div class="row g-3 mb-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Doctor Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Enter doctor name"
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
                        >

                    </div>

                </div>


                <!-- Phone & Specialization -->

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
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Specialization
                        </label>

                        <select
                            name="specialization"
                            class="form-select"
                        >

                            <option value="">
                                Select specialization
                            </option>

                            <option value="Cardiologist">
                                Cardiologist
                            </option>

                            <option value="Dermatologist">
                                Dermatologist
                            </option>

                            <option value="Neurologist">
                                Neurologist
                            </option>

                            <option value="Dentist">
                                Dentist
                            </option>

                            <option value="General Physician">
                                General Physician
                            </option>

                            <option value="Pediatrician">
                                Pediatrician
                            </option>

                            <option value="Orthopedic">
                                Orthopedic
                            </option>

                            <option value="Gynecologist">
                                Gynecologist
                            </option>

                            <option value="Ophthalmologist">
                                Ophthalmologist
                            </option>

                            <option value="ENT Specialist">
                                ENT Specialist
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Qualification & Gender -->

                <div class="row g-3 mb-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Qualification
                        </label>

                        <input
                            type="text"
                            name="qualification"
                            class="form-control"
                            placeholder="e.g. MBBS, FCPS"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Gender
                        </label>

                        <select
                            name="gender"
                            class="form-select"
                        >

                            <option value="">
                                Select gender
                            </option>

                            <option value="Male">
                                Male
                            </option>

                            <option value="Female">
                                Female
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Image & Status -->

                <div class="row g-3 mb-4">

                    <div class="col-md-6">

                        <label class="form-label">
                            Profile Image
                        </label>

                        <input
                            type="file"
                            name="profile_image"
                            class="form-control"
                            accept="image/*"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >
                        <option value="">
                                Select status
                            </option>

                            <option value="Active">
                                Active
                            </option>

                            <option value="Inactive">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-save"
                        name="doctor_add"
                    >

                        <i class="fa-solid fa-plus"></i>

                        Add Doctor

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
<?php
include_once("../includes/footer/footer.php");
?>


