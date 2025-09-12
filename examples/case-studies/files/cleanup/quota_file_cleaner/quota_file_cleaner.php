<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Cleans old files from a folder, checks quota, logs actions, and generates a report.
 * @desc <Greek> Καθαρίζει παλιά αρχεία από φάκελο, ελέγχει quota, καταγράφει ενέργειες και δημιουργεί αναφορά.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\{
    Kernel\Files\TFilesHandler,
    Kernel\Arrays\Events\TEventHandler,
    Extras\Arrays\Analysis\TArrayAnalysisHandler
};

global $AOS_TMP_DATA_PATH, $AOS_LOGS_PATH;

// <English> Define configuration for logging and file storage.
// <Greek> Ορισμός ρυθμίσεων για καταγραφή και αποθήκευση αρχείων.
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'file_cleaner.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/cleanup',
        'quotaSize' => 50000000 // 50MB quota
    ]
];

// <English> Initialize handlers.
// <Greek> Αρχικοποίηση χειριστών.
$files = new TFilesHandler([], $properties['file']);
$events = new TEventHandler([], $properties);
$analysis = new TArrayAnalysisHandler([], $properties);

// <English> Register events.
// <Greek> Καταχώριση γεγονότων.
$events->register('cleaner', 'file.deleted', fn($file) => $events->logger->log("Deleted file: $file"));
$events->register('cleaner', 'quota.exceeded', fn() => $events->logger->log("Quota exceeded before cleanup"));
$events->register('cleaner', 'report.generated', fn($path) => $events->logger->log("Report saved: $path"));

// <English> Create cleanup folder if needed.
// <Greek> Δημιουργία φακέλου καθαρισμού αν χρειάζεται.
$files->createFolder($properties['file']['baseDir']);

// <English> Check quota before cleanup.
// <Greek> Έλεγχος quota πριν τον καθαρισμό.
if ($files->isQuotaExceeded($properties['file']['baseDir'])) {
    $events->trigger('cleaner', 'quota.exceeded');
}

// <English> List files before deletion.
// <Greek> Λίστα αρχείων πριν τη διαγραφή.
$allFiles = $files->listFilesAndFolders($properties['file']['baseDir']);
$deletedFiles = [];
$deletedSizes = [];

// <English> Delete files older than 30 days.
// <Greek> Διαγραφή αρχείων παλαιότερων των 30 ημερών.
foreach ($allFiles as $file) {
    $fullPath = $properties['file']['baseDir'] . '/' . $file;
    $dates = $files->getFileDates($fullPath);
    if (isset($dates['modified']) && strtotime($dates['modified']) < strtotime('-30 days')) {
        $size = $files->getFileSize($fullPath);
        if (@unlink($fullPath)) {
            $deletedFiles[] = $file;
            $deletedSizes[] = $size;
            $events->trigger('cleaner', 'file.deleted', $file);
        }
    }
}

// <English> Analyze deleted file sizes.
// <Greek> Ανάλυση μεγεθών διαγραμμένων αρχείων.
$analysis->setArray($deletedSizes);
$stats = $analysis->generateStatisticsReport();

// <English> Save report.
// <Greek> Αποθήκευση αναφοράς.
$reportPath = $properties['file']['baseDir'] . '/cleanup_report.json';
$report = [
    'deleted_files' => $deletedFiles,
    'statistics' => $stats
];
$files->writeToFileWithCheck(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $reportPath);
$events->trigger('cleaner', 'report.generated', $reportPath);

// <English> Output result.
// <Greek> Εμφάνιση αποτελέσματος.
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
