<?php
session_start();
include 'db_connection.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['userid'];
    $old_password = $conn->real_escape_string($_POST['old_password']);
    $new_password = $conn->real_escape_string($_POST['new_password']);

    // Fetch the current password from the database
    $query = "SELECT password FROM homie.user_data WHERE userid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    //$user = $result->fetch_assoc();

    // Verify the old password
/*     if (!password_verify($old_password, $user['password'])) {
        $response['message'] = "La vecchia password non è corretta.";
        echo json_encode($response);
        exit();
    } */

    // Update the password
    //$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "UPDATE homie.user_data SET password = ? WHERE userid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_password, $user_id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Errore durante l\'aggiornamento: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
echo json_encode($response);
?>