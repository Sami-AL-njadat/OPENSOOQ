<?php
session_start();

function getWeatherData($city)
{
    $apiUrl = "http://localhost/OPENSOOQ/weather/opensooq/task/includes/fetch.php?city=" . urlencode($city);

    $response = @file_get_contents($apiUrl);
    if ($response === false) {
        return "<div class='alert alert-danger error-message mt-2'><i class='fas fa-exclamation-triangle'></i> Unable to fetch data. Please check the server connection or URL.</div>";
    }

    $weatherData = json_decode($response, true);

    // Check if the data is valid and display the result or an error message
    if (isset($weatherData['error']) || !isset($weatherData['main'])) {
        return "<div class='alert alert-danger error-message mt-2'><i class='fas fa-exclamation-triangle'></i> City not found. Please enter a valid city name.</div>";
    } else {
        $output = "<div class='alert alert-success  success-message mt-2'>Weather data for <strong>{$city}</strong>:</div>";
        $output .= "<ul class='list-group card mt-4'>";
        $output .= "<li class='list-group-item'><i class='fas fa-flag'></i> Country: {$weatherData['sys']['country']} </li>";
        $output .= "<li class='list-group-item'><i class='fas fa-thermometer-half'></i> Temperature: {$weatherData['main']['temp']} °C</li>";
        $output .= "<li class='list-group-item'><i class='fas fa-tint'></i> Humidity: {$weatherData['main']['humidity']}%</li>";
        $output .= "<li class='list-group-item'><i class='fas fa-cloud'></i> Weather: {$weatherData['weather'][0]['description']}</li>";
        $output .= "<li class='list-group-item'><i class='fas fa-wind'></i> Wind Speed: {$weatherData['wind']['speed']} m/s</li>";
        $output .= "</ul>";
        return $output;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['weather'])) {
    $city = trim($_POST['city']);

    if (empty($city)) {
        $_SESSION['weatherOutput'] = "<div class='alert alert-warning mt-2'><i class='fas fa-exclamation-triangle'></i> Please enter a city name.</div>";
    } else {
        $_SESSION['weatherOutput'] = getWeatherData($city);
    }

     header("Location: ../page/weather.php");  
    exit();
}
