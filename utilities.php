<?php
// Start the session
session_start();


function downloadProfessionals() {
    include 'db_connection.php';
    $query = "SELECT * FROM homie.pro_data";
    $result = $conn->query($query);

    if ($result) {
        $professionals = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $conn->close();
        echo json_encode($professionals); // Converti i dati in JSON e stampali
    } else {
        error_log("Error retrieving professionals: " . $conn->error);
        echo json_encode([]); // Ritorna un array vuoto in caso di errore
    }
}

?>