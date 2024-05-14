<?php 
include 'db_connection.php';
$email= $_POST['email'];

$token= bin2hex(random_bytes(16)); // Generata una stringaa esadecimale casuale di 16 byte

$token_hash=hash('sha256', $token); // Hash della stringa casuale

$expiry=date('Y-m-d H:i:s', time()+60*30); // Scadenza del token a 30 minuti

$sql="UPDATE homie.user_data 
    SET reset_token_hash=?,
    reset_token_expires_at=?
    WHERE email=?"; // Query per aggiornare il token e la scadenza
$stmt=$conn->prepare($sql); // Preparazione della query
$stmt->bind_param('sss', $token_hash, $expiry, $email); // Bind dei parametri 
$stmt->execute(); // Esecuzione della query

if ($stmt->affected_rows>0) {
    echo "Token generato con successo";
   

} else {
    exit("Errore nella generazione del token");
}
?>

