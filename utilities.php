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
    }
}
?>
