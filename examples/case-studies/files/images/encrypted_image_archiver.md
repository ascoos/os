# Encrypted Image Archiver

This case study demonstrates how **Ascoos OS** can be used to securely process and archive images. The system resizes and watermarks input images, encrypts them, analyzes file sizes, and generates a visual report.

## Purpose
This example uses the following Ascoos OS classes:
- **TImagesHandler**: Loads, resizes, and watermarks images.
- **TFilesHandler**: Saves and encrypts files, checks quota.
- **TEventHandler**: Logs events for transparency and debugging.
- **TArrayAnalysisHandler**: Analyzes file sizes.
- **TArrayGraphHandler**: Generates bar chart of file size comparison.

## Structure
The case study is implemented in a single PHP file:
- [`encrypted_image_archiver.php`](./encrypted_image_archiver.php): Includes image processing, encryption, analysis, and reporting.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Ensure write permissions for `$AOS_LOGS_PATH` and `$AOS_TMP_DATA_PATH/image_archiver/`.
3. Place input files (`xray.jpg`, `watermark.png`) in the `input/` folder.
4. The font `Murecho-Regular.ttf` must be available at `$AOS_FONTS_PATH/Murecho/`.
5. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Verify that input images exist in the `input/` folder.
2. Run the script via web server:
   ```
   https://localhost/aos/examples/case-studies/files/images/encrypted_image_archiver.php
   ```

## Example Usage
```php
$processedImage = $imagesHandler->resize($imageData, 800, 600);
$processedImage = $imagesHandler->addWatermark($processedImage, $watermarkData, 10, 10, 0.5);
$imagesHandler->saveToFile($processedImage, $outputImage);
$filesHandler->encryptFile($outputImage, $encryptedImage, "AscoosSecretKey");
$graphHandler->setArray([$originalSize, $processedSize, $encryptedSize]);
$graphHandler->createBarChart('image_size_chart.png');
```

## Expected Output
The script generates a processed image, an encrypted copy, and a bar chart comparing file sizes. Example output:
```json
{
    "original": "/tmp/input/xray.jpg",
    "processed": "/image_archiver/image_20250828_230900.jpg",
    "encrypted": "/image_archiver/image_20250828_230900.enc",
    "chart": "/image_archiver/image_size_chart.png"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `encrypted_image_archiver.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
