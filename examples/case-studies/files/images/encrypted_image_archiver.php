<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> A system that processes images (resize, watermark), encrypts them, analyzes file sizes, and generates visual reports.
 * @desc <Greek> Ένα σύστημα που επεξεργάζεται εικόνες (αλλαγή μεγέθους, υδατογράφηση), τις κρυπτογραφεί, αναλύει τα μεγέθη αρχείων και δημιουργεί οπτικές αναφορές.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Images\TImagesHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;
use ASCOOS\OS\Extras\Arrays\Analysis\TArrayAnalysisHandler;
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;

global $conf, $AOS_TMP_DATA_PATH, $AOS_LOGS_PATH, $AOS_FONTS_PATH;

// <English> Define configuration for logging, file storage, and graphing.
// <Greek> Ορισμός ρυθμίσεων για καταγραφή, αποθήκευση αρχείων και δημιουργία γραφημάτων.
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'image_archiver.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/image_archiver',
        'quotaSize' => 10000000 // 10MB quota
    ],
    'graph' => [
        'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf',
        'width' => 800,
        'height' => 600
    ]
];

// <English> Initialize handlers.
// <Greek> Αρχικοποίηση χειριστών.
$imagesHandler = new TImagesHandler($properties);
$filesHandler = new TFilesHandler([], $properties['file']);
$eventHandler = new TEventHandler([], $properties);
$analysisHandler = new TArrayAnalysisHandler([], $properties);
$graphHandler = new TArrayGraphHandler([], array_merge($properties['graph'], ['fontPath' => $properties['graph']['fontPath']]));

// <English> Register events.
// <Greek> Καταχώριση γεγονότων.
$eventHandler->register('archiver', 'image.processed', fn($path) => $eventHandler->logger->log("Processed image: $path"));
$eventHandler->register('archiver', 'image.encrypted', fn($path) => $eventHandler->logger->log("Encrypted image: $path"));
$eventHandler->register('archiver', 'quota.exceeded', fn() => $eventHandler->logger->log("Quota exceeded"));

// <English> Define paths.
// <Greek> Ορισμός διαδρομών.
$imagePath = $AOS_TMP_DATA_PATH . '/input/xray.jpg';
$watermarkPath = $AOS_TMP_DATA_PATH . '/input/watermark.png';
$outputFolder = $properties['file']['baseDir'];
$filesHandler->createFolder($outputFolder);

// <English> Check quota.
// <Greek> Έλεγχος quota.
if ($filesHandler->isQuotaExceeded($outputFolder)) {
    $eventHandler->trigger('archiver', 'quota.exceeded');
    exit("Quota exceeded.");
}

// <English> Load and process image.
// <Greek> Φόρτωση και επεξεργασία εικόνας.
$imageData = $imagesHandler->loadFromFile($imagePath);
$watermarkData = $imagesHandler->loadFromFile($watermarkPath);
$processedImage = $imagesHandler->resize($imageData, 800, 600);
$processedImage = $imagesHandler->addWatermark($processedImage, $watermarkData, 10, 10, 0.5);

// <English> Save processed image.
// <Greek> Αποθήκευση επεξεργασμένης εικόνας.
$timestamp = date('Ymd_His');
$outputImage = "$outputFolder/image_$timestamp.jpg";
$imagesHandler->saveToFile($processedImage, $outputImage);
$eventHandler->trigger('archiver', 'image.processed', $outputImage);

// <English> Encrypt image.
// <Greek> Κρυπτογράφηση εικόνας.
$encryptedImage = "$outputFolder/image_$timestamp.enc";
$secretKey = $filesHandler->getDeepProperty(['security','keys','files_secret_key'], $conf) ?? "AscoosSecretKey";
$filesHandler->encryptFile($outputImage, $encryptedImage, $secretKey);
$eventHandler->trigger('archiver', 'image.encrypted', $encryptedImage);

// <English> Analyze file sizes.
// <Greek> Ανάλυση μεγεθών αρχείων.
$fileSizes = [
    $filesHandler->getFileSize($imagePath),
    $filesHandler->getFileSize($outputImage),
    $filesHandler->getFileSize($encryptedImage)
];
$analysisHandler->setArray($fileSizes);
$graphHandler->setArray($fileSizes);
$graphHandler->createBarChart("$outputFolder/image_size_chart.png");

// <English> Output result.
// <Greek> Εμφάνιση αποτελέσματος.
echo json_encode([
    'original' => $imagePath,
    'processed' => $outputImage,
    'encrypted' => $encryptedImage,
    'chart' => "$outputFolder/image_size_chart.png"
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// <English> Free resources.
// <Greek> Απελευθέρωση πόρων.
$imagesHandler->Free($imagesHandler);
$filesHandler->Free($filesHandler);
$eventHandler->Free($eventHandler);
$analysisHandler->Free($analysisHandler);
$graphHandler->Free($graphHandler);
