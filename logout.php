<?php   
session_start(); //to ensure you are using same session
session_unset(); //to remove all session variables
session_destroy(); //destroy the session
header("location:index.php"); //to redirect back to "login.php" after logging out
