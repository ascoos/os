<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 26.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 * 
 * @CASE-STUDY          : website_monitoring_with_apache_optimization.php
 * 
 * @desc <English> Case Study: Website Monitoring with Linguistic Analysis, Network Management, and Apache Optimization
 * @desc <Greek> Case Study: Παρακολούθηση Ιστοσελίδων με Γλωσσική Ανάλυση, Διαχείριση Δικτύου και Βελτιστοποίηση Apache
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Apache\TApacheHandler;
use ASCOOS\OS\Kernel\Net\TNetwork;
use ASCOOS\OS\Kernel\Websites\TWebsiteHandler;
use ASCOOS\OS\Kernel\Languages\TLanguageHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;
use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Kernel\Arrays\Queues\TQueueHandler;
use ASCOOS\OS\Kernel\Arrays\Stacks\TStackHandler;
use ASCOOS\OS\Kernel\Tasks\TTaskHandler;
use ASCOOS\OS\Kernel\Threads\TThreadHandler;

// <English> Declare global variables
// <Greek> Δηλώνει τις δημόσιες μεταβλητές
global $AOS_CONFIG_PATH, $AOS_LOGS_PATH;

// <English> Initialize properties for logging, file handling, and linguistic analysis
// <Greek> Αρχικοποίηση ιδιοτήτων για καταγραφή, διαχείριση αρχείων και γλωσσική ανάλυση
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'website_linguistic_monitoring.log'
    ],
    'file' => [
        'dataDir' => PHP_OS_FAMILY === 'Windows' ? 'C:/Apache24/backup' : '/var/backups/apache',
        'quotaSize' => 2000000 // 2MB quota
    ],
    'language' => [
        'alphabetsPath' => $AOS_CONFIG_PATH . '/alphabets.json',
        'wordListPath' => $AOS_CONFIG_PATH . '/wordlist.json'
    ],
    'system' => [
        'cpu_percent_warn' => 80
    ],
    'maxThreads' => 5
];

// <English> Initialize handlers
// <Greek> Αρχικοποίηση διαχειριστών
$apache = TApacheHandler::getInstance([], $properties);
$network = new TNetwork(null, $properties);
$website = new TWebsiteHandler([], $properties);
$language = new TLanguageHandler([], $properties['language']);
$files = new TFilesHandler([], $properties);
$system = new TCoreSystemHandler($properties['system']);
$queue = new TQueueHandler();
$stack = new TStackHandler();
$task = new TTaskHandler($properties);
$thread = new TThreadHandler($properties);

// <English> List of websites to analyze
// <Greek> Λίστα ιστοσελίδων για ανάλυση
$websites = [
    'https://example.com',
    'https://test.com',
    'https://demo.org'
];

// <English> Define tasks for website analysis
// <Greek> Ορισμός εργασιών για την ανάλυση ιστοσελίδων
$tasks = [];
foreach ($websites as $url) {
    $tasks[] = [
        'id' => md5($url),
        'callback' => function () use ($url, $website, $language, $system, $network, $apache): array {
            $result = [
                'url' => $url,
                'availability' => false,
                'language' => 'en',
                'sentiment' => 'neutral',
                'seo_score' => 0.0,
                'broken_links' => [],
                'cpu_load' => 0.0,
                'latency' => 0.0,
                'ssl_status' => []
            ];

            // <English> Check network connectivity and latency
            // <Greek> Έλεγχος συνδεσιμότητας δικτύου και καθυστέρησης
            if (!$network->checkInternetConnection()) {
                $apache->logger?->log("No internet connection for $url", $apache->logger::DEBUG_LEVEL_ERROR);
                return $result;
            }
            $result['latency'] = $network->checkLatency(parse_url($url, PHP_URL_HOST));

            // <English> Check website availability and SEO
            // <Greek> Έλεγχος διαθεσιμότητας και SEO ιστοσελίδας
            $result['availability'] = $website->checkAvailability($url);
            $result['seo_score'] = $website->analyzeSEO($url)['score'] ?? 0.0;
            $result['broken_links'] = $website->checkBrokenLinks($url);

            // <English> Check SSL certificate
            // <Greek> Έλεγχος πιστοποιητικού SSL
            $result['ssl_status'] = $apache->checkSSLCertificate(parse_url($url, PHP_URL_HOST));

            // <English> Fetch and clean website content
            // <Greek> Ανάκτηση και καθαρισμός περιεχομένου ιστοσελίδας
            $html = $website->getHTMLContent($url);
            if ($html === false) {
                $apache->logger?->log("Failed to fetch HTML for $url", $apache->logger::DEBUG_LEVEL_ERROR);
                return $result;
            }
            $text = strip_tags($html);

            // <English> Detect language
            // <Greek> Εντοπισμός γλώσσας
            $result['language'] = $language->getTextLanguage($text);

            // <English> Perform linguistic analysis (sentiment)
            // <Greek> Εκτέλεση γλωσσικής ανάλυσης (συναίσθημα)
            $result['sentiment'] = $website->analyzeSentiment($text, $result['language']);

            // <English> Monitor system load
            // <Greek> Παρακολούθηση φόρτου συστήματος
            $result['cpu_load'] = $system->get_cpu_load(0);
            if ($result['cpu_load'] > $system->getDeepProperty(['system','cpu_percent_warn'])) {
                $apache->logger?->log("High CPU load during analysis of $url: {$result['cpu_load']}%", $apache->logger::DEBUG_LEVEL_WARNING);
            }

            // <English> Log results
            // <Greek> Καταγραφή αποτελεσμάτων
            $apache->logger?->log("Analysis for $url: " . json_encode($result, JSON_PRETTY_PRINT), $apache->logger::DEBUG_LEVEL_INFO);

            return $result;
        }
    ];
}

