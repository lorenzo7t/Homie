<?php
// Start the session
session_start();
include 'db_connection.php';
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Query the database to check if the credentials are valid
$query = "SELECT * FROM homie.pro_data WHERE email = '$email' AND password = '$password'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    header('Location:professionist_login.php?error= Credenziali non valide');
} 
else {
    $piva= $row['piva'];
    echo $userid;
    $_SESSION['piva'] = $piva;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $row['nome'];
    $_SESSION['cognome'] = $row['cognome'];
    $_SESSION['indirizzo'] = $row['indirizzo'];
    $_SESSION['professione'] = $row['professione'];
    $_SESSION['p_orario'] = $row['prezzo_orario'];
    $_SESSION['p_chiamata'] = $row['prezzo_chiamata'];

    //setcookie('user_id', $userid, time() + (30 * 24 * 60 * 60), '/');
    header('Location:home.php');
    exit();
}

// Close the database connection
$conn->close();
?>