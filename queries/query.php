<?php
session_start();
include_once("../config/database.php");
/// Function for location///
function redirect($location){
  header("location:" . $location);
  exit();
}


//////////////////////AuthenticationQueries Start ////////////////////////

/*-------------Register----------------*/


if(isset($_POST['user_register'])){
    $name = trim($_POST['uname']);
    $email = trim($_POST['uemail']);  
    $password = $_POST['upassword'];
    $confirm_password = $_POST['confirm_password'];
 //1.validation for empty fields//
    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
        $_SESSION['register_error']="Plz fill all the fields";
        redirect("../auth/register.php");
        exit();
    }

// 1.Name  validation// Preg match     
if(!preg_match("/^[a-z, A-Z]+$/",$name)){// check for name syntax //
    $_SESSION['register_error'] = "Use only alphabets for names";
    redirect("../auth/register.php");
    exit();    
}

// 2.Email validation //
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){// check for email syntax//
$_SESSION['register_error'] = "Email syntax is wrong abc@gmail.com";
redirect("../auth/register.php");;
exit();  
}  

$checkEmail = "Select * from users where email = ? ";
$stmt = mysqli_prepare($conn,$checkEmail);
mysqli_stmt_bind_param($stmt , 's' ,$email );
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)>0){
mysqli_stmt_close($stmt);
$_SESSION['register_error']="Email already exits";
redirect("../auth/register.php");
exit();
//  die("Email already exits");
}
mysqli_stmt_close($stmt);
//3. Password length check krni h //

if(strlen($password) < 8){
$_SESSION['register_error']="Password should be 8 digits";
redirect("../auth/register.php");
exit();
}

//3. Password  must  be one (uuper lower case special Characters) //

if (!preg_match("/[A-Z]/", $password) || 
!preg_match("/[a-z]/", $password) || 
!preg_match("/[0-9]/", $password) || 
!preg_match("/[^A-Za-z0-9]/", $password)) {

$_SESSION['register_error'] = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
redirect("../auth/register.php");
exit();
}



//3. Password confirm password//
if($password != $confirm_password){
  $_SESSION['register_error']="Password are not match";
  redirect("../auth/register.php");
  exit();
//   die("Password are not match");
}


$hashedPassword = password_hash($password,PASSWORD_DEFAULT);
//    $sql = "Insert into users(u_name ,u_email,u_password)
//    VALUES ('$name','$email','$hashedPassword')";
$sql = "Insert into users(name ,email,password)
VALUES (? ,? ,?)";
$stmt = mysqli_prepare($conn , $sql);
mysqli_stmt_bind_param($stmt , "sss" ,$name ,$email, $hashedPassword);  
$result = mysqli_stmt_execute($stmt);

if($result){
$_SESSION['success']="Register Sucesssfully";
redirect("../auth/login.php");
exit();
// die("Register Sucesssfully");
}
else{
$_SESSION['register_error']="Sorry again try to register";
redirect("../auth/register.php");
exit();
// die("Sorry");
}
}




