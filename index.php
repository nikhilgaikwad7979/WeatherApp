<?php
$apiKey = "YOUR_API_KEY"; // Replace with your API key
$city = isset($_GET['city']) ? $_GET['city'] : 'London'; // Default city
$weatherData = null;

if (!empty($city)) {
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric"; // Use appropriate API endpoint
    $response = file_get_contents($url);
    $weatherData = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

form {
    margin-bottom: 20px;
}

input {
    padding: 5px;
    width: 200px;
}

button {
    padding: 5px;
}

</style>
</head>
<body>
    <h1>Weather App</h1>
    <form method="GET">
        <input type="text" name="city" placeholder="Enter city" required>
        <button type="submit">Get Weather</button>
    </form>

    <?php if ($weatherData): ?>
        <h2>Weather in <?php echo htmlspecialchars($weatherData['name']); ?></h2>
        <p>Temperature: <?php echo $weatherData['main']['temp']; ?> °C</p>
        <p>Weather: <?php echo $weatherData['weather'][0]['description']; ?></p>
        <p>Humidity: <?php echo $weatherData['main']['humidity']; ?>%</p>
        <p>Wind Speed: <?php echo $weatherData['wind']['speed']; ?> m/s</p>
    <?php elseif (isset($_GET['city'])): ?>
        <p>City not found. Please try again.</p>
    <?php endif; ?>
</body>
</html>
