<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates asynchronous file download using the asyncDownloadFile method.
 * @desc <Greek> Παρουσιάζει την ασύγχρονη λήψη αρχείου χρησιμοποιώντας τη μέθοδο asyncDownloadFile.
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

// <English> Define progress callback
// <Greek> Ορισμός callback για την πρόοδο
$progressCallback = function (array $progress) {
    echo "Downloaded {$progress['transferred']} of {$progress['total']} bytes ({$progress['percentage']}%)\n";
};

// <English> Asynchronously download a file
// <Greek> Ασύγχρονη λήψη αρχείου
if ($ftpHandler->asyncDownloadFile('/remote/path/file.txt', $AOS_TMP_PATH . '/downloaded_file.txt', FTP_BINARY, $progressCallback)) {
    echo "File downloaded successfully\n";
} else {
    echo "Failed to download file\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>