///////login page//////////
//*-----------------Login----------------------------*//
if(isset($_POST['login_user'])){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Khali fields check karne ki logic
    if(empty($email) || empty($password)){
        $_SESSION['login_error']="All fields are required!";
        redirect(" ../auth/login.php");
        exit();
        // die("All fields are required!");
        
    }


    // 2. Database me email check karne ki logic
    // $checkUser = "SELECT * FROM users WHERE email = '$email'";
    $checkUser = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn , $checkUser);
    mysqli_stmt_bind_param($stmt , "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) === 0) {
        mysqli_stmt_close($stmt);
        $_SESSION['login_error'] = " Password & Email not found ";
        redirect("../auth/login.php");
        exit();
    }
    $row = mysqli_fetch_assoc($result);
    //  echo "Form Password: " . $password . "<br>";
    // echo "DB Hash: " . $row['u_password'] . "<br>";
    // exit();

    mysqli_stmt_close($stmt);

    if (password_verify($password, $row['password'])) {
        //auth.php link//
        // =================================================
        // SAVE LOGIN SESSION
        // =================================================

        $_SESSION['loggedin'] = true;

        $_SESSION['user_id'] = $row['id'];

        $_SESSION['user_name'] = $row['name'];

        $_SESSION['user_email'] = $row['email'];

        $_SESSION['role'] = $row['role'];


        // =================================================
        // ADMIN
        // =================================================
        if ($row["role"] == "admin") {

            redirect("../admin/dashboard.php");
            exit();

        } else {
    
            redirect("../hospital/index.php");
            exit();
        }
        $_SESSION['login_error'] = "Login Successful! Welcome " . $row['name'];
        redirect("../hospital/index.php"); // (Yahan baad mein dashboard ka rasta de dena)
        exit();
    } else {
        $_SESSION['login_error'] = "Incorrect Password!";
        redirect("../auth/login.php");
        exit();
    }
}


////////////////////////Patient Queries Start //////////////////////////////

///Add Patient///
if (isset($_POST['patient_add'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $DOB =$_POST['date_of_birth'];
    $bloodGroup =$_POST['blood_group'];
    $address=$_POST['address'];

// ----------------  Empty Fields Validations  ----------------------

if(empty($name) || empty($email) || empty($phone) || empty($gender)
|| empty($DOB) || empty($bloodGroup) || empty($address)){
     $_SESSION['error']="Please Fill All Fields";
     redirect("../patients/add.php");
     exit();
    }

      // ------------------------------Email Validations----------------------

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     $_SESSION['error']="Please Enter A Valid Email";
     redirect("../patients/add.php");
     exit();
}    

  // ------------------------------Phone Validations----------------------

if(!preg_match("/^[0-9]+$/",$phone)){
     $_SESSION['error']="Please Enter A Valid Number";
      redirect("../patients/add.php");
     exit();
}

if(strlen($phone)!=11){
     $_SESSION['error']="Please Enter A Valid Number";
     redirect("../patients/add.php");
     exit();
}
    $imageName=$_FILES['profile_image']['name'];
     $imageTmp=$_FILES['profile_image']['tmp_name'];
     $imageExtension= pathinfo($imageName,PATHINFO_EXTENSION);
     $imageExtension=strtolower($imageExtension);
     $allowedExtension=['jpg','png'];
     $imageSize=$_FILES['profile_image']['size'];
     $maxSize=2*1024*1024;
     if(!in_array ($imageExtension,$allowedExtension)){
        die("image is only allowed in jpg and phg");
     }
     if($imageSize > $maxSize ){
        die("image cannot be greater than 2MB");
     }
    $newImageName=time().".".$imageExtension;
    move_uploaded_file($imageTmp,"../uploads/images/".$newImageName);

    $sql="INSERT INTO `patients`(`name`, `email`, `phone`, `gender`, `date_of_birth`, `blood_group`,`address`, `profile_image`, `status`) VALUES 
    (?,?,?,?,?,?,?,?,?)";
    $stmt=mysqli_prepare($conn , $sql);
    mysqli_stmt_bind_param($stmt,"sssssssss",$name,$email,$phone,$gender,$DOB,$bloodGroup,$address,$newImageName,$status);
      if(mysqli_stmt_execute($stmt)){
         mysqli_stmt_close($stmt);
    
         $_SESSION['success']="Patient Added Successfully";
        redirect("../patients/index.php");
        exit();
      }else{
        die("No Record Added");
      }  
}

//=======Edit Patient=========//  
if (isset($_POST['patient_edit'])) {
    $id = $_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $DOB =$_POST['date_of_birth'];
    $bloodGroup =$_POST['blood_group'];
    $address=$_POST['address'];
    // ----------------  Empty Fields Validations  ----------------------

if(empty($name) || empty($email) || empty($phone) || empty($gender)
|| empty($DOB) || empty($bloodGroup) || empty($address)){
     $_SESSION['error']="Please Fill All Fields";
    redirect("../patients/edit.php?id=" . $id);
     exit();
    }

      // ------------------------------Email Validations----------------------

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     $_SESSION['error']="Please Enter A Valid Email";
    redirect("../patients/edit.php?id=" . $id);
     exit();
}    

  // ------------------------------Phone Validations----------------------

if(!preg_match("/^[0-9]+$/",$phone)){
     $_SESSION['error']="Please Enter A Valid Number";
    redirect("../patients/edit.php?id=" . $id);
     exit();
}

if(strlen($phone)!=11){
     $_SESSION['error']="Please Enter A Valid Number";
    redirect("../patients/edit.php?id=" . $id);
     exit();
}

    $sql="update patients set name = ? ,email = ? ,phone = ? , gender = ? , date_of_birth = ? ,
     blood_group = ?, address = ?,status=? where id = ? ";
    $stmt=mysqli_prepare($conn , $sql);
    mysqli_stmt_bind_param($stmt,"ssssssssi",$name,$email,$phone,$gender,$DOB,$bloodGroup,$address,$status,$id);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        $_SESSION['success']="Patient Update Successfully";
        redirect("../patients/index.php");
        exit();
    }
    else{
        echo "Something went wrong";
    }  
}


