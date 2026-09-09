<?php
 $localhost ="localhost";
 $user = "root";
 $password = "";
 $database = "hospital_management";
 // Query //
 $conn = mysqli_connect($localhost, $user ,$password ,$database);

if(!$conn){
    die("DAtabase not connected");
}

?>