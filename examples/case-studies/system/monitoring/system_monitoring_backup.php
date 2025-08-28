<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc  <English> System Monitoring and Backup
 * @desc  <Greek> Παρακολούθηση Συστήματος και Backup
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Files\TFilesHandler,
    API\TTelegramAPIHandler,
    Arrays\Events\TEventHandler
};

global $AOS_LOGS_PATH, $AOS_BACKUP_PATH;
/**
 * <English> Initialize ASCOOS classes for system monitoring and backup.
 * <Greek> Αρχικοποίηση κλάσεων ASCOOS για παρακολούθηση συστήματος και backup.
 */
$properties = [
    'file' => [
        'dataDir' => $AOS_BACKUP_PATH . '/system_backups',
        'quotaSize' => 1000000 // 1MB quota
    ],
    'telegram' => [
        'url' => 'https://api.telegram.org',
        'bot_token' => 'your_bot_token_here'
    ],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/ascoos',
        'file' => 'system_monitor.log'
    ]
];

$systemHandler = new TCoreSystemHandler($properties);
$filesHandler = new TFilesHandler([], $properties['file']);
$telegramApi = new TTelegramAPIHandler($properties['telegram']['url'], 0, ['bot_token' => $properties['telegram']['bot_token']]);
$eventHandler = new TEventHandler();

// <English> Register events for high CPU load and backup completion.
// <Greek> Καταχώριση γεγονότων για υψηλό φόρτο CPU και ολοκλήρωση backup.
$eventHandler->register('system', 'high_cpu_load', fn($load) => error_log("High CPU load detected: $load%"));
$eventHandler->register('system', 'backup.complete', fn($path) => error_log("Backup completed: $path"));
$telegramApi->setEventHandler($eventHandler);

// <English> Monitor CPU load and system stats.
// <Greek> Παρακολούθηση φόρτου CPU και στατιστικών συστήματος.
$cpuLoad = $systemHandler->get_cpu_load_percent();
$memoryStats = $systemHandler->get_memory_stats();
$uptime = $systemHandler->get_uptime_seconds();

if ($cpuLoad > 80) {
    // <English> Send Telegram alert for high CPU load.
    // <Greek> Αποστολή ειδοποίησης Telegram για υψηλό φόρτο CPU.
    $chatId = 'your_chat_id_here';
    $message = "⚠️ High CPU load detected: $cpuLoad% on " . date('Y-m-d H:i:s');
    $telegramApi->sendMessage(['chat_id' => $chatId, 'text' => $message]);
    $eventHandler->trigger('system', 'high_cpu_load', $cpuLoad);
}

// <English> Create system snapshot (CPU, memory, uptime) and encrypt it.
// <Greek> Δημιουργία στιγμιότυπου συστήματος (CPU, μνήμη, χρόνος λειτουργίας) και κρυπτογράφησή του.
$snapshot = [
    'cpu_load_percent' => $cpuLoad,
    'memory_stats' => $memoryStats,
    'uptime_seconds' => $uptime,
    'timestamp' => date('Y-m-d H:i:s')
];

$backupFolder = $properties['file']['dataDir'];
$rawFile = "$backupFolder/snapshot_" . date('Ymd_His') . ".txt";
$encryptedFile = "$backupFolder/snapshot_" . date('Ymd_His') . ".enc";

$filesHandler->createFolder($backupFolder);
if (!$filesHandler->isQuotaExceeded($backupFolder)) {
    $filesHandler->writeToFileWithCheck(json_encode($snapshot, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $rawFile);
    $filesHandler->encryptFile($rawFile, $encryptedFile, 'supersecretkey123');
    $eventHandler->trigger('system', 'backup.complete', $encryptedFile);
}

// <English> Log system status.
// <Greek> Καταγραφή κατάστασης συστήματος.
$systemHandler->logger?->log("System snapshot created and encrypted: $encryptedFile", $systemHandler::DEBUG_LEVEL_INFO);

// <English> Free resources.
// <Greek> Απελευθέρωση πόρων.
$systemHandler->Free($systemHandler);
$filesHandler->Free($filesHandler);
$telegramApi->Free($telegramApi);
$eventHandler->Free($eventHandler);
?>