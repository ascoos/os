<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 26.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 * 
 * @CASE-STUDY          : laravel_autoload.php
 * @fileNo              : ASCOOS-OS-CASESTUDY-SEC00103
 * 
 * @desc <English> Laravel Autoloader for Ascoos OS integration via LibIn.
 * @desc <Greek> Autoloader του Laravel για ενσωμάτωση στο Ascoos OS μέσω LibIn.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Arrays\Macros\TMacroHandler,
    Arrays\Events\TEventHandler
};
use Exception;

// <English> Loading via Ascoos OS autoloader
// <Greek> Φόρτωση μέσω Ascoos OS autoloader
global $conf, $AOS_LIBS_PATH;

// <English> Settings for logging, and events to manage logs, reports, and event triggers
// <Greek> Ρυθμίσεις για logging και γεγονότα για τη διαχείριση logs, αναφορών και εκπομπής γεγονότων
$properties = [
    'cache' => $conf['cache'],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'laravel_loads.log'
    ]
];

// <English> Initialize Ascoos OS macro handler for Laravel tasks.
// <Greek>   Αρχικοποίηση του Ascoos OS macro handler για tasks του Laravel.
$macroHandler =& TMacroHandler::getInstance([], $properties);

// <English> Log event using Ascoos OS event handler.
// <Greek>   Καταγραφή γεγονότος με τον Ascoos OS event handler.
$eventHandler =& TEventHandler::getInstance([], $properties);

try {
    // <English> Define Laravel base path
    // <Greek> Ορισμός της βασικής διαδρομής του Laravel
    define('LARAVEL_BASE_PATH', $AOS_LIBS_PATH . '/laravel');

    // <English> If the Laravel vendors code autoload file does not exist
    // <Greek> Εάν το αρχείο αυτόματης φόρτωσης κώδικα των προμηθευτών Laravel δεν υπάρχει
    if (!file_exists(LARAVEL_BASE_PATH . '/vendor/autoload.php')) {
        throw new Exception('Laravel vendor not found. Ensure archive is uploaded via LibIn.');
    }

    // <English> Load Laravel vendor autoloader, included in the archive uploaded via LibIn.
    // <Greek>   Φόρτωση του Laravel vendor autoloader, που περιλαμβάνεται στο archive που ανέβηκε μέσω LibIn.
    require_once LARAVEL_BASE_PATH . '/vendor/autoload.php';

    // <English> Bootstrap Laravel application
    // <Greek> Εκκίνηση εφαρμογής Laravel
    $laravel_app = require_once LARAVEL_BASE_PATH . '/bootstrap/app.php';

    // <English> Optionally bind Laravel to global scope for mixed usage
    // <Greek> Συνδέστε προαιρετικά το Laravel στο δημόσιο εύρος για μικτή χρήση
    $GLOBALS['laravel_app'] = $laravel_app;

    // <English> Initialize Ascoos OS macro handler for Laravel tasks.
    // <Greek>   Αρχικοποίηση του Ascoos OS macro handler για tasks του Laravel.
    $macroHandler =& TMacroHandler::getInstance([], $properties);

    // <English>  Adds a macro with parameters, delay, and priority to the execution queue.
    // <Greek>    Προσθέτει μια μακροεντολή με παραμέτρους, καθυστέρηση και προτεραιότητα στην ουρά εκτέλεσης.
    $macroHandler->addMacro(fn() => $laravel_app->make('log')->info('Laravel initialized with Ascoos OS'));

    // <English> The result of the macro execution. 
    // <Greek> Το αποτέλεσμα της εκτέλεσης της μακροεντολής.
    $result = $macroHandler->runNext();

    // <English> Log event using Ascoos OS event handler.
    // <Greek>   Καταγραφή γεγονότος με τον Ascoos OS event handler.
    $eventHandler =& TEventHandler::getInstance([], $properties);
    $eventHandler->setTargets(['laravel_init']);
    $eventHandler->register('laravel_init', 'framework', fn() => $eventHandler->logger->log("Laravel integration successful at " . date('Y-m-d H:i:s'), $eventHandler::DEBUG_LEVEL_INFO));
    $eventHandler->trigger('laravel_init', 'framework');

    // <English> You may also register Laravel services or facades here
    // <Greek> Μπορείτε επίσης να καταχωρήσετε εδώ τις υπηρεσίες ή τα facades του Laravel    
} catch (Exception $e) {
    error_log("Error: {$e->getMessage()}");
    echo "Error: {$e->getMessage()}\n";
}

// <English> Resource cleanup and memory release.
// <Greek>   Εκκαθάριση πόρων και απελευθέρωση μνήμης.
$macroHandler->Free($macroHandler);
$eventHandler->Free($eventHandler);
?>