# Geolocation and Weather Data Microapplication

This case study demonstrates how **Ascoos OS** can be used to build microapplications that combine geolocation and weather data. It integrates external APIs, validates responses, logs events, and securely stores the results.

## Purpose
This example highlights the use of the following Ascoos OS components:
- **TGoogleMapsHandler**: Retrieves geolocation data via Google Maps API.
- **TOpenWeatherMapHandler**: Fetches weather data via OpenWeatherMap API.
- **TXValidationHandler**: Validates API response data.
- **TFilesHandler**: Stores and encrypts combined data.
- **TEventHandler**: Logs validation and storage events.
- **TDatesHandler**: Manages timestamps and date formatting.

## Structure
The case study is implemented in a single PHP file:
- [`microapp_geo_weather.php`](./microapp_geo_weather.php): Includes data retrieval, validation, encryption, and logging.

## Prerequisites
1. Ensure Ascoos OS is installed ([main repository](https://github.com/ascoos/os)). If using [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), it is preloaded.
2. Valid API keys for Google Maps and OpenWeatherMap.
3. Write permissions for `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/microapp_data/`.
4. Global variables (`$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH`) are automatically set by Ascoos OS.
5. The [`phpBCL8`](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Set your API keys in the script.
2. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/location/weather/microapp_geo_weather.php
   ```

## Example Usage
```php
$geoResponse = $googleMapsHandler->geocode(['address' => 'Athens, Greece', 'key' => $apiKey]);
$weatherResponse = $weatherHandler->getWeather([
    'lat' => $geoData['lat'],
    'lon' => $geoData['lng'],
    'appid' => $weatherApiKey
]);
$filesHandler->encryptFile($rawFile, $encryptedFile, 'Hi! I\'m Ascoos OS');
```

## Expected Output
The script generates an encrypted JSON file containing geolocation and weather data. Example output:
```json
{
  "location": {
    "address": "Athens, Greece",
    "coordinates": {
      "lat": 37.9838,
      "lng": 23.7275
    }
  },
  "weather": {
    "temp": 29.5,
    "weather": "clear sky",
    "timestamp": "2025-08-28 18:45:00"
  },
  "processed_at": "2025-08-28 18:49:00"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `microapp_geo_weather.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
