<?php

function fetchAPIResults($input) {
    // Construct the API URL with the input as a query parameter
    $apiUrl = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".urlencode($input)."&language=it&components=country:it&key=AIzaSyAV2pCTErRiX6IWUu6Ol7gVE0U37rWWB_s";

    // Make a GET request to the API
    $response = file_get_contents($apiUrl);

    // Check if the request was successful
    if ($response !== false) {
        // Parse the JSON response
        $results = json_decode($response, true);

        // Return the results
        return $results;
    } else {
        // Handle the error case
        return false;
    }
}

// Usage example
$input = $_POST['search']; // Assuming the input is coming from a POST request
$results = fetchAPIResults($input);


// Do something with the results
if ($results !== false) {
    // Display the results
    foreach ($results as $result) {
        echo $result['name'] . "<br>";
    }
} else {
    echo "Error fetching API results.";
}

?>