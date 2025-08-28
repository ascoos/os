<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Creation and storage of barcode and monitoring of system load.
 * @desc <Greek> Δημιουργία και αποθήκευση barcode και παρακολούθηση φόρτου συστήματος.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Files\TFilesHandler,
    Barcodes\TBarcodeHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

// <English> Initialize configuration for Web Disk Manager.
// <Greek> Αρχικοποίηση διαμόρφωσης για το Web Disk Manager.
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

// <English> Initialize ASCOOS classes.
// <Greek> Αρχικοποίηση κλάσεων ASCOOS.
$system = new TCoreSystemHandler($properties);
$files = new TFilesHandler([], $properties['file']);
$barcode = new TBarcodeHandler('4002593016013', ['width' => 300, 'height' => 120, 'fontSize' => 5, 'type' => 'ean13', 'thickness' => 2]);

// <English> Generate and save barcode.
// <Greek> Δημιουργία και αποθήκευση barcode.
$files->createFolder($properties['file']['baseDir']);
$barcodeData = $barcode->getBarcode('png');
$files->writeToFileWithCheck($barcodeData, $properties['file']['baseDir'] . '/file_4002593016013.png');

// <English> Log system performance.
// <Greek> Καταγραφή απόδοσης συστήματος.
if ($system->get_cpu_load(0) > 80) {
    $system->logger?->log("High CPU load during barcode creation: {$system->get_cpu_load(0)}%", $system::DEBUG_LEVEL_WARNING);
}

// <English> Output barcode metadata.
// <Greek> Εκτύπωση μεταδεδομένων barcode.
echo json_encode([
    'barcode_file' => 'file_4002593016013.png'
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
