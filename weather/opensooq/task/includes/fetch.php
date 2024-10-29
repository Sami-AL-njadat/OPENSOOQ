<?php
if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $apiKey = 'd3f1272e1e1aa880f35e602c094521d0';
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    $response = file_get_contents($apiUrl);
    
    if ($response === FALSE) {
        echo json_encode(['error' => 'Failed to fetch weather data.']);
    } else {
        $weatherData = json_decode($response, true);

        // Check if city is not found
        if (isset($weatherData['cod']) && $weatherData['cod'] == 404) {
            echo json_encode(['error' => 'City not found. Please enter a valid city name.']);
        } else {
            echo $response;
        }
    }
} elseif (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
    $apiKey = 'd3f1272e1e1aa880f35e602c094521d0';
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric";

    $response = file_get_contents($apiUrl);

    if ($response === FALSE) {
        echo json_encode(['error' => 'Failed to fetch weather data.']);
    } else {
        $weatherData = json_decode($response, true);

        // Check if location is invalid
        if (isset($weatherData['cod']) && $weatherData['cod'] == 404) {
            echo json_encode(['error' => 'Location not found.']);
        } else {
            echo $response;
        }
    }
} else {
    echo json_encode(['error' => 'City parameter missing']);
}
?>
