# Quota-Aware File Cleaning with Activity Logging & Reporting

This case study demonstrates how **Ascoos OS** can implement a file cleaning process that monitors its quota, logs activities, and generates a report with statistics on deleted files.

## Purpose
- Clean files older than 30 days
- Check quota before cleanup
- Log events (e.g., file deletions, quota exceeded, report generation)
- Analyze sizes of deleted files and create a report

## Main Classes from Ascoos OS
- **TFilesHandler**  
  File management, quota check, folder creation, file size/date retrieval  
- **TEventHandler**  
  Event registration and logging  
- **TArrayAnalysisHandler**  
  Analyze numerical data and generate statistical reports  

## File Structure
The logic is implemented in a single PHP file:
- [`quota_file_cleaner.php`](quota_file_cleaner.php)

It includes all steps: cleanup, quota check, logging, and report generation.

## Requirements
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Set properties for logging and cleanup folder.
2. Initialize `TFilesHandler`, `TEventHandler`, and `TArrayAnalysisHandler`.
3. Register events for the logger.
4. Create cleanup folder if needed.
5. Check if quota was exceeded.
6. List → delete files older than 30 days.
7. Log deleted files and their sizes.
8. Create a statistical report.
9. Save and output the report.

## Example Code
```php
$files = new TFilesHandler([], $properties['file']);
$events = new TEventHandler([], $properties);
$analysis = new TArrayAnalysisHandler([], $properties);

$events->register('cleaner', 'file.deleted', fn($file) => $events->logger->log("Deleted file: $file"));
$events->register('cleaner', 'quota.exceeded', fn() => $events->logger->log("Quota exceeded before cleanup"));
$events->register('cleaner', 'report.generated', fn($path) => $events->logger->log("Report saved: $path"));

if ($files->isQuotaExceeded($properties['file']['baseDir'])) {
    $events->trigger('cleaner', 'quota.exceeded');
}

foreach ($files->listFilesAndFolders($properties['file']['baseDir']) as $file) {
    // ... file deletion and logging
}

$analysis->setArray($deletedSizes);
$stats = $analysis->generateStatisticsReport();

$report = [
    'deleted_files' => $deletedFiles,
    'statistics' => $stats
];
$files->writeToFileWithCheck(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $reportPath);
```

## Expected Output
```json
{
  "deleted_files": ["temp1.log", "old_cache.tmp", "debug_2023.txt"],
  "statistics": {
    "count": 3,
    "total_size": 124830,
    "average_size": 41610,
    "min_size": 10240,
    "max_size": 92150
  }
}
```

## Resources
- [Ascoos OS Documentation](/docs/)  
- [AWES Platform](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can extend the logic to clean files based on type, creation date, or custom rules. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md).