//=======Delete Patient========//  
if(isset($_GET['patient_delete'])){
    $id=$_GET['patient_delete'];
    $sql= "DELETE FROM patients WHERE id= ? ";
    $stmt=mysqli_prepare( $conn , $sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
   if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);
    $_SESSION['success']="Patient Deleted Successfully";
    redirect("../patients/index.php");
    exit();
} 
}      


////////////////////////Patient Queries End //////////////////////////////



////////////////////////Doctor Queries Start //////////////////////////////

///Add Doctor///
if (isset($_POST['doctor_add'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $specialization=$_POST['specialization'];
    $qualification=$_POST['qualification'];
    $gender=$_POST['gender'];
    $status=$_POST['status'];

     // ----------------  Empty Fields Validations  ----------------------


if(empty($name) || empty($email) || empty($phone) || empty($specialization)
|| empty($qualification) || empty($gender) ||empty($status)){
     $_SESSION['error']="Please Fill All Fields";
     redirect("../doctors/add.php");
     exit();
    }

      // ------------------------------Email Validations----------------------

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     $_SESSION['error']="Please Enter A Valid Email";
    redirect("../doctors/add.php");
      exit();


}    

  // ------------------------------Phone Validations----------------------

if(!preg_match("/^[0-9]+$/",$phone)){
     $_SESSION['error']="Please Enter A Valid Number";
     redirect("../doctors/add.php");
     exit();


}

if(strlen($phone)!=11){
     $_SESSION['error']="Please Enter A Valid Number";
      redirect("../doctors/add.php");
     exit();

}
    

    $imageName=$_FILES['profile_image']['name'];
     $imageTmp=$_FILES['profile_image']['tmp_name'];
     $imageExtension= pathinfo($imageName,PATHINFO_EXTENSION);
     $imageExtension=strtolower($imageExtension);
     $allowedExtension=['jpg','png'];
     $imageSize=$_FILES['profile_image']['size'];
     $maxSize=2*1024*1024;
     if(!in_array ($imageExtension,$allowedExtension)){
        die("image is only allowed in jpg and phg");
     }
     if($imageSize > $maxSize ){
        die("image cannot be greater than 2MB");
     }
    $newImageName=time().".".$imageExtension;
    move_uploaded_file($imageTmp,"../uploads/images/".$newImageName);

    $sql="INSERT INTO `doctors`(`name`, `email`, `phone`, `specialization`, `qualification`, `gender`, `profile_image`, `status`) VALUES 
    (?,?,?,?,?,?,?,?)";
    $stmt=mysqli_prepare($conn , $sql);
    mysqli_stmt_bind_param($stmt,"ssssssss",$name,$email,$phone,$specialization,$qualification,$gender,$newImageName,$status);
      if(mysqli_stmt_execute($stmt)){
         mysqli_stmt_close($stmt);
         $_SESSION['success'] = "Doctor Added Successfully";
         redirect("../doctors/index.php");
    //   header("location:../doctors/index.php");
       exit();
      }else{
        die("No Record Added");
      }  
}

//=======Edit Doctor=========//  
if(isset($_POST['doctor_edit'])){
    $id = $_POST['id'];
    $name= $_POST ['name'];
    $email= $_POST ['email'];
    $phone= $_POST ['phone'];
    $specialization=$_POST['specialization'];
    $qualification=$_POST['qualification'];
    $gender=$_POST['gender'];
    $status=$_POST['status'];
        // ----------------  Empty Fields Validations  ----------------------


if(empty($name) || empty($email) || empty($phone) || empty($specialization)
|| empty($qualification) || empty($gender) ||empty($status)){
     $_SESSION['error']="Please Fill All Fields";
     redirect("../doctors/edit.php?id=" . $id);
     exit();
    }

      // ------------------------------Email Validations----------------------

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     $_SESSION['error']="Please Enter A Valid Email";
    redirect("../doctors/edit.php?id=" . $id);
      exit();


}    

  // ------------------------------Phone Validations----------------------

if(!preg_match("/^[0-9]+$/",$phone)){
     $_SESSION['error']="Please Enter A Valid Number";
     redirect("../doctors/edit.php?id=" . $id);
     exit();


}

if(strlen($phone)!=11){
     $_SESSION['error']="Please Enter A Valid Number";
      redirect("../doctors/edit.php?id=" . $id);
     exit();

}

    $sql="update doctors set name = ? ,email = ? ,phone = ? , specialization= ? , qualification = ? , gender = ?,status=? where Id = ? ";
    $stmt=mysqli_prepare($conn , $sql);
    mysqli_stmt_bind_param($stmt,"sssssssi",$name,$email,$phone,$specialization,$qualification,$gender,$status,$id);
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        $_SESSION['success'] = "Doctor Edit Successfully";
        redirect("../doctors/index.php");
        exit();
    }
    else{
        echo "Something went wrong";
    }  
}


