<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates monitoring transfer progress using the monitorTransferProgress method.
 * @desc <Greek> Παρουσιάζει την παρακολούθηση προόδου μεταφοράς χρησιμοποιώντας τη μέθοδο monitorTransferProgress.
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
$monitorCallback = function (array $progress) {
    echo "Transferred {$progress['bytes_transferred']} bytes at {$progress['speed']} bytes/sec (Elapsed: {$progress['elapsed_time']} sec)\n";
};

// <English> Monitor transfer progress
// <Greek> Παρακολούθηση προόδου μεταφοράς
if ($ftpHandler->monitorTransferProgress($monitorCallback, 1)) {
    echo "Transfer progress monitoring started\n";
    // Simulate a transfer
    $ftpHandler->downloadFile('/remote/path/file.txt', $AOS_TMP_PATH . '/downloaded_file.txt', FTP_BINARY);
} else {
    echo "Failed to monitor transfer progress\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>