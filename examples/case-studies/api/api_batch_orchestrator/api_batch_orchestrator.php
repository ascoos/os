<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> This case study demonstrates how Ascoos OS can be used to orchestrate multiple API requests with caching and event-driven logic. 
 * @desc <Greek>   Αυτή η μελέτη περίπτωσης δείχνει πώς το Ascoos OS μπορεί να χρησιμοποιηθεί για την ορχήστρωση πολλαπλών API αιτημάτων με caching και λογική γεγονότων. 
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\API\TAPIHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;
use function ASCOOS\OS\Kernel\Cache\selectCache;

try {
    // Create an Event Handler for logging
    // Δημιουργία χειριστή γεγονότων για καταγραφή
    $eventHandler = new TEventHandler();
    // Register event for successful batch API request
    // Εγγραφή γεγονότος για επιτυχημένο μαζικό αίτημα API
    $eventHandler->register('module', 'api.batch.success', fn($data) => error_log("Batch Success: " . json_encode($data)));
    // Register event for failed batch API request
    // Εγγραφή γεγονότος για αποτυχημένο μαζικό αίτημα API
    $eventHandler->register('module', 'api.batch.failed', fn($data) => error_log("Batch Failed: " . json_encode($data)));

    // Initialize TCacheHandler for caching
    // Αρχικοποίηση του TCacheHandler για caching
    $cacheHandler = selectCache(
        cacheType: 'file', // Cache type / Τύπος cache
        cacheTime: 3600, // Cache duration in seconds / Διάρκεια cache σε δευτερόλεπτα
        properties: ['cachePath' => '/tmp/ascoos_cache'], // Cache directory / Κατάλογος cache
        cachePath: '/tmp/ascoos_cache'
    );

    // Initialize TAPIHandler for the JSONPlaceholder API
    // Αρχικοποίηση της TAPIHandler για το JSONPlaceholder API
    $api = new TAPIHandler(
        url: 'https://jsonplaceholder.typicode.com', // Base URL for the API / Βασική URL για το API
        type: 0, // Use TCurlHandler / Χρήση TCurlHandler
        options: ['headers' => ['Content-Type' => 'application/json'], 'timeout' => 30], // Set headers and timeout / Ορισμός headers και χρονικού ορίου
        properties: ['cacheType' => 'file', 'cacheTime' => 3600], // Cache settings / Ρυθμίσεις cache
        cacheHandler: $cacheHandler // Pass cache handler / Πέρασμα του χειριστή cache
    );

    // Set the event handler
    // Ορισμός του χειριστή γεγονότων
    $api->setEventHandler($eventHandler);

    // Define multiple endpoints for batch requests
    // Ορισμός πολλαπλών endpoints για μαζικά αιτήματα
    $batchRequests = [
        ['endpoint' => 'posts', 'params' => ['userId' => 1]], // Fetch posts for user 1 / Ανάκτηση posts για τον χρήστη 1
        ['endpoint' => 'comments', 'params' => ['postId' => 1]], // Fetch comments for post 1 / Ανάκτηση σχολίων για το post 1
        ['endpoint' => 'users', 'params' => ['id' => 1]] // Fetch user data / Ανάκτηση δεδομένων χρήστη
    ];

    // Execute batch GET requests with caching
    // Εκτέλεση μαζικών GET αιτημάτων με caching
    $responses = [];
    foreach ($batchRequests as $request) {
        // Generate cache key
        // Δημιουργία κλειδιού cache
        $cacheKey = md5($request['endpoint'] . json_encode($request['params']));
        
        // Check if response is in cache
        // Έλεγχος αν η απόκριση υπάρχει στην cache
        if ($cacheHandler->checkCache($cacheKey)) {
            $responses[$request['endpoint']] = $cacheHandler->getCache($cacheKey);
        } else {
            // Execute GET request and cache response
            // Εκτέλεση GET αιτήματος και αποθήκευση στην cache
            $response = $api->sendGetRequest("{$request['endpoint']}", $request['params']);
            $cacheHandler->saveCache($cacheKey, $response);
            $responses[$request['endpoint']] = $response;
        }
    }

    // Emit event for successful batch processing
    // Εκπομπή γεγονότος για επιτυχημένη μαζική επεξεργασία
    $api->emit('api.batch.success', ['responses' => $responses]);

    // Display the responses
    // Εμφάνιση των αποκρίσεων
    print_r($responses);

    // Free resources
    // Απελευθέρωση πόρων
    $api->Free($api);
    $cacheHandler->Free($cacheHandler);

} catch (InvalidArgumentException $e) {
    // Handle errors and emit failure event
    // Χειρισμός σφαλμάτων και εκπομπή γεγονότος αποτυχίας
    $api->emit('api.batch.failed', ['error' => $e->getMessage()]);
    echo 'Error: ' . $e->getMessage();
}