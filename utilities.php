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
        return $professionals;
    } else {
        error_log("Error retrieving professionals: " . $conn->error);
        echo "SQL Error: " . $conn->error; // Aggiungi questo per il debug
        $conn->close();
        return null;
    }
}


?>