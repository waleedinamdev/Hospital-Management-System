<?php
include_once("../includes/auth.php");
include_once("../config/database.php");
include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/doctor_header.php");
include_once("../includes/footer/footer.php");

?>



 


 <!--------------Main Container --->

<div class="main-container">


    <div class="container py-5">

        <!-- Page Header -->

        <div class="mb-4">

            <h2 class="page-title mb-1">
                Add Patients
            </h2>

            <p class="page-subtitle mb-0">
                Add a new patient to the hospital
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
                    Patient Information
                </h5>

            </div>


            <div class="card-body p-4">

                <form action="/hospital/queries/query.php" method="POST" enctype="multipart/form-data">


                    <!-- Name & Email -->

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


                    <!-- Phone & Gender-->

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


                    <!-- Date of Birth & Blood group -->

                    <div class="row g-3 mb-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Date of Birth
                            </label>

                            <input
                                type="date"
                                name="date_of_birth"
                                class="form-control"
                                placeholder="e.g. dd/mm/yyyy"
                            >

                        </div>

                        <div class="col-md-6">

                                <label class="form-label">
                                    Blood Group
                                </label>

                                <select
                                    name="blood_group"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select Blood Group
                                    </option>

                                    <option value="A+">
                                        A+
                                    </option>

                                    <option value="B+">
                                        B+
                                    </option>

                                    <option value="AB+">
                                        AB+
                                    </option>

                                    <option value="AB-">
                                        AB-
                                    </option>

                                    <option value="O+">
                                        O+
                                    </option>

                                    <option value="O-">
                                        O-
                                    </option>

                                

                                </select>

                                </div>

                    </div>


                    <!--Address  & Image -->

                    <div class="row g-3 mb-4">
                        
                        


                        <div class="col-md-6">

                        <label class="form-label">
                                Address
                            </label>

                            <input
                                type="text"
                                name="address"
                                class="form-control"
                                placeholder="e.g. Lahore"
                            >

                        </div>


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


                    </div>
                   
                    <!-- Buttons -->

                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-save"
                            name="patient_add"
                        >

                            <i class="fa-solid fa-plus"></i>

                            Add Patient

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