//=======Delete Doctor=========//  
if(isset($_GET['doctor_delete'])){
    $id=$_GET['doctor_delete'];
    $sql= "DELETE FROM doctors WHERE id= ? ";
    $stmt=mysqli_prepare( $conn , $sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
   if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);
    $_SESSION['success'] = " Delete Doctor  Successfully";
    redirect("../doctors/index.php");
    //  header("Location:../doctors/index.php");
    exit();
} 
}      






////////////////Appointemnts section start/////////////////////
////////////////////// Appointments Queries Start //////////////////////


// =====================================================
// ADD APPOINTMENT
// =====================================================

if (isset($_POST['appointment_add'])) {

    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];


    $sql = "INSERT INTO appointments( patient_id,doctor_id,appointment_date,appointment_time,reason, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
 mysqli_stmt_bind_param($stmt,"iissss", $patient_id,$doctor_id,$appointment_date, $appointment_time, $reason, $status);

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_success'] =
            "Appointment Added Successfully";

        redirect("../appointments/index.php");

        exit();

    } else {

        die("Something went wrong");

    }
}


// =====================================================
// APPROVE APPOINTMENT
// =====================================================

if (isset($_GET['approve_appointment'])) {

    $id = (int)$_GET['approve_appointment'];


    $sql = "UPDATE appointments SET status = 'Confirmed' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param( $stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_success'] =
            "Appointment Confirmed Successfully";

        header("Location: ../appointments/index.php");

        exit();

    } else {

        die("Something went wrong");

    }
}


// =====================================================
// CANCEL APPOINTMENT
// =====================================================

