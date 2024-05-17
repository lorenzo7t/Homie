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
    $apiKey = "AIzaSyAV2pCTErRiX6IWUu6Ol7gVE0U37rWWB_s";  // Sostituisci con la tua chiave API di Google Maps
    $baseUrl = "https://maps.googleapis.com/maps/api/geocode/json";
    $formattedAddress = urlencode($address);
    $url = "{$baseUrl}?address={$formattedAddress}&key={$apiKey}";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['results'][0])) {
        $geometry = $data['results'][0]['geometry']['location'];
        return [
            "lat" => $geometry['lat'],
            "lng" => $geometry['lng']
        ];
    } else {
        return ["lat" => null, "lng" => null];
    }
}



function getAddress() {
    include 'db_connection.php';
    $userId = $_SESSION['userid'];
    header('Content-Type: application/json');
    $query = "SELECT indirizzo FROM homie.user_data WHERE userid = $userId";
    $result = $conn->query($query);

    if ($row = $result->fetch_assoc()) {
        $coords = getLatLong($row['indirizzo']);
        echo json_encode(['success' => true, 'address' => $row['indirizzo'], 'lat' => (float) $coords['lat'], 'lng' => (float) $coords['lng']]);
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

    $userId = $_SESSION['userid'];
    $query = "UPDATE homie.user_data SET indirizzo = '$newAddress' WHERE userid = $userId";
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
