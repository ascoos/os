<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates restoring a directory listing from cache using the restoreFileListFromCache method.
 * @desc <Greek> Παρουσιάζει την επαναφορά λίστας καταλόγου από cache χρησιμοποιώντας τη μέθοδο restoreFileListFromCache.
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

// <English> Connect to the server
// <Greek> Σύνδεση στον διακομιστή
$ftpHandler->connect('example.com', 22, 'user', 'pass', false);

// <English> Cache a directory listing first
// <Greek> Αποθήκευση λίστας καταλόγου πρώτα
$ftpHandler->cacheFileList('/remote/path', 'remote_dir_cache');

// <English> Restore directory listing from cache
// <Greek> Επαναφορά λίστας καταλόγου από cache
$files = $ftpHandler->restoreFileListFromCache('remote_dir_cache');
print_r($files);

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>