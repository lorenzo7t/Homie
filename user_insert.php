<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';
$nome = $conn->real_escape_string($_POST['nome']);
$cognome = $conn->real_escape_string($_POST['cognome']);
$email = $conn->real_escape_string($_POST['email']);
$indirizzo = $conn->real_escape_string($_POST['indirizzo']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "SELECT * FROM homie.user_data WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    header('Location: register_page.php?error=Email già associata ad un account');
    exit();
}

$sql = "INSERT INTO homie.user_data (nome, cognome, email, indirizzo, password)
VALUES ('$nome', '$cognome', '$email', '$indirizzo', '$password')";

if ($conn->query($sql) === TRUE) {
    $userid = $conn->insert_id;
    $_SESSION['userid'] = $userid;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $nome;
    $_SESSION['cognome'] = $cognome;
    $_SESSION['indirizzo'] = $indirizzo;

    //setcookie('user_id', $userid, time() + (30 * 24 * 60 * 60), '/');

    header('Location: home.php');
    exit();
} else {
    header('Location: register_page.php?error=Errore nella creazione dell\'account');
    exit();
}

$conn->close();
?>
