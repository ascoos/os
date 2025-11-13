<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * 
 * @CASE-STUDY          : api_batch_orchestrator.php
 * @fileNo              : ASCOOS-OS-CASESTUDY-SEC00013
 * 
 * @desc <English> This case study demonstrates how Ascoos OS can be used to orchestrate multiple API requests with caching and event-driven logic. 
 * @desc <Greek>   Αυτή η μελέτη περίπτωσης δείχνει πώς το Ascoos OS μπορεί να χρησιμοποιηθεί για την ορχήστρωση πολλαπλών API αιτημάτων με caching και λογική γεγονότων. 
 * 
 * @since PHP 8.2.0+
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    API\TAPIHandler,
    Arrays\Events\TEventHandler
};
use function ASCOOS\OS\Kernel\Cache\selectCache;

global $AOS_CACHE_PATH, $AOS_LOGS_PATH;

// <English> Define configuration properties
// <Greek> Ορισμός ρυθμίσεων ιδιοτήτων
$properties = [
    'cache' => [
        'useCache' => true,
        'cacheType' => 'file',
        'cachePath' => $AOS_CACHE_PATH . '/' ,
        'cacheDuration' => 3000
    ],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH .'/',
        'file' => 'api_batch_orchestrator.log'
    ]
];

$options = [
    'headers' => [
        'Content-Type' => 'application/json'
    ], 
    'timeout' => 30
];

try {
    // <English> Create an Event Handler for logging
    // <Greek> Δημιουργία χειριστή γεγονότων για καταγραφή
    $eventHandler = new TEventHandler([], $properties);
    
    // <English> Register event for successful batch API request
    // <Greek> Εγγραφή γεγονότος για επιτυχημένο μαζικό αίτημα API
    $eventHandler->register('module', 'api.batch.success', fn($data) => error_log("Batch Success: " . json_encode($data)));

    // <English> Register event for failed batch API request
    // <Greek> Εγγραφή γεγονότος για αποτυχημένο μαζικό αίτημα API
    $eventHandler->register('module', 'api.batch.failed', fn($data) => error_log("Batch Failed: " . json_encode($data)));

    // <English> Initialize TCacheHandler for caching
    // <Greek> Αρχικοποίηση του TCacheHandler για caching
    $cacheHandler = selectCache(
        cacheType: $properties['cache']['cacheType'],       // <English> Cache type 
                                                            // <Greek> Τύπος cache
        cacheTime: $properties['cache']['cacheDuration'],   // <English> Cache duration in seconds
                                                            // <Greek> Διάρκεια cache σε δευτερόλεπτα
        properties: $properties,                            // <English> Cache directory
                                                            // <Greek> Κατάλογος cache
        cachePath: $properties['cache']['cachePath']
    );

    // <English> Initialize TAPIHandler for the JSONPlaceholder API
    // <Greek> Αρχικοποίηση της TAPIHandler για το JSONPlaceholder API
    $api = new TAPIHandler(
        url: 'https://jsonplaceholder.typicode.com',    // <English> Base URL for the API 
                                                        // <Greek> Βασική URL για το API
        type: 0,                                        // <English> Use TCurlHandler 
                                                        // <Greek> Χρήση TCurlHandler
        options: $options,                              // <English> Set headers and timeout 
                                                        // <Greek> Ορισμός headers και χρονικού ορίου
        properties:$properties,                         // <English> Cache settings 
                                                        // <Greek> Ρυθμίσεις cache
    );

    // <English> Set the event handler
    // <Greek> Ορισμός του χειριστή γεγονότων
    $api->setEventHandler($eventHandler);

    // <English> Define multiple endpoints for batch requests
    // <Greek> Ορισμός πολλαπλών endpoints για μαζικά αιτήματα
    $batchRequests = [
        ['endpoint' => 'posts', 'params' => ['userId' => 1]],       // <English> Fetch posts for user 1 
                                                                    // <Greek> Ανάκτηση posts για τον χρήστη 1
        ['endpoint' => 'comments', 'params' => ['postId' => 1]],    // <English> Fetch comments for post 1 
                                                                    // <Greek> Ανάκτηση σχολίων για το post 1
        ['endpoint' => 'users', 'params' => ['id' => 1]]            // <English> Fetch user data 
                                                                    // <Greek> Ανάκτηση δεδομένων χρήστη
    ];

    // <English> Execute batch GET requests with caching
    // <Greek> Εκτέλεση μαζικών GET αιτημάτων με caching
    $responses = [];
    foreach ($batchRequests as $request) {
        // <English> Generate cache key
        // Δημιουργία κλειδιού cache
        $cacheKey = md5($request['endpoint'] . json_encode($request['params'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        
        // <English> Check if response is in cache
        // <Greek> Έλεγχος αν η απόκριση υπάρχει στην cache
        $cacheData = $cacheHandler->getCache($cacheKey);
        if ($cacheData !== false) {
            $responses[$request['endpoint']] = $cacheData;
        } else {
            // <English> Execute GET request and cache response
            // <Greek> Εκτέλεση GET αιτήματος και αποθήκευση στην cache
            $response = $api->sendGetRequest("{$request['endpoint']}", $request['params']);
            $cacheHandler->saveCache($cacheKey, $response);
            $responses[$request['endpoint']] = $response;
        }
    }

    // <English> Emit event for successful batch processing
    // <Greek> Εκπομπή γεγονότος για επιτυχημένη μαζική επεξεργασία
    $api->emit('api.batch.success', ['responses' => $responses]);

    // <English> Display the responses
    // <Greek> Εμφάνιση των αποκρίσεων
    print_r($responses);

    // <English> Free resources
    // <Greek> Απελευθέρωση πόρων
    $api->Free();
    $cacheHandler->Free();
    $event->Free();

} catch (InvalidArgumentException $e) {
    // <English> Handle errors and emit failure event
    // <Greek> Χειρισμός σφαλμάτων και εκπομπή γεγονότος αποτυχίας
    $api->emit('api.batch.failed', ['error' => $e->getMessage()]);
    $api->Free();
    echo 'Error: ' . $e->getMessage();
}