# Barcode Creation and System Monitoring

This case study demonstrates how **Ascoos OS** creates and stores barcodes while monitoring system load. The example generates an EAN-13 barcode for a product code (e.g., 4002593016013) and saves it as a PNG file, tracking CPU usage throughout the process.

## Purpose
This example showcases the integration of multiple Ascoos OS components:
- **TBarcodeHandler**: Generates barcodes with customizable dimensions and types (e.g., EAN-13).
- **TFilesHandler**: Manages file operations, such as saving the barcode image.
- **TCoreSystemHandler**: Monitors system load and logs high CPU usage.

## Structure
The case study is implemented in a single PHP file:
- [`barcode_creation.php`](./barcode_creation.php): Demonstrates the workflow of barcode generation, storage, and system monitoring.

## Prerequisites
1. Ensure Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If using the [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), Ascoos OS is preloaded.
2. Write permissions for the directory defined in `$AOS_LOGS_PATH` (logs) and `$AOS_TMP_DATA_PATH/barcodes/` (output files). These paths are automatically configured by Ascoos OS.
3. The font file `Murecho-Regular.ttf` is preinstalled with Ascoos OS at `$AOS_FONTS_PATH/Murecho/Murecho-Regular.ttf`. Additional fonts can be added dynamically via the `LibIn` program using an Ajax form.
4. The global variables (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`) are automatically set by Ascoos OS during initialization.
5. The `phpBCL8` library ([https://github.com/ascoos/phpbcl8](https://github.com/ascoos/phpbcl8)) is preinstalled and loaded automatically by Ascoos OS without requiring Composer.

## Getting Started
1. Ensure the global variables (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`) are available, as they are set by Ascoos OS during initialization.
2. Modify the product code and barcode parameters (e.g., `width`, `height`, `type`) in the `$barcode` initialization if needed (default is `4002593016013`, EAN-13).
3. Execute the script via a web server, e.g., `https://localhost/aos/examples/case-studies/barcodes/creation/barcode_creation.php`.

## Example Usage
```php
use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Files\TFilesHandler,
    Barcodes\TBarcodeHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

// Initialize configuration
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'disk_barcode.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/barcodes',
        'quotaSize' => 1000000000 // 1GB quota
    ]
];

// Initialize ASCOOS classes
$system = new TCoreSystemHandler($properties);
$files = new TFilesHandler([], $properties['file']);
$barcode = new TBarcodeHandler('4002593016013', ['width' => 300, 'height' => 120, 'fontSize' => 5, 'type' => 'ean13', 'thickness' => 2]);
```

## Expected Output
The script generates a PNG barcode file (`file_4002593016013.png`) and outputs JSON metadata. Example output:
```json
{
    "barcode_file": "file_4002593016013.png"
}
```
- Log file (disk_barcode.log): "High CPU load during barcode creation: 85.2%" (if CPU load exceeds 80%)
- Files created: `$AOS_TMP_DATA_PATH/barcodes/file_4002593016013.png`

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS on LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS on X](https://www.x.com/ascoos)
- [Ascoos Web Extended Studio](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)

## Contributing
Want to contribute to this case study? Fork the repository, modify or add new features to `barcode_creation.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
