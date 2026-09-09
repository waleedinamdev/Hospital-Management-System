<?php  
include_once("../includes/auth.php");
include_once("../config/database.php");

if(!isset($_GET['id'])){
    header("location: index.php");
    exit();
}
$id=(INT)$_GET['id'];
$sql="SELECT * FROM doctors WHERE id=$id";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    $student = mysqli_fetch_array($result);
}

include_once("../includes/header/dashboard_header.php");
include_once("../includes/navbar/dashboard_navbar.php");
include_once("../includes/header/doctor_header.php");

/// Edit Code/// 

?>
    

<div class="container py-5">

    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

        <h2 class="page-title mb-1">Update Doctor</h2>

<p class="page-subtitle mb-0"> Update  doctor of the hospital </p>
</div>
 <a href="/hospital/doctors/index.php" class="btn btn-edit">
    <i class="fa-solid fa-left-long"></i>
           Go Back 
        </a>


    </div>
   

    <!-- Doctor Form --------------------------------------------->
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

            <h5 class="mb-0">  Doctor Information </h5>

        </div>


        <div class="card-body p-4">

            <form action="/hospital/queries/query.php" method="POST" enctype="multipart/form-data">


                <!-- Name & Email -->

                <div class="row g-3 mb-3">
                    <input type="hidden" name='id' value="<?php echo $student['id']; ?>" >

                    <div class="col-md-6">
                    <label class="form-label"> Doctor Name </label>
                    <input type="text"name="name"class="form-control" placeholder="Enter doctor name" value="<?php echo $student['name']; ?>">
                    </div>


                    <div class="col-md-6">
                    <label class="form-label">Email </label>
                    <input type="text" name="email" class="form-control" placeholder="Enter email address" value="<?php echo $student['email']; ?>">
                    </div>

                </div>


                <!-- Phone & Specialization -->

                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                    <label class="form-label">Phone Number </label>
                    <input type="text"name="phone" class="form-control"placeholder="Enter phone number" value="<?php echo $student['phone']; ?>">
                    </div>


                    <div class="col-md-6">
                        <label class="form-label"> Specialization </label>

                        <select name="specialization" class="form-control">
                            <option value="Cardiologist" <?php if($student['specialization'] == 'Cardiologist') echo 'selected'; ?>>Cardiologist</option>

                            <option value="Dermatologist" <?php if($student['specialization'] == 'Dermatologist') echo 'selected'; ?>>Dermatologist</option>

                            <option value="Neurologist" <?php if($student['specialization'] == 'Neurologist') echo 'selected'; ?>>Neurologist</option>

                            <option value="General Physician" <?php if($student['specialization'] == 'General Physician') echo 'selected'; ?>>General Physician</option>
                        </select>

                    </div>

                </div>


                <!-- Qualification & Gender -->

                <div class="row g-3 mb-3">

                    <div class="col-md-6">

                        <label class="form-label"> Qualification </label>
                        <input type="text" name="qualification"class="form-control"placeholder="e.g. MBBS, FCPS"value="<?php echo $student['qualification']; ?>" >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Gender
                        </label>

                       <select name="gender" class="form-control">
                    <option value="Male" <?php if($student['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                     <option value="Female" <?php if($student['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                       </select>

                    </div>

                </div>


                <!-- Image & Status -->

                <div class="row g-3 mb-4">

                    <div class="col-md-6">

                    <label class="form-label"> Profile Image</label>
                    <input type="file"name="profile_image"class="form-control" >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">
                        <option value="Active" <?php if($student['status'] == 'Active') echo 'selected'; ?>>Active</option>
                        <option value="Inactive" <?php if($student['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                        </select>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-save"
                        name="doctor_edit"
                        href="index.php"

                    >

                        <i class="fa-solid fa-pen-to-square"></i>

                        Update Doctor

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





</body>

</html>
<?php
include_once("../includes/footer/footer.php");
?>