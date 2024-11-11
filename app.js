const apiKey = "8b23a2d55eba747d8bb9de63c6430b7f"; // Your actual API key

// Handle form submission
document.getElementById('weather-form').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent the default form submission

    const city = document.getElementById('city-input').value.trim();
    const errorMessage = document.getElementById('error-message');
    const weatherInfo = document.getElementById('weather-info');
    
    // Clear previous data
    errorMessage.textContent = '';
    weatherInfo.style.display = 'none';

    if (city) {
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)}&appid=${apiKey}&units=metric`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.cod !== 200) {
                throw new Error("City not found");
            }

            // Populate weather info
            document.getElementById('city-name').textContent = data.name;
            document.getElementById('temp').textContent = data.main.temp;
            document.getElementById('weather-desc').textContent = data.weather[0].description;
            document.getElementById('humidity').textContent = data.main.humidity;
            document.getElementById('wind-speed').textContent = data.wind.speed;

            weatherInfo.style.display = 'block';
        } catch (error) {
            errorMessage.textContent = "Error fetching data. Please try again later.";
        }
    } else {
        errorMessage.textContent = "Please enter a city name.";
    }
});
