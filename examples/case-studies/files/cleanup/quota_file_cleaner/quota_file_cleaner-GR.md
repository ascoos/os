# Καθαρισμός Αρχείων με Έλεγχο Quota και Αναφορά Δραστηριότητας

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να καθαρίσει παλιά αρχεία από έναν φάκελο, να ελέγξει το μέγεθος quota, να καταγράψει γεγονότα και να δημιουργήσει αναφορά με στατιστικά.

## Σκοπός
- Καθαρισμός αρχείων παλαιότερων των 30 ημερών
- Έλεγχος quota πριν την εκκαθάριση
- Καταγραφή γεγονότων (π.χ. διαγραφή αρχείων, υπέρβαση quota, δημιουργία αναφοράς)
- Ανάλυση μεγεθών διαγραμμένων αρχείων
- Δημιουργία αναφοράς σε JSON

## Κύριες Κλάσεις του Ascoos OS
- **TFilesHandler**  
  Διαχείριση αρχείων και φακέλων, μέγεθος, ημερομηνίες, εγγραφή σε αρχεία  
- **TEventHandler**  
  Καταγραφή και ενεργοποίηση γεγονότων με δυνατότητα logging  
- **TArrayAnalysisHandler**  
  Ανάλυση αριθμητικών δεδομένων και δημιουργία στατιστικών αναφορών  

## Δομή Αρχείων
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`quota_file_cleaner.php`](quota_file_cleaner.php)

Περιλαμβάνει όλη τη λογική: καθαρισμό αρχείων, logging, quota check και δημιουργία αναφοράς.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Ορίζονται οι ρυθμίσεις για logging και φάκελο καθαρισμού.
2. Αρχικοποιούνται οι handlers: `TFilesHandler`, `TEventHandler`, `TArrayAnalysisHandler`.
3. Καταχωρούνται γεγονότα για logging.
4. Δημιουργείται ο φάκελος καθαρισμού (αν δεν υπάρχει).
5. Ελέγχεται αν έχει ξεπεραστεί το quota.
6. Λίστα αρχείων → διαγραφή αρχείων παλαιότερων των 30 ημερών.
7. Καταγράφονται τα διαγραμμένα αρχεία και τα μεγέθη τους.
8. Δημιουργείται στατιστική αναφορά.
9. Αποθηκεύεται η αναφορά σε JSON.
10. Εμφανίζεται το αποτέλεσμα.

## Παράδειγμα Κώδικα
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
    // ... διαγραφή αρχείων και logging
}

$analysis->setArray($deletedSizes);
$stats = $analysis->generateStatisticsReport();

$report = [
    'deleted_files' => $deletedFiles,
    'statistics' => $stats
];
$files->writeToFileWithCheck(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $reportPath);
```

## Αναμενόμενο Αποτέλεσμα
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

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να επεκτείνετε τη λογική για καθαρισμό βάσει τύπου αρχείου, ημερομηνίας δημιουργίας ή custom κανόνων. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
