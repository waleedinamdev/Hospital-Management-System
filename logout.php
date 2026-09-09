<?php
session_start();
$_SESSION = [];
session_destroy();

// Removed the space before the colon
header("location: auth/login.php"); 
exit();
?>
