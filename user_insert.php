<?php
// Start the session
session_start();
use function PHPSTORM_META\map;

ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';
$nome= $conn->real_escape_string($_POST['nome']);
$cognome= $conn->real_escape_string($_POST['cognome']);
$email= $conn->real_escape_string($_POST['email']);
$indirizzo= $conn->real_escape_string($_POST['indirizzo']);
$password= $conn->real_escape_string($_POST['password']);


$sql = "SELECT * FROM homie.user_data WHERE email = '$email'";
if ($conn->query($sql)->num_rows > 0) {
    header('Location:register_page.php?error= Email già associata ad un account');
   
} 

$sql = "INSERT INTO homie.user_data (nome, cognome, email, indirizzo, password)
VALUES ('$nome', '$cognome', '$email', '$indirizzo', '$password')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  $userid= $row['userid'];
  echo $userid;
  $_SESSION['userid'] = $userid;
  $_SESSION['email'] = $email;
  $_SESSION['name'] = $row['nome'];
  $_SESSION['cognome'] = $row['cognome'];
  $_SESSION['indirizzo'] = $row['indirizzo'];
  //setcookie('user_id', $userid, time() + (30 * 24 * 60 * 60), '/');
  
  header('Location:home.php');
  exit();
} else {
  header('Location:register_page.php?error= Errore nella creazione dell\'account');
  exit();
}


$conn->close();
?>
