<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates decompressing a file using the decompressFile method.
 * @desc <Greek> Παρουσιάζει την αποσυμπίεση αρχείου χρησιμοποιώντας τη μέθοδο decompressFile.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Net\TFTPHandler;

global $conf, $AOS_CACHE_PATH, $AOS_LOGS_PATH, $AOS_TMP_PATH;

// <English> Initialize properties array with configuration
// <Greek> Αρχικοποίηση πίνακα ιδιοτήτων με διαμόρφωση
$properties = [
    'ftp' => [
        'protocol' => 'sftp',
        'host' => 'example.com',
        'port' => 22,
        'username' => 'user',
        'password' => 'pass'
    ],
    'logs' => ['useLogger' => true, 'dir' => $AOS_LOGS_PATH],
    'cache' => ['cacheType' => 'file', 'cachePath' => $AOS_CACHE_PATH]
];

// <English> Create a new TFTPHandler instance
// <Greek> Δημιουργία νέου instance της TFTPHandler
$ftpHandler = new TFTPHandler($properties);

// <English> Decompress a file
// <Greek> Αποσυμπίεση αρχείου
if ($ftpHandler->decompressFile($AOS_TMP_PATH . '/source.zip', $AOS_TMP_PATH . '/extracted', 'zip')) {
    echo "File decompressed successfully\n";
} else {
    echo "Failed to decompress file\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>