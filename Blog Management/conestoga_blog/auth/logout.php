<?php
// Start the session
session_start(); 

// remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page
header("Location: ../home/index.php");
exit();
?>