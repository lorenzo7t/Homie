<?php
include 'db_connection.php';
    // Get the user's registration data
    $username = $_POST['nome'];
    $email = $_POST['email'];

    // Set the cookie with the user's information
    setcookie('nome', $username, time() + 86400); // Expires in 1 day
    echo 'Registration successful!';
?>