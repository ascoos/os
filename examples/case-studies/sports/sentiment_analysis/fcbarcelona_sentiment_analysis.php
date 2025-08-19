<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Analyze sports statistics from social media and generate graphs.
 * @desc <Greek> Ανάλυση αθλητικών στατιστικών από social media και δημιουργία γραφημάτων.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    API\TTwitterAPIHandler,
    AI\TLinguisticAnalysisHandler,
    Files\TFilesHandler,
    Systems\TCoreSystemHandler
};
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;

global $conf, $AOS_TMP_DATA_PATH, $AOS_FONTS_PATH, $AOS_LOGS_PATH;

// Initialize configuration
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'sports_analysis.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/sports/',
        'quotaSize' => 1000000000 // 1GB quota
    ],
    'nlp' => [
        'host' => $conf['db']['mysqli']['host'] ?? 'localhost',
        'user' => $conf['db']['mysqli']['user'] ?? 'root',
        'password' => $conf['db']['mysqli']['pass'] ?? 'root',
        'dbname' => $conf['db']['mysqli']['dbname'] ?? 'nlp'
    ]
];

// Initialize ASCOOS classes
$system = new TCoreSystemHandler($properties);
$twitter = new TTwitterAPIHandler('https://api.x.com', 0, [], 'GET', $properties);
$nlp = new TLinguisticAnalysisHandler([], $properties['nlp']);
$files = new TFilesHandler([], $properties['file']);
$graph = new TArrayGraphHandler([], ['width' => 800, 'height' => 600, 'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf']);

// Fetch team-related tweets
$twitter->setOAuthToken('your_oauth_token_here');
$tweets = $twitter->getTweets(['query' => 'from:FCBarcelona', 'max_results' => 10]);
$texts = array_column($tweets['data'], 'text');

// Perform sentiment analysis
$sentiments = array_map(function ($text) use ($nlp) {
    return $nlp->analyzePhrase($text, 1)['sentiment'] ?? 'neutral';
}, $texts);

// Generate graph
$graph->merge(array_count_values($sentiments));
$graph->createBarChart($properties['file']['baseDir'] . 'sentiment_trend.png');

// Save report
$report = [
    'team' => 'FCBarcelona',
    'sentiments' => array_count_values($sentiments)
];
$files->createFolder($properties['file']['baseDir']);
$files->writeToFileWithCheck(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $properties['file']['baseDir'] . 'sports_report.json');

// Log high CPU load
if ($system->get_cpu_load(0) > 80) {
    $system->logger?->log("High CPU load during sports analysis: {$system->get_cpu_load(0)}%", $system::DEBUG_LEVEL_WARNING);
}

// Output report
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Free resources
$twitter->Free($twitter);
$nlp->closeConnection();
$files->Free($files);
$system->Free($system);

/* Expected Output:
{
    "team": "FCBarcelona",
    "sentiments": {
        "positive": 7,
        "neutral": 2,
        "negative": 1
    }
}
*/
