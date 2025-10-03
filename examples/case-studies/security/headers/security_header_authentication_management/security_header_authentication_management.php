<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 26.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 * 
 * @CASE-STUDY          : security_header_authentication_management.php
 * @fileNo              : ASCOOS-OS-CASESTUDY-SEC00102
 * 
 * @desc <English> Case Study: Advanced Security Header Management with CSP, CORS, SSL, and Authentication
 * @desc <Greek> Case Study: Προηγμένη Διαχείριση Headers Ασφαλείας με CSP, CORS, SSL και Αυθεντικοποίηση
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    HTTPHeaders\THTTPHeaderHandler,
    CSP\TCSPHandler,
    Headers\CORS\TCORSHeaderHandler,
    Headers\Security\TSecurityHeaderHandler,
    Headers\Custom\TCustomHeaderHandler,
    Apache\TApacheHandler,
    Apache\THTAccessHandler,
    Logger\TLoggerHandler,
    Files\TFilesHandler,
    Arrays\Events\TEventHandler,
    Auth\TAuthenticationHandler
};

global $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

// <English> Disable error display for production to ensure a secure environment
// <Greek> Απενεργοποίηση εμφάνισης σφαλμάτων για παραγωγή για τη διασφάλιση ασφαλούς περιβάλλοντος
if (RELEASE_MODE > RELEASE_MODE_DEBUG) {
    ini_set('display_errors', 'Off');
    error_reporting(0);
}

// <English> Configuration of settings for CSP, CORS, Security, and Custom Headers
// <Greek> Ορισμός ρυθμίσεων για CSP, CORS, Security και Custom Headers
$cspRules = [
    'base-uri' => "'self'",
    'default-src' => "'self'",
    'script-src' => "'self' 'unsafe-inline' https://test.loc",
    'style-src' => "'self' 'unsafe-inline' https://test.loc",
    'img-src' => "'self' data: https://test.loc",
    'connect-src' => "'self' https://api.test.loc",
    'font-src' => "'self' https://fonts.test.loc",
    'object-src' => "'none'",
    'frame-ancestors' => "'self'",
    'form-action' => "'self'",
    'report-uri' => 'https://report.test.loc/csp-report'
];

$corsRules = [
    'Access-Control-Allow-Origin' => 'https://trusted.domain.com',
    'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
    'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
];

$securityRules = [
    'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
    'X-Content-Type-Options' => 'nosniff',
    'X-Frame-Options' => 'DENY'
];

$customRules = [
    'X-Custom-Header' => 'AscoosOS-Web5'
];

// <English> Settings for logging, files, and events to manage logs, reports, and event triggers
// <Greek> Ρυθμίσεις για logging, αρχεία και γεγονότα για τη διαχείριση logs, αναφορών και εκπομπής γεγονότων
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'security_headers.log'
    ],
    'file' => [
        'dataDir' => $AOS_TMP_DATA_PATH . '/reports/',
        'quotaSize' => 2000000 // 2MB
    ],
    'events' => [
        'allowedTargets' => ['auth', 'security'],
        'allowedEventTypes' => ['auth.success', 'auth.failed', 'security.header_applied']
    ]
];

// <English> Creating handlers for CSP, CORS, Security, Custom Headers, Apache, logging, files, events, and authentication
// <Greek> Δημιουργία handlers για CSP, CORS, Security, Custom Headers, Apache, logging, αρχεία, γεγονότα και αυθεντικοποίηση
$cspHandler = new TCSPHandler($cspRules, ['sendMethod' => TCSPHandler::CSP_SEND_METHOD_HEADER]);
$corsHandler = new TCORSHeaderHandler($corsRules, ['sendMethod' => TCORSHeaderHandler::CORS_SEND_METHOD_HEADER]);
$securityHandler = new TSecurityHeaderHandler($securityRules, ['sendMethod' => TSecurityHeaderHandler::SECURITY_SEND_METHOD_HEADER]);
$customHandler = new TCustomHeaderHandler($customRules, ['sendMethod' => TCustomHeaderHandler::CUSTOM_SEND_METHOD_HEADER]);
$httpHeaderHandler = new THTTPHeaderHandler();
$apacheHandler = TApacheHandler::getInstance([], $properties);
$htaccessHandler = new THTAccessHandler(['filePath' => '.htaccess', 'mode' => 'a+']);
$logger = new TLoggerHandler($properties['logs']);
$filesHandler = new TFilesHandler([], $properties['file']);
$eventHandler = new TEventHandler([], $properties);
$authHandler = new TAuthenticationHandler();

// <English> Register authentication and security events to handle success, failure, and header application
// <Greek> Εγγραφή γεγονότων αυθεντικοποίησης και ασφαλείας για τη διαχείριση επιτυχίας, αποτυχίας και εφαρμογής headers
$eventHandler->register('auth', 'auth.success', function ($credentials) use ($logger) {
    // <English> Log successful authentication with user credentials
    // <Greek> Καταγραφή επιτυχημένης αυθεντικοποίησης με τα διαπιστευτήρια του χρήστη
    $logger->log("Authentication succeeded for user: " . json_encode($credentials), $logger::DEBUG_LEVEL_INFO);
});
$eventHandler->register('auth', 'auth.failed', function ($credentials, $errors) use ($logger) {
    // <English> Log failed authentication with error details
    // <Greek> Καταγραφή αποτυχημένης αυθεντικοποίησης με λεπτομέρειες σφαλμάτων
    $logger->log("Authentication failed: " . json_encode($errors), $logger::DEBUG_LEVEL_ERROR);
});
$eventHandler->register('security', 'security.header_applied', function ($headers) use ($logger) {
    // <English> Log applied security headers for monitoring
    // <Greek> Καταγραφή εφαρμοσμένων headers ασφαλείας για παρακολούθηση
    $logger->log("Security headers applied: " . json_encode($headers), $logger::DEBUG_LEVEL_INFO);
});
$authHandler->setEventHandler($eventHandler);

