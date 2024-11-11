<?php
$apiKey = "8b23a2d55eba747d8bb9de63c6430b7f"; // Replace with your actual API key
$city = isset($_GET['city']) ? $_GET['city'] : 'London'; // Default city
$weatherData = null;

if (!empty($city)) {
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $apiKey . "&units=metric"; // Use user-provided city name
    $response = @file_get_contents($url); // Suppress warnings

    if ($response === FALSE) {
        $error = "Error fetching data. Please try again later.";
    } else {
        $weatherData = json_decode($response, true);
        if (isset($weatherData['cod']) && $weatherData['cod'] !== 200) {
            $error = "City not found. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container col-md-6">
      
        <div class="card text-center ">
            <div class="card-body mb-2  text-bg-darks
            ">
            <div class="text-bg-dark">
                <h1 class="card-title">Weather App</h1>
                <form method="GET" class="mb-3">
                    <div class="row justify-content-center mb-2">
                        <div class="col-8">
                            <input type="text" name="city" class="form-control" placeholder="Enter city" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Get Weather</button>
                </form>

                <?php if (isset($error)): ?>
                    <p class="text-danger"><?php echo htmlspecialchars($error); ?></p>
                <?php elseif ($weatherData): ?>
                    <div class="weather-info">
                        <h2 class="card-subtitle mb-2"><?php echo htmlspecialchars($weatherData['name']); ?></h2>
                        <p>Temperature: <?php echo $weatherData['main']['temp']; ?> °C</p>
                        <p>Weather: <?php echo $weatherData['weather'][0]['description']; ?></p>
                        <p>Humidity: <?php echo $weatherData['main']['humidity']; ?>%</p>
                        <p>Wind Speed: <?php echo $weatherData['wind']['speed']; ?> m/s</p>
                    </div>
                <?php endif; ?>
            </div>
                </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
