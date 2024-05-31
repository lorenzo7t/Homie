<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $conn->real_escape_string($_POST['token']);
    $new_password = $conn->real_escape_string($_POST['new_password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);


    if ($new_password !== $confirm_password) {
        $response['message'] = 'Le password non coincidono.';
    } else {
        echo $token;
        $token_hash = hash('sha256', $token);
        echo $token_hash;

        $sql = "SELECT userid, reset_token_expires_at FROM homie.user_data WHERE reset_token_hash='$token_hash'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userid = $row['userid'];
            $expiry = $row['reset_token_expires_at'];

            if (strtotime($expiry) > time()) {

                $new_password_md5 = md5($new_password);
                $sql = "UPDATE homie.user_data SET password='$new_password_md5', reset_token_hash=NULL, reset_token_expires_at=NULL WHERE userid='$userid'";

                if ($conn->query($sql) === TRUE) {
                    $response['success'] = true;
                    $response['message'] = 'Password aggiornata con successo.';
                } else {
                    $response['message'] = 'Errore durante l\'aggiornamento della password: ' . $conn->error;
                }
            } else {
                $response['message'] = 'Il link per il reset è scaduto.';
            }
        } else {
            $response['message'] = 'Token non valido.';
        }
    }

    $conn->close();
}

echo json_encode($response);
?>