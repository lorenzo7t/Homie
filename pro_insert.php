<?php
// Start the session
session_start();
use function PHPSTORM_META\map;

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


$sql = "SELECT * FROM homie.pro_data WHERE email = '$email' OR piva = '$piva'";
if ($conn->query($sql)->num_rows > 0) {
    header('Location:professionist_register.php?error= Email o P.IVA già associata ad un account');
    exit();
   
} 


$sql = "INSERT INTO homie.pro_data (nome, cognome, email, indirizzo, password, professione, piva, prezzo_orario, prezzo_chiamata)
VALUES ('$nome', '$cognome', '$email', '$indirizzo', '$password', '$professione', '$piva', '$p_orario', '$p_chiamata')";

if ($conn->query($sql) === TRUE) {
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
} else {
    header('Location:professionist_register.php?error= Errore nella creazione dell\'account');
}


$conn->close();
?>
