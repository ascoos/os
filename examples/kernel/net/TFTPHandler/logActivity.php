<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates logging an activity using the logActivity method.
 * @desc <Greek> Παρουσιάζει την καταγραφή δραστηριότητας χρησιμοποιώντας τη μέθοδο logActivity.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Net\TFTPHandler;

global $conf, $AOS_CACHE_PATH, $AOS_LOGS_PATH;

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

// <English> Log an activity
// <Greek> Καταγραφή δραστηριότητας
if ($ftpHandler->logActivity('Sample FTP activity', 'info')) {
    echo "Activity logged successfully\n";
} else {
    echo "Failed to log activity\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>