// <English> Add tasks to queue and cache results
// <Greek> Προσθήκη εργασιών στην ουρά και αποθήκευση αποτελεσμάτων σε cache
foreach ($tasks as $taskData) {
    $task->addTaskToQueue($taskData['id'], $taskData['callback']);
    $queue->insert($taskData['id']);
}

// <English> Process tasks in parallel using threads
// <Greek> Επεξεργασία εργασιών παράλληλα με νήματα
$thread->setMaxThreads(3); // Limit to 3 concurrent threads
$results = [];
while (!$queue->isEmpty()) {
    $taskId = $queue->extract();
    if ($cached = $task->checkCache($taskId)) {
        $results[$taskId] = $cached; // Use cached result if available
        $apache->logger?->log("Using cached result for task $taskId", $apache->logger::DEBUG_LEVEL_INFO);
        continue;
    }
    $thread->startThread($taskId, function () use ($task, $taskId, &$results) {
        $result = $task->executeNextQueueTask();
        $task->saveCache($taskId, $result); // Cache the result
        $results[$taskId] = $result;
    });
}
$thread->monitorThreads(); // Monitor and wait for threads to complete

// <English> Optimize Apache based on results
// <Greek> Βελτιστοποίηση Apache βάσει αποτελεσμάτων
$needsOptimization = false;
$needsBackup = false;
foreach ($results as $result) {
    if ($result['seo_score'] < 70 || count($result['broken_links']) > 0) {
        $needsOptimization = true; // Enable mod_rewrite for better routing
    }
    if ($result['ssl_status']['is_expired'] ?? false) {
        $needsBackup = true; // Backup config before making changes
        $apache->logger?->log("SSL certificate expired for {$result['url']}", $apache->logger::DEBUG_LEVEL_ERROR);
    }
    if ($result['cpu_load'] > $properties['system']['cpu_percent_warn']) {
        $needsOptimization = true; // Set QoS to manage server load
    }
}

// <English> Enable mod_rewrite if needed
// <Greek> Ενεργοποίηση mod_rewrite αν απαιτείται
if ($needsOptimization && !$apache->exists_module('rewrite')) {
    try {
        $apache->enableModule('rewrite');
        $apache->logger?->log("Enabled mod_rewrite for performance optimization", $apache->logger::DEBUG_LEVEL_INFO);
    } catch (Exception $e) {
        $apache->logger?->log("Failed to enable mod_rewrite: " . $e->getMessage(), $apache->logger::DEBUG_LEVEL_ERROR);
    }
}

// <English> Set QoS rule if needed
// <Greek> Ορισμός κανόνα QoS αν απαιτείται
if ($needsOptimization) {
    try {
        $apache->setQoSRule("QS_SrvMaxConnPerIP", "100");
        $apache->logger?->log("Set QoS rule for traffic prioritization", $apache->logger::DEBUG_LEVEL_INFO);
    } catch (Exception $e) {
        $apache->logger?->log("Failed to set QoS rule: " . $e->getMessage(), $apache->logger::DEBUG_LEVEL_ERROR);
    }
}

// <English> Backup Apache configuration if needed
// <Greek> Δημιουργία backup διαμόρφωσης Apache αν απαιτείται
if ($needsBackup) {
    try {
        $configFile = PHP_OS_FAMILY === 'Windows' ? 'C:/Apache24/conf/httpd.conf' : '/etc/apache2/apache2.conf';
        $backupFolder = $properties['file']['dataDir'];
        $apache->backupConfig($configFile, $backupFolder);
        $apache->logger?->log("Apache config backed up to $backupFolder", $apache->logger::DEBUG_LEVEL_INFO);
    } catch (Exception $e) {
        $apache->logger?->log("Backup failed: " . $e->getMessage(), $apache->logger::DEBUG_LEVEL_ERROR);
    }
}

// <English> Generate and save report
// <Greek> Δημιουργία και αποθήκευση αναφοράς
$reportFolder = $properties['file']['dataDir'] . '/reports';
$files->createFolder($reportFolder);
$reportFile = $reportFolder . '/website_analysis_' . date('Ymd_His') . '.json';
$files->writeToFileWithCheck(json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $reportFile);
$apache->logger?->log("Analysis report saved to $reportFile", $apache->logger::DEBUG_LEVEL_INFO);

// <English> Send report via email
// <Greek> Αποστολή αναφοράς μέσω email
try {
    $network->sendReport('admin@example.com');
    $apache->logger?->log("Report sent to admin@example.com", $apache->logger::DEBUG_LEVEL_INFO);
} catch (Exception $e) {
    $apache->logger?->log("Failed to send report: " . $e->getMessage(), $apache->logger::DEBUG_LEVEL_ERROR);
}

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$apache->Free($apache);
$network->Free($network);
$website->Free($website);
$language->Free($language);
$files->Free($files);
$system->Free($system);
$queue->Free($queue);
$stack->Free($stack);
$task->Free($task);
$thread->Free($thread);
?>