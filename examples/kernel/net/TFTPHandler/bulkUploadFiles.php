<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates bulk file upload using the bulkUploadFiles method.
 * @desc <Greek> Παρουσιάζει τη μαζική μεταφόρτωση αρχείων χρησιμοποιώντας τη μέθοδο bulkUploadFiles.
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
        'password' => 'pass',
        'useAsync' => true
    ],
    'logs' => ['useLogger' => true, 'dir' => $AOS_LOGS_PATH],
    'cache' => ['cacheType' => 'file', 'cachePath' => $AOS_CACHE_PATH]
];

// <English> Create a new TFTPHandler instance
// <Greek> Δημιουργία νέου instance της TFTPHandler
$ftpHandler = new TFTPHandler($properties);

// <English> Connect to the server
// <Greek> Σύνδεση στον διακομιστή
$ftpHandler->connect('example.com', 22, 'user', 'pass', false);

// <English> Define files to upload
// <Greek> Ορισμός αρχείων για μεταφόρτωση
$files = [
    $AOS_TMP_PATH . '/file1.txt' => '/remote/path/file1.txt',
    $AOS_TMP_PATH . '/file2.txt' => '/remote/path/file2.txt'
];

// <English> Define progress callback
// <Greek> Ορισμός callback για την πρόοδο
$progressCallback = function (array $progress) {
    echo "Uploaded {$progress['transferred']} of {$progress['total']} bytes for {$progress['file']}\n";
};

// <English> Bulk upload files
// <Greek> Μαζική μεταφόρτωση αρχείων
if ($ftpHandler->bulkUploadFiles($files, FTP_BINARY, $progressCallback)) {
    echo "Files uploaded successfully\n";
} else {
    echo "Failed to upload files\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>