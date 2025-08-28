# Medical Data Management and Notifications

This case study demonstrates how **Ascoos OS** can be used to securely and efficiently manage medical data. It validates patient information, processes medical images (e.g., X-rays), logs system events, and stores encrypted records—all powered by the modular Web 5.0 Kernel.

## Purpose
This example highlights the use of the following Ascoos OS components:
- **TImagesHandler**: Loads, resizes, and watermarks medical images.
- **TDatesHandler**: Manages appointment dates and schedules follow-ups.
- **TXValidationHandler**: Validates patient data against defined rules.
- **TFilesHandler**: Handles file storage, encryption, and quota checks.
- **TEventHandler**: Logs events such as validation success/failure and image processing.

## Structure
The case study is implemented in a single PHP file:
- [`medical_data_management.php`](./medical_data_management.php): Performs validation, image processing, encrypted storage, and event logging.

## Prerequisites
1. Ensure Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If using [`Ascoos Web Extended Studio 26`](https://awes.ascoos.com), Ascoos OS is preloaded.
2. Write permissions for the directories `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/medical/`.
3. Preloaded image files (e.g., `xray_input.jpg`, `watermark.png`) in the `medical/` folder.
4. Font file `Murecho-Regular.ttf` available at `$AOS_FONTS_PATH/Murecho/`.
5. Global variables (`$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH`) are automatically set by Ascoos OS.
6. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Ensure input images are placed in the `medical/` folder.
2. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/health/medical/medical_data_management.php
   ```

## Example Usage
```php
// Validate patient data
$rules = [
    'patient_id' => 'required|string|min:5|max:10',
    'name' => 'required|string|max:100',
    'appointment_date' => 'required|date',
    'xray_image' => 'required|string|file_exists'
];
if ($validator->validate($patientData, $rules)) {
    $patientData['follow_up_date'] = $datesHandler->addDays($patientData['appointment_date'], 7, 'Y-m-d');
    $eventHandler->trigger('medical', 'validation.success', $patientData);
}

// Process X-ray image
$imageData = $imagesHandler->loadFromFile($imagePath);
$processedImage = $imagesHandler->resize($imageData, 800, 600);
$processedImage = $imagesHandler->addWatermark($processedImage, $watermarkData, 10, 10, 0.5);
$imagesHandler->saveToFile($processedImage, $outputImagePath);
```

## Expected Output
The script generates an encrypted JSON file containing patient data and image metadata. Example output:
```json
{
    "patient_id": "P12345",
    "name": "John Doe",
    "appointment_date": "2025-08-15",
    "follow_up_date": "2025-08-22",
    "processed_image": "/medical/xray_processed_20250828_175400.jpg",
    "processed_at": "2025-08-28 17:54:00"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `medical_data_management.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
