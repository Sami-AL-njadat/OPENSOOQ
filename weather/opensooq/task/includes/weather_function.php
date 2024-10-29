<?php
session_start();

function getWeatherData($city) {
    $apiUrl = "http://localhost/OPENSOOQ/weather/opensooq/task/includes/fetch.php?city=" . urlencode($city);
    
    // Fetch the data
    $response = @file_get_contents($apiUrl); // Suppress errors with @ to handle them manually
    if ($response === false) {
        return "<div class='alert alert-danger error-message'><i class='fas fa-exclamation-triangle'></i> Unable to fetch data. Please check the server connection or URL.</div>";
    }

    $weatherData = json_decode($response, true);
    
    // Check if the data is valid and display the result or an error message
    if (isset($weatherData['error']) || !isset($weatherData['main'])) {
        return "<div class='alert alert-danger error-message'><i class='fas fa-exclamation-triangle'></i> City not found. Please enter a valid city name.</div>";
    } else {
        $output = "<div class='alert alert-success'>Weather data for <strong>{$city}</strong>:</div>";
        $output .= "<ul class='list-group card'>";
        $output .= "<li class='list-group-item'><i class='fas fa-thermometer-half'></i> Temperature: {$weatherData['main']['temp']} °C</li>";
        $output .= "<li class='list-group-item'><i class='fas fa-tint'></i> Humidity: {$weatherData['main']['humidity']}%</li>";
        $output .= "<li class='list-group-item'><i class='fas fa-cloud'></i> Weather: {$weatherData['weather'][0]['description']}</li>";
        $output .= "<li class='list-group-item'><i class='fas fa-wind'></i> Wind Speed: {$weatherData['wind']['speed']} m/s</li>";
        $output .= "</ul>";
        return $output;
    }
}

// Handle form submission
$weatherOutput = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['weather'])) {
    $city = trim($_POST['city']);
    
    // Check if the city is empty
    if (empty($city)) {
        $weatherOutput = "<div class='alert alert-warning'>Please enter a city name.</div>";
    } else {
        // Redirect to prevent resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?city=" . urlencode($city));
        exit(); // Exit to prevent further code execution
    }
}

// Get the city from the URL if it exists to display the weather data
if (isset($_GET['city']) && !empty($_GET['city'])) {
    $city = $_GET['city'];
    $weatherOutput = getWeatherData($city);
}
?>
