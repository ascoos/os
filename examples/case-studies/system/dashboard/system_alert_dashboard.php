<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Real-time dashboard for monitoring system and Apache resources, triggering alerts, logging events, and generating visual reports.
 * @desc <Greek> Πίνακας παρακολούθησης σε πραγματικό χρόνο για πόρους συστήματος και Apache, με ειδοποιήσεις, καταγραφή και οπτικές αναφορές.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Kernel\Apache\TApacheHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;
use ASCOOS\OS\Kernel\Dates\TDatesHandler;

global $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH, $AOS_FONTS_PATH;

// <English> Define configuration for logging, graphing, and thresholds
// <Greek> Ορισμός ρυθμίσεων για καταγραφή, γραφήματα και όρια συναγερμού
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'system_alerts.log'
    ],
    'graph' => [
        'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf',
        'width' => 800,
        'height' => 600
    ],
    'thresholds' => [
        'cpu' => 85,
        'memory' => 80
    ]
];

// <English> Initialize handlers
// <Greek> Αρχικοποίηση χειριστών
$system = new TCoreSystemHandler($properties);
$apache = TApacheHandler::getInstance([], $properties);
$eventHandler = new TEventHandler([], $properties);
$graphHandler = new TArrayGraphHandler([], $properties['graph']);
$datesHandler = new TDatesHandler('Europe/Athens', $properties);

// <English> Register alert events
// <Greek> Καταχώριση γεγονότων συναγερμού
$eventHandler->register('alerts', 'cpu.high', fn($data) => $eventHandler->logger->log("High CPU usage: {$data['cpu']}%", $eventHandler::DEBUG_LEVEL_WARNING));
$eventHandler->register('alerts', 'memory.high', fn($data) => $eventHandler->logger->log("High memory usage: {$data['memory']}%", $eventHandler::DEBUG_LEVEL_WARNING));
$eventHandler->register('alerts', 'apache.down', fn() => $eventHandler->logger->log("Apache server is not running", $eventHandler::DEBUG_LEVEL_CRITICAL));

// <English> Monitor system resources
// <Greek> Παρακολούθηση πόρων συστήματος
$cpu = $system->get_cpu_load();
$memoryStats = $system->get_memory_stats();
$memory = $memoryStats['percent'];
$apacheRunning = $apache->isServerRunning();

// <English> Trigger alerts based on thresholds
// <Greek> Ενεργοποίηση συναγερμών βάσει ορίων
if ($cpu > $properties['thresholds']['cpu']) {
    $eventHandler->trigger('alerts', 'cpu.high', ['cpu' => $cpu]);
}
if ($memory > $properties['thresholds']['memory']) {
    $eventHandler->trigger('alerts', 'memory.high', ['memory' => $memory]);
}
if (!$apacheRunning) {
    $eventHandler->trigger('alerts', 'apache.down');
}

// <English> Generate graph of current metrics
// <Greek> Δημιουργία γραφήματος με τις τρέχουσες μετρήσεις
$graphHandler->setArray([$cpu, $memory]);
$graphPath = $AOS_TMP_DATA_PATH . '/reports/system_metrics_' . $datesHandler->getCurrentDate('Ymd') . '.png';
$graphHandler->createGaugeChart($graphPath);

// <English> Output summary
// <Greek> Εμφάνιση σύνοψης
echo json_encode([
    'cpu' => $cpu,
    'memory' => $memory,
    'apache_running' => $apacheRunning,
    'graph' => $graphPath
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$system->Free($system);
$apache->Free($apache);
$eventHandler->Free($eventHandler);
$graphHandler->Free($graphHandler);
$datesHandler->Free($datesHandler);
