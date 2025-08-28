# Force Calculation in Mechanical Structures

This case study demonstrates how **Ascoos OS** can be used for technical computations in engineering applications. It calculates force using Newton’s Second Law, stores the result in a JSON file, and logs system events.

## Purpose
This example highlights the use of the following Ascoos OS components:
- **TMathsHandler**: Performs force calculations using mathematical operations.
- **TFilesHandler**: Stores results and checks quota limits.
- **TEventHandler**: Logs force calculation events.
- **TCoreSystemHandler**: Monitors CPU load and logs system status.

## Structure
The case study is implemented in a single PHP file:
- [`engineering_forces.php`](./engineering_forces.php): Includes calculation, storage, and logging.

## Prerequisites
1. Ensure Ascoos OS is installed ([main repository](https://github.com/ascoos/os)).
2. Write permissions for `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/ascoos_data/engineering/`.
3. Global variables (`$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH`) are automatically set by Ascoos OS.
4. The [`phpBCL8`](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/engineering/forces/engineering_forces.php
   ```

## Example Usage
```php
$mass = 100.0; // kg
$acceleration = 9.81; // m/s^2
$force = $maths->power($mass * $acceleration, 1); // F = m * a
```

## Expected Output
The script generates a JSON file with the calculated force. Example output:
```json
{
  "structure_id": "STR001",
  "force": 981,
  "timestamp": "2025-08-18T15:21:00+03:00"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `engineering_forces.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
