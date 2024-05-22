<?php
// Start the session
session_start();
use function PHPSTORM_META\map;
ini_set ('display_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';
$nome= $conn->real_escape_string($_POST['nome']);
$cognome= $conn->real_escape_string($_POST['cognome']);
$email= $conn->real_escape_string($_POST['email']);
$indirizzo= $conn->real_escape_string($_POST['indirizzo']);
$password= $conn->real_escape_string($_POST['password']);
$professione= $conn->real_escape_string($_POST['professione']);
$piva= $conn->real_escape_string($_POST['piva']);
$p_orario= $conn->real_escape_string($_POST['p_orario']);
$p_chiamata= $conn->real_escape_string($_POST['p_chiamata']);
$filecontent = $_FILES['photo']['tmp_name'];

$sql = "SELECT * FROM homie.pro_data WHERE email = '$email' OR piva = '$piva'";
if ($conn->query($sql)->num_rows > 0) {
    header('Location:professionist_register.php?error= Email o P.IVA già associata ad un account');
    exit();
   
} 


$sql = "INSERT INTO homie.pro_data (nome, cognome, email, indirizzo, password, professione, piva, prezzo_orario, prezzo_chiamata, rating,profile_picture)
VALUES ('$nome', '$cognome', '$email', '$indirizzo', md5('$password'), '$professione', '$piva', '$p_orario', '$p_chiamata', '$rating', '$filecontent')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['piva'] = $piva;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $nome;
    $_SESSION['cognome'] = $cognome;
    $_SESSION['indirizzo'] = $indirizzo;
    $_SESSION['professione'] = $professione;
    $_SESSION['p_orario'] = $p_orario;
    $_SESSION['p_chiamata'] = $p_chiamata;
    $_SESSION['rating'] = $rating;


    //setcookie('user_id', $userid, time() + (30 * 24 * 60 * 60), '/');
    header('Location:home.php');
    exit();
} else {
    header('Location:professionist_register.php?error= Errore nella creazione dell\'account');
}


$conn->close();
?>
