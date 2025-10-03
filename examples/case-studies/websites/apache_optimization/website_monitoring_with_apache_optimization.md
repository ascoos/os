# Website Monitoring with Linguistic Analysis and Apache Optimization

This case study demonstrates how **Ascoos OS** monitors websites, performs linguistic analysis, manages network connectivity, and optimizes Apache server performance based on analysis results.

## Purpose
- Monitor website availability, SEO performance, and broken links.
- Perform linguistic analysis (language detection and sentiment analysis) on website content.
- Monitor system resources and network latency.
- Optimize Apache server configuration dynamically based on analysis results.

## Core Ascoos OS Classes
- **TApacheHandler**  
  Manages Apache server configurations, logging, and optimization (e.g., enabling mod_rewrite, setting QoS rules).  
- **TNetwork**  
  Handles network connectivity checks and latency measurements.  
- **TWebsiteHandler**  
  Performs website availability checks, SEO analysis, and content retrieval.  
- **TLanguageHandler**  
  Detects text language and performs sentiment analysis.  
- **TFilesHandler**  
  Manages file operations, including backups and report generation.  
- **TCoreSystemHandler**  
  Monitors system resources like CPU load.  
- **TQueueHandler**, **TStackHandler**, **TTaskHandler**, **TThreadHandler**  
  Manage task queuing, execution, and parallel processing with threads.

## File Structure
The implementation is contained in a single PHP file:
- [`website_monitoring_with_apache_optimization.php`](website_monitoring_with_apache_optimization.php)

This file includes the full logic for website monitoring, linguistic analysis, network checks, and Apache optimization.

## Prerequisites
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Initialize global variables and properties for logging, file handling, and linguistic analysis.
2. Define a list of websites to monitor (`https://example.com`, `https://test.com`, `https://demo.org`).
3. Create tasks for each website to:
   - Check network connectivity and latency.
   - Verify website availability, SEO score, and broken links.
   - Validate SSL certificates.
   - Fetch and clean website content for linguistic analysis (language detection and sentiment analysis).
   - Monitor system CPU load.
4. Add tasks to a queue and process them in parallel using up to 3 threads.
5. Cache task results to avoid redundant processing.
6. Analyze results to determine if Apache optimization is needed (e.g., enabling mod_rewrite, setting QoS rules).
7. Back up Apache configuration if SSL certificates are expired.
8. Generate and save a JSON report of the analysis results.
9. Send the report via email to the admin.
10. Free allocated resources.

## Example Code
```php
$websites = ['https://example.com', 'https://test.com', 'https://demo.org'];
$tasks = [];
foreach ($websites as $url) {
    $tasks[] = [
        'id' => md5($url),
        'callback' => function () use ($url, $website, $language, $system, $network, $apache) {
            $result = [
                'url' => $url,
                'availability' => $website->checkAvailability($url),
                'seo_score' => $website->analyzeSEO($url)['score'] ?? 0.0,
                'broken_links' => $website->checkBrokenLinks($url),
                'ssl_status' => $apache->checkSSLCertificate(parse_url($url, PHP_URL_HOST)),
                'language' => $language->getTextLanguage(strip_tags($website->getHTMLContent($url))),
                'sentiment' => $website->analyzeSentiment(strip_tags($website->getHTMLContent($url)), $language->getTextLanguage(strip_tags($website->getHTMLContent($url)))),
                'cpu_load' => $system->get_cpu_load(0),
                'latency' => $network->checkLatency(parse_url($url, PHP_URL_HOST))
            ];
            $apache->logger?->log("Analysis for $url: " . json_encode($result, JSON_PRETTY_PRINT), $apache->logger::DEBUG_LEVEL_INFO);
            return $result;
        }
    ];
}

$thread->setMaxThreads(3);
while (!$queue->isEmpty()) {
    $taskId = $queue->extract();
    if ($cached = $task->checkCache($taskId)) {
        $results[$taskId] = $cached;
        continue;
    }
    $thread->startThread($taskId, function () use ($task, $taskId, &$results) {
        $result = $task->executeNextQueueTask();
        $task->saveCache($taskId, $result);
        $results[$taskId] = $result;
    });
}
$thread->monitorThreads();

if ($needsOptimization && !$apache->exists_module('rewrite')) {
    $apache->enableModule('rewrite');
}
if ($needsBackup) {
    $apache->backupConfig(PHP_OS_FAMILY === 'Windows' ? 'C:/Apache24/conf/httpd.conf' : '/etc/apache2/apache2.conf', $properties['file']['dataDir']);
}
```

## Expected Output
A JSON report is generated and saved to the reports folder (e.g., `website_analysis_20251003_1159.json`):
```json
{
    "d8e8fca2dc0f896fd7cb4cb0031ba249": {
        "url": "https://example.com",
        "availability": true,
        "seo_score": 85.5,
        "broken_links": [],
        "ssl_status": { "is_expired": false },
        "language": "en",
        "sentiment": "positive",
        "cpu_load": 45.2,
        "latency": 120.5
    },
    ...
}
```
The report is also emailed to `admin@example.com`. Apache configurations are updated if needed (e.g., mod_rewrite enabled, QoS rules set).

## Resources
- [Ascoos OS Documentation](/docs/)  
- [ASCOOS](https://www.ascoos.com)  
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can enhance the system by adding more website metrics, improving linguistic analysis, or optimizing thread management. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered by the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md).
