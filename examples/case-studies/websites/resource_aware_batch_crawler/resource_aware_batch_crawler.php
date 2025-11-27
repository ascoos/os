<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @CASE-STUDY          : resource_aware_batch_crawler.php
 * @fileNo              : ASCOOS-OS-CASESTUDY-SEC00253
 * 
 * @desc <English> Crawls multiple URLs in batch, adapts depth based on system resources (CPU/memory), extracts content, and reports – integrating TCoreSystemHandler, TWebsiteHandler, and TFilesHandler for Web5 scalable scraping.
 * @desc <Greek> Σαρώνει πολλαπλές URLs σε batch, προσαρμόζει βάθος βάσει πόρων συστήματος (CPU/μνήμη), εξάγει περιεχόμενο, και αναφέρει – ενσωματώνοντας TCoreSystemHandler, TWebsiteHandler, και TFilesHandler για scalable scraping Web5.
 * 
 * @since PHP 8.2.0+
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Kernel\Websites\TWebsiteHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;

global $AOS_TMP_DATA_PATH, $utf8;

$properties = [
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/crawl_reports/',
        'quotaSize' => 100000000 // 100MB quota
    ],
    'system' => [
        'cpu_percent_warn' => 70,  // Threshold για light crawl
        'memory_percent_warn' => 80  // Memory limit
    ]
];

try {
    $system = new TCoreSystemHandler($properties['system']);
    $files = new TFilesHandler([], $properties['file']);
    $batch = ['https://ascoos.com', 'https://awes.ascoos.com', 'https://example.com'];

    $reports = [];
    foreach ($batch as $url) {
        $cpuLoad = $system->get_cpu_load(0);
        $memLoad = $system->get_memory_stats()['percent'];
        $lightMode = $cpuLoad > $properties['system']['cpu_percent_warn'] || $memLoad > $properties['system']['memory_percent_warn'];

        $website = new TWebsiteHandler();
        $website->setUrl($url);

        // Basic crawl always.
        $availability = $website->checkAvailability($url);
        $loadTime = $website->analyzeLoadTime($url);

        // Full crawl if resources allow.
        $content = [];
        if (!$lightMode) {
            $content = $website->getHTMLContent($url);
            $keywords = $website->extractKeywords($url);
        } else {
            $content = ['light_mode' => true, 'basic' => $loadTime];
        }

        $reports[] = [
            'url' => $url,
            'cpu_load' => $cpuLoad,
            'mem_load' => $memLoad,
            'light_mode' => $lightMode,
            'availability' => $availability,
            'load_time' => $loadTime,
            'content_excerpt' => $utf8->substr($content, 0, 200)  // Full extract if not light
        ];

        $website->Free();
    }

    // Save batch report.
    $files->createFolder($properties['file']['baseDir']);
    $reportFile = $properties['file']['baseDir'] . 'batch_crawl_' . date('Ymd_His') . '.json';
    $files->writeToFileWithCheck(json_encode($reports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $reportFile);

    echo "Batch Crawl Complete. Reports: " . json_encode($reports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$system->Free();
$files->Free();
?>