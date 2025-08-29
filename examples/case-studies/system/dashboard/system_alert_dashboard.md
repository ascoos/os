# Real-Time System Alert Dashboard

This case study demonstrates how **Ascoos OS** can be used to monitor system and Apache server resources in real time, trigger alerts when thresholds are exceeded, log events, and generate visual reports.

## Purpose
This example uses the following Ascoos OS classes:
- **TCoreSystemHandler**: Monitors CPU, memory, disk, uptime, and network usage.
- **TApacheHandler**: Checks Apache status and performance.
- **TEventHandler**: Logs alerts and system events.
- **TArrayGraphHandler**: Generates visual charts of system metrics.
- **THTAccessHandler**, **TCSPHandler**, **TCORSHeaderHandler**: Optional security hardening.

## Structure
The case study is implemented in a single PHP file:
- [`system_alert_dashboard.php`](./system_alert_dashboard.php): Includes monitoring, alerting, logging, and reporting.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Ensure write permissions for `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/reports/`.
3. The font `Murecho-Regular.ttf` must be available at `$AOS_FONTS_PATH/Murecho/`.
4. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/system/dashboard/system_alert_dashboard.php
   ```

## Example Usage
```php
$cpu = $system->get_cpu_load(0);
$memory = $system->get_memory_stats()['percent'];
$apacheRunning = $apache->isServerRunning();

if ($cpu > 85) {
    $eventHandler->trigger('alerts', 'cpu.high', ['cpu' => $cpu]);
}
$graphHandler->setArray([$cpu, $memory]);
$graphHandler->createGaugeChart('/reports/system_metrics.png');
```

## Expected Output
The script generates a JSON summary and a PNG chart. Example output:
```json
{
    "cpu": 87.5,
    "memory": 82.3,
    "apache_running": true,
    "graph": "/reports/system_metrics.png"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `system_alert_dashboard.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
