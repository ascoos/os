<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Analyze the content of a website linguistically, detect its language, and monitor system load during processing.
 * @desc <Greek> Ανάλυση περιεχομένου ιστοσελίδας με γλωσσική επεξεργασία, εντοπισμό γλώσσας και παρακολούθηση φόρτου συστήματος.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Websites\TWebsiteHandler,
    Languages\TLanguageHandler,
    AI\TLinguisticAnalysisHandler,
    Files\TFilesHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH, $AOS_CONFIG_PATH;

// Initialize configuration
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'sports_analysis.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/reports/nlp/',
        'quotaSize' => 1000000000 // 1GB quota
    ],
    'nlp' => [
        'host' => $conf['db']['mysqli']['host'] ?? 'localhost',
        'user' => $conf['db']['mysqli']['user'] ?? 'root',
        'password' => $conf['db']['mysqli']['pass'] ?? 'root',
        'dbname' => $conf['db']['mysqli']['dbname'] ?? 'linguistics'
    ]
];

// <English> Initialize system, website, language, NLP, and file handlers.
// <Greek> Αρχικοποίηση χειριστών συστήματος, ιστοσελίδας, γλώσσας, NLP και αρχείων.
$system = new TCoreSystemHandler(['cpu_percent_warn' => 80]);
$website = new TWebsiteHandler();
$language = new TLanguageHandler([], [
    'alphabetsPath' => $AOS_CONFIG_PATH . '/alphabets.json',
    'wordListPath' => $AOS_CONFIG_PATH . '/wordlist.json'
]);
$nlp = new TLinguisticAnalysisHandler([], $properties['nlp']);
$files = new TFilesHandler([], $properties['file']);

// <English> Fetch and clean website content.
// <Greek> Ανάκτηση και καθαρισμός περιεχομένου ιστοσελίδας.
$url = 'https://example.com';
$website->setUrl($url);
$html = $website->getHTMLContent($url);
$text = strip_tags($html);

// <English> Detect language.
// <Greek> Εντοπισμός γλώσσας.
$detectedLang = $language->getTextLanguage($text);

// <English> Perform linguistic analysis.
// <Greek> Εκτέλεση γλωσσικής ανάλυσης.
$analysis = $nlp->analyzePhrase($text, $detectedLang === 'el' ? 2 : 1);

// <English> Monitor system load.
// <Greek> Παρακολούθηση φόρτου συστήματος.
$cpuLoad = $system->get_cpu_load(0);
if ($cpuLoad > 80) {
    $system->logger?->log("High CPU load during NLP: $cpuLoad%", $system::DEBUG_LEVEL_WARNING);
}

// <English> Save analysis report.
// <Greek> Αποθήκευση αναφοράς ανάλυσης.
$folder = $properties['file']['baseDir'];
$files->createFolder($folder);
$files->writeToFileWithCheck(json_encode([
    'url' => $url,
    'language' => $detectedLang,
    'cpu_load' => $cpuLoad,
    'analysis' => $analysis
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $folder . "report.json");

// <English> Free resources.
// <Greek> Απελευθέρωση πόρων.
$nlp->closeConnection();
$system->Free($system);
$files->Free($files);
$website->Free($website);
$language->Free($language);
?>
