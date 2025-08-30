# Arduino Environmental Monitoring

This case study demonstrates how **Ascoos OS** can be used to monitor environmental sensors via Arduino, validate sensor data, log events, and generate visual reports. The system reads temperature and humidity values, performs validation, analyzes trends, and stores results.

## Purpose
This example uses the following Ascoos OS components:
- **TArduinoHandler**: Communicates with Arduino and reads sensor data.
- **TValidationHandler**: Validates sensor readings against defined rules.
- **TArrayAnalysisHandler**: Performs statistical analysis on collected data.
- **TArrayGraphHandler**: Generates visual charts from sensor data.
- **TEventHandler**: Logs events and triggers notifications.
- **TErrorMessageHandler**: Manages error messages and logs exceptions.

## Structure
The case study is implemented in a single PHP file:
- [`arduino_monitoring.php`](./arduino_monitoring.php): Includes sensor reading, validation, analysis, logging, and reporting.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)). If you're using [`Ascoos Web Extended Studio 26`](https://awes.ascoos.com), it's already preinstalled.
2. Connect an Arduino board with temperature and humidity sensors on analog pins A0 and A1.
3. Ensure the serial port (e.g., `/dev/ttyACM0`) is accessible and configured correctly.
4. Write permissions for `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/reports/arduino/`.
5. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Connect the Arduino and verify the port and baud rate.
2. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/iot/arduino/arduino_monitoring.php
   ```

## Example Usage
```php
$arduinoHandler->setPinMode(0, FIRMATA_PIN_MODE_ANALOG); // Temperature sensor
$arduinoHandler->setPinMode(1, FIRMATA_PIN_MODE_ANALOG); // Humidity sensor

$sensorData[] = ['temperature' => $arduinoHandler->analogRead(0), 'humidity' => $arduinoHandler->analogRead(1)];

$validationHandler->validate($sensorData[0], [
    'temperature' => 'required|numeric|min:0|max:1023',
    'humidity' => 'required|numeric|min:0|max:1023'
]);

$realData = $arduinoHandler->convertAnalogReadings($sensorData, 'DHT11');
$temps = array_column($realData, 'temperature');

$analysisHandler->clean();
$analysisHandler->setArray($temps, ['sensor', 'temperature']);
$meanTemp = $analysisHandler->mean();

$graphHandler->clean();
$graphHandler->setArray($temps, ['sensor', 'temperature']);
$graphHandler->createLineChart($graphHandler->getDeepProperty(['file', 'baseDir']) . '/temperature_trend.png');
```

## Expected Output
The script generates a JSON report and a PNG chart. Example output:
```json
{
    "mean_temperature": 512.3,
    "data_points": 10
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `arduino_monitoring.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
