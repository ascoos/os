<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Bind client-side UI events to server-side logic
 * @desc <Greek> Δεσμεύει συμβάντα από το UI (π.χ. `onClick`), με λογική στον server.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);


use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;

global $AOS_LOGS_PATH;

try {
    // Αρχικοποίηση του TEventHandler
    $eventHandler = new TEventHandler([], [
        'logs' => [
            'useLogger' => true,
            'dir' => $AOS_LOGS_PATH . '/tmp/logs/',
            'file' => 'events.log'
        ]
    ]);

    // Καταχώριση συμβάντος onClick για UI στοιχείο
    $eventHandler->register('ui', 'onClick', function ($params) {
        echo "Button clicked with element ID: " . $params['elementId'] . "\n";
    });

    // Ενεργοποίηση του συμβάντος με δεδομένα από client
    $eventHandler->trigger('ui', 'onClick', ['elementId' => 'submitButton']);

    // Απελευθέρωση πόρων
    $eventHandler->Free($eventHandler);

} catch (InvalidArgumentException $e) {
    echo 'Σφάλμα: ' . $e->getMessage();
}