// <English> Adding handlers to THTTPHeaderHandler for centralized header management
// <Greek> Προσθήκη handlers στο THTTPHeaderHandler για κεντρική διαχείριση headers
$httpHeaderHandler->addHandler('CSP', $cspHandler);
$httpHeaderHandler->addHandler('CORS', $corsHandler);
$httpHeaderHandler->addHandler('Security', $securityHandler);
$httpHeaderHandler->addHandler('Custom', $customHandler);

// <English> Authenticate user before applying headers to ensure secure access
// <Greek> Αυθεντικοποίηση χρήστη πριν την εφαρμογή headers για τη διασφάλιση ασφαλούς πρόσβασης
$credentials = ['username' => 'admin', 'password' => 'pass'];
if (!$authHandler->authenticate($credentials)) {
    // <English> Log authentication failure and trigger event for failure
    // <Greek> Καταγραφή αποτυχίας αυθεντικοποίησης και εκπομπή γεγονότος για αποτυχία
    $logger->log("Authentication failed for user: " . $credentials['username'], $logger::DEBUG_LEVEL_ERROR);
    $errors = $authHandler->getErrors();
    $eventHandler->trigger('auth', 'auth.failed', $credentials, $errors);
    exit; // <English> Stop execution if authentication fails
          // <Greek> Διακοπή εκτέλεσης αν η αυθεντικοποίηση αποτύχει
}
$eventHandler->trigger('auth', 'auth.success', $credentials);

// <English> SSL/TLS certificate check to ensure secure connections
// <Greek> Έλεγχος SSL/TLS πιστοποιητικού για τη διασφάλιση ασφαλών συνδέσεων
$sslStatus = $apacheHandler->checkSSLCertificate('test.loc');
if ($sslStatus['is_expired']) {
    // <English> Log SSL certificate expiration and update CSP to enforce secure requests
    // <Greek> Καταγραφή λήξης πιστοποιητικού SSL και ενημέρωση CSP για επιβολή ασφαλών αιτημάτων
    $logger->log("SSL certificate expired for test.loc", $logger::DEBUG_LEVEL_ERROR);
    $cspRules['upgrade-insecure-requests'] = '';
    $cspHandler->setRules($cspRules);
}

// <English> CSP configuration in .htaccess for server-level security
// <Greek> Ρύθμιση CSP στο .htaccess για ασφάλεια σε επίπεδο server
$htaccessHandler->setCSPRules($cspRules);
$htaccessHandler->addCSP();

// <English> CORS configuration in .htaccess for cross-origin resource sharing
// <Greek> Ρύθμιση CORS στο .htaccess για κοινή χρήση πόρων cross-origin
$htaccessHandler->configureCORS('https://trusted.domain.com');

// <English> Sending headers via HTTP and triggering event for header application
// <Greek> Αποστολή headers μέσω HTTP και εκπομπή γεγονότος για την εφαρμογή headers
$httpHeaderHandler->sendHeaders();
$eventHandler->trigger('security', 'security.header_applied', $httpHeaderHandler->getAllHeaders());

// <English> Logging headers to a log file for monitoring and debugging
// <Greek> Καταγραφή headers σε αρχείο log για παρακολούθηση και αποσφαλμάτωση
$logger->log("Headers sent: " . json_encode($httpHeaderHandler->getAllHeaders(), JSON_PRETTY_PRINT), $logger::DEBUG_LEVEL_INFO);

// <English> Create report with SSL status, header rules, and authentication details
// <Greek> Δημιουργία αναφοράς με κατάσταση SSL, κανόνες headers και λεπτομέρειες αυθεντικοποίησης
$report = [
    'ssl_status' => $sslStatus,
    'csp_rules' => $cspRules,
    'cors_rules' => $corsRules,
    'security_rules' => $securityRules,
    'custom_rules' => $customRules,
    'auth_status' => [
        'user' => $credentials['username'],
        'success' => true,
        'errors' => []
    ]
];
$reportFolder = $properties['file']['dataDir'];
$filesHandler->createFolder($reportFolder);
$reportFile = $reportFolder . '/security_report_' . date('Ymd_His') . '.json';
$filesHandler->writeToFileWithCheck(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $reportFile);
$logger->log("Security report saved to $reportFile", $logger::DEBUG_LEVEL_INFO);

// <English> Closing files and releasing resources to optimize memory usage
// <Greek> Κλείσιμο αρχείων και απελευθέρωση πόρων για βελτιστοποίηση χρήσης μνήμης
$htaccessHandler->close();
$cspHandler->Free($cspHandler);
$corsHandler->Free($corsHandler);
$securityHandler->Free($securityHandler);
$customHandler->Free($customHandler);
$httpHeaderHandler->Free($httpHeaderHandler);
$apacheHandler->Free($apacheHandler);
$logger->Free($logger);
$filesHandler->Free($filesHandler);
$eventHandler->Free($eventHandler);
$authHandler->Free($authHandler);
?>