if (isset($_GET['cancel_appointment'])) {

    $id = (int)$_GET['cancel_appointment'];


    $sql = "UPDATE appointments SET status = 'Cancelled'WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param( $stmt, "i", $id );
    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_success'] =
            "Appointment Cancelled Successfully";

        header("Location: ../appointments/index.php");

        exit();

    } else {

        die("Something went wrong");

    }
}


// =====================================================
// COMPLETE APPOINTMENT
// =====================================================

if (isset($_GET['complete_appointment'])) {
    $id = (int)$_GET['complete_appointment'];
    $sql = "UPDATE appointments SET status = 'Completed' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
 mysqli_stmt_bind_param( $stmt, "i", $id );
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);

        $_SESSION['appointment_success'] =
            "Appointment Completed Successfully";

        header("Location: ../appointments/index.php");

        exit();

    } else {

        die("Something went wrong");

    }
}


// =====================================================
// DELETE APPOINTMENT
// =====================================================

if (isset($_GET['appointment_delete'])) {
    $id = (int)$_GET['appointment_delete'];
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param( $stmt,"i",$id);


    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_success'] =
            "Appointment Deleted Successfully";

        header("Location: ../appointments/index.php");

        exit();

    } else {

        die("Something went wrong");

    }
}


// =====================================================
// EDIT APPOINTMENT
// =====================================================

if (isset($_POST['appointment_edit'])) {

    $id = $_POST['id'];
    $appointment_date = $_POST['appointment_date'];

    $appointment_time = $_POST['appointment_time'];

    $reason = $_POST['reason'];

    $status = $_POST['status'];
     // ----------------  Empty Fields Validations  ----------------------

    if(empty($id) || empty(  $appointment_date) || empty($appointment_time ) || empty( $reason)
    || empty($status)){
     $_SESSION['error']="Please Fill All Fields";
     redirect("../appointments/edit.php?id=" .$id);
     exit();
    }

    $sql = "UPDATE appointments SET appointment_date = ?,appointment_time = ?,reason = ?,status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $appointment_date, $appointment_time, $reason, $status, $id );
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        $_SESSION['appointment_success'] =
            "Appointment Updated Successfully";

        header("Location: ../appointments/index.php");

        exit();

    } else {

        die("Something went wrong");

    }
}




////////////////////// Appointments Queries End //////////////////////



//////////////////////Medical Records section start////


////////////////////// Medical Records Queries Start /////////////////


// =====================================================
// ADD MEDICAL RECORD
// =====================================================

if(isset($_POST['medical_record_add'])){

    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $diagnosis = $_POST['diagnosis'];
    $symptoms = $_POST['symptoms'];
    $prescription = $_POST['prescription'];
    $record_date = $_POST['record_date'];

    // ----------------  Empty Fields Validations  ----------------------

if(empty($patient_id) || empty(  $doctor_id) || empty( $diagnosis) || empty( $symptoms)
|| empty($prescription) || empty($record_date)){
     $_SESSION['error']="Please Fill All Fields";
     redirect("../medical_records/add.php");
     exit();
    }


    $sql = "INSERT INTO medical_records
            (patient_id, doctor_id, diagnosis, symptoms, prescription, record_date)
            VALUES
            (?, ?, ?, ?, ?, ?)";


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param(
        $stmt,
        "iissss",
        $patient_id,
        $doctor_id,
        $diagnosis,
        $symptoms,
        $prescription,
        $record_date
    );


    if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        $_SESSION['success'] = "Medical Record Added Successfully";

        header("location: ../medical_records/index.php");

        exit();

    }else{

        die("Medical Record Not Added");

    }

}



// =====================================================
// DELETE MEDICAL RECORD
// =====================================================

if(isset($_GET['medical_record_delete'])){

    $id = (int)$_GET['medical_record_delete'];


    $sql = "DELETE FROM medical_records WHERE id = ?";


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );


    if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        $_SESSION['success'] = "Medical Record Deleted Successfully";

        header("location: ../medical_records/index.php");

        exit();

    }else{

        die("Medical Record Not Deleted");

    }

}



