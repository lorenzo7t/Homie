<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();



function downloadProfessionals() {
    include 'db_connection.php';
    header('Content-Type: application/json');

    $query = "SELECT * FROM homie.pro_data";
    $result = $conn->query($query);

    $professionals = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $coords = getLatLong($row['indirizzo']);

            $professional = [
                'nome' => ucfirst($row['nome']) . " " . ucfirst($row['cognome']),
                'professione' => ucfirst($row['professione']),
                'lat' => floatval($coords['lat']),
                'lng' => floatval($coords['lng']),
                'rating' => $row['rating'],
                'image' => strtolower(str_replace(' ', '', $row['nome']) . "-" . str_replace(' ', '', $row['cognome']) . "-" . $row['piva'] . ".jpeg"),
                'prezzo_orario' => "€" . $row['prezzo_orario'],
                'prezzo_chiamata' => "€" . $row['prezzo_chiamata'],
                'piva' => $row['piva'],
                'position' => $row['indirizzo']
            ];
            $professionals[] = $professional;
        }
        $conn->close();
        echo json_encode($professionals);
    } else {
        echo json_encode([]);
    }
}

function getLatLong($address) {
    $apiUrl = "https://geocode.maps.co/search?q=" . urlencode($address) . "&api_key=664669617aeef661539064zlu442ed8";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
    if ($data && isset($data[0]['place_id'])) {
        return ["lat" => $data[0]['lat'], "lng" => $data[0]['lon']];
    } else {
        return ["lat" => null, "lng" => null];
    }
}


function getAddress() {
    include 'db_connection.php';
    // Assumi che l'ID utente sia salvato in sessione
    $userId = $_SESSION['user_id'];
    $query = "SELECT address, lat, lng FROM user_data WHERE user_id = $userId";
    $result = $conn->query($query);

    if ($row = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'address' => $row['address'], 'lat' => (float) $row['lat'], 'lng' => (float) $row['lng']]);
    } else {
        echo json_encode(['success' => false]);
    }

    $conn->close();
}

function updateAddress() {
    include 'db_connection.php';
    $data = json_decode(file_get_contents('php://input'), true);
    $newAddress = $data['address'];
    // Puoi usare una funzione per ottenere lat e lng qui
    $coords = getLatLong($newAddress); // Assumi che questa funzione esista

    $userId = $_SESSION['user_id'];
    $query = "UPDATE user_data SET address = '$newAddress', lat = '{$coords['lat']}', lng = '{$coords['lng']}' WHERE user_id = $userId";
    if ($conn->query($query)) {
        echo json_encode(['success' => true, 'lat' => $coords['lat'], 'lng' => $coords['lng']]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    $conn->close();
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getProfessionals':
            downloadProfessionals();
            break;
        case 'getCoordinates':
            if (isset($_GET['address'])) {
                echo json_encode(getLatLong($_GET['address']));
            }
            break;
        case 'getAddress':
            getAddress();
            break;
        case 'updateAddress':
            updateAddress();
            break;
    }
}
?>
