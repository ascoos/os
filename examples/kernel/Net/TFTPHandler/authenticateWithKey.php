<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates SFTP authentication using public/private key with the authenticateWithKey method.
 * @desc <Greek> Παρουσιάζει την πιστοποίηση SFTP με δημόσιο/ιδιωτικό κλειδί χρησιμοποιώντας τη μέθοδο authenticateWithKey.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Net\TFTPHandler;

global $conf, $AOS_CACHE_PATH, $AOS_SSL_PATH;

// <English> Initialize properties array with configuration
// <Greek> Αρχικοποίηση πίνακα ιδιοτήτων με διαμόρφωση
$properties = [
    'ftp' => [
        'protocol' => 'sftp',
        'host' => 'example.com',
        'port' => 22,
        'publicKey' => $conf['ssl']['paths']['public'] . '/public.key' ?? $AOS_SSL_PATH . '/public/public.key',
        'privateKey' => $conf['ssl']['paths']['private'] . '/private.key' ?? $AOS_SSL_PATH . '/private/private.key'
    ],
    'logs' => ['useLogger' => true, 'dir' => $AOS_LOGS_PATH],
    'cache' => ['cacheType' => 'file', 'cachePath' => $AOS_CACHE_PATH]
];

// <English> Create a new TFTPHandler instance
// <Greek> Δημιουργία νέου instance της TFTPHandler
$ftpHandler = new TFTPHandler($properties);

// <English> Connect to the server
// <Greek> Σύνδεση στον διακομιστή
$ftpHandler->connect('example.com', 22);

// <English> Authenticate with key
// <Greek> Πιστοποίηση με κλειδί
if ($ftpHandler->authenticateWithKey('user', $AOS_SSL_PATH . '/public/public.key', $AOS_SSL_PATH . '/private/private.key', '')) {
    echo "Authenticated successfully with key\n";
} else {
    echo "Authentication failed\n";
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$ftpHandler->Free($ftpHandler);
?>