// =====================================================
// EDIT MEDICAL RECORD
// =====================================================

if(isset($_POST['medical_record_edit'])){

    $id = $_POST['id'];

    $patient_id = $_POST['patient_id'];

    $doctor_id = $_POST['doctor_id'];

    $diagnosis = $_POST['diagnosis'];

    $symptoms = $_POST['symptoms'];

    $prescription = $_POST['prescription'];

    $record_date = $_POST['record_date'];


       // ----------------  Empty Fields Validations  ----------------------

    if(empty($patient_id) || empty(  $doctor_id) || empty( $diagnosis) || empty( $symptoms)
    || empty($prescription) || empty($record_date)){
     $_SESSION['error']="Please Fill All Fields";
     redirect("../medical_records/edit.php?id=" .$id);
     exit();
    }


    $sql = "UPDATE medical_records SET

            patient_id = ?,
            doctor_id = ?,
            diagnosis = ?,
            symptoms = ?,
            prescription = ?,
            record_date = ?

            WHERE id = ?";


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param(
        $stmt,
        "iissssi",
        $patient_id,
        $doctor_id,
        $diagnosis,
        $symptoms,
        $prescription,
        $record_date,
        $id
    );


    if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        $_SESSION['success'] = "Medical Record Updated Successfully";

        header("location: ../medical_records/index.php");

        exit();

    }else{

        die("Medical Record Not Updated");

    }

}



////////////////////// Medical Records Queries End //////////////////////




// =====================================================
// UPDATE ADMIN PROFILE
// =====================================================

if(isset($_POST['update_profile'])){

    // USER ID
    $user_id = $_SESSION['user_id'];

    // FORM DATA
    $name = $_POST['name'];
    $email = $_POST['email'];

    // ERROR
    $error = "";

    // NAME CHECK
    if($name == ""){
        $error = "Name is required.";
    }

    // EMAIL CHECK
    elseif($email == ""){
        $error = "Email is required.";
    }

    // CHECK EMAIL
    if($error == ""){

        $sql = "SELECT id FROM users
                WHERE email = '$email'
                AND id != '$user_id'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $error = "This email is already in use.";
        }
    }


    // GET OLD IMAGE
    $sql = "SELECT profile_image
            FROM users
            WHERE id = '$user_id'";

    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    $profileImage = $user['profile_image'];


    // IMAGE UPLOAD
    if($error == "" && $_FILES['profile_image']['name'] != ""){

        $imageName = $_FILES['profile_image']['name'];
        $imageTmp = $_FILES['profile_image']['tmp_name'];

        $extension = pathinfo($imageName, PATHINFO_EXTENSION);

        $newImage = "admin_" . $user_id . "_" . time() . "." . $extension;

        $path = "../uploads/admin/" . $newImage;


        if(move_uploaded_file($imageTmp, $path)){

            $profileImage = $newImage;

        }
        else{

            $error = "Image upload failed.";

        }

    }


    // UPDATE
    if($error == ""){

        $sql = "UPDATE users SET
                name = '$name',
                email = '$email',
                profile_image = '$profileImage'
                WHERE id = '$user_id'";

        if(mysqli_query($conn, $sql)){

            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;

            $_SESSION['profile_success'] =
                "Profile updated successfully.";

        }
        else{

            $_SESSION['profile_error'] =
                "Profile update failed.";

        }

    }
    else{

        $_SESSION['profile_error'] = $error;

    }


    // BACK TO PROFILE

    header("Location: ../admin/admin_profile.php");

    exit();

}


//////////////////User side ///////////////////
// =====================================================
// BOOK APPOINTMENT
// =====================================================


