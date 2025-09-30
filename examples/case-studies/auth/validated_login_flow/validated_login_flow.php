<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Validates login credentials before authentication and emits events accordingly.
 * @desc <Greek> Επικυρώνει τα credentials πριν την αυθεντικοποίηση και εκπέμπει γεγονότα ανάλογα.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Auth\TAuthenticationHandler;
use ASCOOS\OS\Kernel\Validation\TValidationHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;

global $AOS_LOGS_PATH;

// <English> Define configuration.
// <Greek> Ορισμός ρυθμίσεων.
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'validated_login.log'
    ]
];

// <English> Initialize handlers.
// <Greek> Αρχικοποίηση χειριστών.
$auth = new TAuthenticationHandler($properties);
$validator = new TValidationHandler($properties);
$events = new TEventHandler([], $properties);

// <English> Link event handler.
// <Greek> Σύνδεση χειριστή γεγονότων.
$auth->setEventHandler($events);
$validator->setEventHandler($events);

// <English> Register events.
// <Greek> Καταχώριση γεγονότων.
$events->register('login', 'validation.failed', fn($errors) => $events->logger->log("Validation failed: " . json_encode($errors)));
$events->register('login', 'auth.success', fn($user) => $events->logger->log("Authentication successful for: $user"));
$events->register('login', 'auth.failed', fn($user) => $events->logger->log("Authentication failed for: $user"));

// <English> Define credentials.
// <Greek> Ορισμός credentials.
$credentials = [
    'username' => 'admin',
    'password' => 'securePass123'
];

// <English> Define validation rules.
// <Greek> Ορισμός κανόνων επικύρωσης.
$rules = [
    'username' => 'required|string|min:3',
    'password' => 'required|string|min:8'
];

// <English> Validate credentials.
// <Greek> Επικύρωση credentials.
if (!$validator->validate($credentials, $rules)) {
    $validator->emit('validation.failed', $validator->getErrors());
    echo json_encode([
        'status' => 'validation_error',
        'errors' => $validator->getErrors()
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return;
}

// <English> Authenticate user.
// <Greek> Αυθεντικοποίηση χρήστη.
if ($auth->authenticate($credentials)) {
    $token = $auth->generateToken();
    $auth->emit('auth.success', $credentials['username']);
} else {
    $auth->emit('auth.failed', $credentials['username']);
    $token = null;
}

// <English> Output result.
// <Greek> Εμφάνιση αποτελέσματος.
echo json_encode([
    'user' => $credentials['username'],
    'authenticated' => $token !== null,
    'token' => $token
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
