<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> WebSocket server that logs incoming messages and triggers events.
 * @desc <Greek> WebSocket server που καταγράφει εισερχόμενα μηνύματα και ενεργοποιεί γεγονότα.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Net\TWebSocketHandler,
    Arrays\Events\TEventHandler
};

global $AOS_LOGS_PATH;

// <English> Define configuration for logging.
// <Greek> Ορισμός ρυθμίσεων για καταγραφή.
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'websocket_activity.log'
    ]
];

// <English> Initialize WebSocket and event handlers.
// <Greek> Αρχικοποίηση χειριστών WebSocket και γεγονότων.
$ws = new TWebSocketHandler($properties);
$events = new TEventHandler([], $properties);

// <English> Register events for message handling.
// <Greek> Καταχώριση γεγονότων για χειρισμό μηνυμάτων.
$events->register('ws', 'message.received', fn($msg) => $events->logger->log("Message received: $msg"));
$events->register('ws', 'client.connected', fn($client) => $events->logger->log("Client connected: $client"));
$events->register('ws', 'client.disconnected', fn($client) => $events->logger->log("Client disconnected: $client"));

// <English> Enable WebSocket mode.
// <Greek> Ενεργοποίηση λειτουργίας WebSocket.
$ws->enableWebSocket();

// <English> Start listening for connections.
// <Greek> Έναρξη ακρόασης για συνδέσεις.
$ws->createSocket();
$ws->bindSocket('0.0.0.0', 8080);
$ws->listenSocket(5);

// <English> Handle multiple clients and messages.
// <Greek> Διαχείριση πολλαπλών πελατών και μηνυμάτων.
$ws->handleMultipleClients(function ($client, $data) use ($ws, $events) {
    // <English> Decode WebSocket frame.
    // <Greek> Αποκωδικοποίηση WebSocket frame.
    $message = $ws->receiveWebSocketFrame();

    // <English> Trigger message event.
    // <Greek> Ενεργοποίηση γεγονότος μηνύματος.
    $events->trigger('ws', 'message.received', $message);

    // <English> Echo message back to client.
    // <Greek> Επιστροφή μηνύματος στον πελάτη.
    $ws->sendWebSocketFrame("Echo: $message");
}, timeout: 30);
