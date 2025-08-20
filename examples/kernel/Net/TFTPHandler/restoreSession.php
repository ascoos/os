<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates restoring a session using the restoreSession method.
 * @desc <Greek> Παρουσιάζει την επαναφορά συνεδρίας χρησιμοποιώντας τη μέθοδο restoreSession.
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

// <English> Connect to the server and save session
// <Greek> Σύνδεση στον διακομιστή και αποθήκευση συνεδρίας
$ftpHandler->connect('example.com', 22, 'user', 'pass', false);
$sessionId = 'session_123';
$ftpHandler->saveSession($sessionId);

// <English> Restore session
// <Greek> Επαναφορά συνεδρίας
if ($ftpHandler->restoreSession($sessionId)) {
    echo "Session restored successfully\n";
} else {
    echo "Failed to restore session\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>