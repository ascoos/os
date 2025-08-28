# System Monitoring and Backup

This case study demonstrates how **Ascoos OS** performs system resource monitoring, automated backup creation, encryption, and real-time alerts via Telegram. It showcases the integration of multiple handlers to ensure system stability and data protection.

## Purpose
This example highlights the use of the following Ascoos OS components:
- **TCoreSystemHandler**: Monitors CPU load, memory usage, and system uptime.
- **TFilesHandler**: Manages file operations, including folder creation, quota checks, and encryption.
- **TTelegramAPIHandler**: Sends real-time alerts via Telegram.
- **TEventHandler**: Registers and triggers custom system events.

## Structure
The case study is implemented in a single PHP file:
- [`system_monitoring_backup.php`](./system_monitoring_backup.php): Monitors system load, creates encrypted snapshots, and sends alerts.

## Prerequisites
1. Ensure Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If using [`AWES 26`](https://awes.ascoos.com), Ascoos OS is preloaded.
2. A valid Telegram bot token and chat ID are required for `TTelegramAPIHandler`.
3. Write permissions for the directories defined in `$AOS_LOGS_PATH` and `$AOS_BACKUP_PATH`.
4. The global variables (`$conf`, `$AOS_LOGS_PATH`, `$AOS_BACKUP_PATH`) are automatically set by Ascoos OS during initialization.
5. The [`phpBCL8`](https://github.com/ascoos/phpbcl8) library is preinstalled and loaded automatically.

## Getting Started
1. Configure the `$properties` array in the script with your Telegram bot token and chat ID.
2. Execute the script via a web server, e.g.:
   ```
   https://localhost/aos/examples/case-studies/system/monitoring/system_monitoring_backup.php
   ```

## Example Usage
```php
use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;
use ASCOOS\OS\Kernel\API\TTelegramAPIHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;

global $AOS_LOGS_PATH, $AOS_BACKUP_PATH;

// Initialize configuration
$properties = [
    'file' => [
        'dataDir' => $AOS_BACKUP_PATH . '/system_backups',
        'quotaSize' => 1000000
    ],
    'telegram' => [
        'url' => 'https://api.telegram.org',
        'bot_token' => 'your_bot_token_here'
    ],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/ascoos',
        'file' => 'system_monitor.log'
    ]
];
```

## Expected Output
The script generates an encrypted system snapshot and sends a Telegram alert if CPU load exceeds 80%. Example JSON snapshot:
```json
{
    "cpu_load_percent": 85,
    "memory_stats": {
        "total": 8192,
        "used": 6144,
        "free": 2048
    },
    "uptime_seconds": 36000,
    "timestamp": "2025-08-28 15:35:00"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or add new features to `system_monitoring_backup.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
