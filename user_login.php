<?php
// Start the session
session_start();
include 'db_connection.php';

// Retrieve the login credentials from the form
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Query the database to check if the credentials are valid
$query = "SELECT * FROM homie.user_data WHERE email = '$email' AND password = '$password'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    header('Location:login_page.php?error= Credenziali non valide');
} 
else {
    $row = $result->fetch_assoc();
    $userid= $row['userid'];
    $_SESSION['userid'] = $userid;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $row['nome'];
    $_SESSION['indirizzo'] = $row['indirizzo'];
    //setcookie('user_id', $userid, time() + (30 * 24 * 60 * 60), '/');
    header('Location:home.php');
    exit();
}

// Close the database connection
$conn->close();
?>