if(isset($_POST['book_appointment'])){

    // Patient Information
    $patient_name = trim($_POST['patient_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $bloodGroup =$_POST['blood_group'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = trim($_POST['address']);

    // Appointment Information
    $doctor_id = (int)$_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = trim($_POST['reason']);


    // =================================================
    // VALIDATION
    // =================================================

    if(
        $patient_name == "" ||
        $email == "" ||
        $phone == "" ||
        $gender == "" ||
        $date_of_birth == "" ||
        $address == "" ||
        $doctor_id <= 0 ||
        $appointment_date == "" ||
        $appointment_time == "" ||
        $reason == ""
    ){

        $_SESSION['appointment_error'] = "All fields are required.";

        redirect("../hospital/appointment_book.php");       
         exit();
    }


    // =================================================
    // EMAIL CHECK
    // =================================================

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $_SESSION['appointment_error'] = "Please enter a valid email.";

        redirect("../hospital/appointment_book.php");
        exit();
    }

    // =================================================
    // DATE CHECK
    // =================================================

    if($appointment_date < date("Y-m-d")){

        $_SESSION['appointment_error'] =
            "Please select today or a future date.";

        redirect("../hospital/appointment_book.php");
        exit();
    }


    // =================================================
    // CHECK DOCTOR
    // =================================================

    $sql = "SELECT id FROM doctors WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $doctor_id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 0){

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_error'] =
            "Selected doctor was not found.";

        redirect("../appointments/appointment_book.php");
        exit();
    }

    mysqli_stmt_close($stmt);


    // =================================================
    // CHECK DOCTOR TIME
    // =================================================

    $sql = "SELECT id
            FROM appointments
            WHERE doctor_id = ?
            AND appointment_date = ?
            AND appointment_time = ?
            AND status != 'Cancelled'";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iss",
        $doctor_id,
        $appointment_date,
        $appointment_time
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_error'] =
            "This doctor is already booked at this date and time.";

        redirect("../appointments/appointment_book.php");
        exit();
    }

    mysqli_stmt_close($stmt);


    // =================================================
    // ADD PATIENT
    // =================================================

    $sql = "INSERT INTO patients
            (name, email, phone, gender, blood_group, date_of_birth, address)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $patient_name,
        $email,
        $phone,
        $gender,
        $bloodGroup,
        $date_of_birth,
        $address
    );

    if(!mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        $_SESSION['appointment_error'] =
            "Patient could not be added.";

        redirect("../appointments/appointment_book.php");
        exit();
    }

    $patient_id = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);


    // =================================================
    // ADD APPOINTMENT
    // =================================================

    $sql = "INSERT INTO appointments
            (patient_id, doctor_id, appointment_date,
             appointment_time, reason, status)
            VALUES (?, ?, ?, ?, ?, 'Pending')";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iisss",
        $patient_id,
        $doctor_id,
        $appointment_date,
        $appointment_time,
        $reason
    );


    // =================================================
    // SUCCESS
    // =================================================

    if(mysqli_stmt_execute($stmt)){

        $_SESSION['appointment_success'] =
            "Appointment booked successfully! Your appointment is pending approval.";

    }
    else{

        $_SESSION['appointment_error'] =
            "Appointment could not be booked.";
    }

    mysqli_stmt_close($stmt);

    redirect("../hospital/appointment_book.php");
    exit();

}



///After booking My appointments/////

// =====================================================
// GET MY APPOINTMENTS
// =====================================================

if (isset($_GET['my_appointments'])) {

    $user_id = $_SESSION['user_id'];

    // Get patient ID
    $sql = "SELECT id FROM patients WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    $patient = mysqli_fetch_assoc($result);
    $patient_id = $patient['id'];

    // Get appointments
    $appointments = [];

    $sql = "SELECT appointments.*, 
                   doctors.name AS doctor_name,
                   doctors.specialization
            FROM appointments
            LEFT JOIN doctors
            ON appointments.doctor_id = doctors.id
            WHERE appointments.patient_id = '$patient_id'
            ORDER BY appointments.appointment_date DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $appointments[] = $row;

    }
}


?>