# Παρακολούθηση Ιστοσελίδων με Γλωσσική Ανάλυση και Βελτιστοποίηση Apache

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** παρακολουθεί ιστοσελίδες, εκτελεί γλωσσική ανάλυση, διαχειρίζεται τη συνδεσιμότητα δικτύου και βελτιστοποιεί τη διαμόρφωση του Apache με βάση τα αποτελέσματα της ανάλυσης.

## Σκοπός
- Παρακολούθηση διαθεσιμότητας ιστοσελίδων, απόδοσης SEO και σπασμένων συνδέσμων.
- Εκτέλεση γλωσσικής ανάλυσης (ανίχνευση γλώσσας και ανάλυση συναισθήματος) στο περιεχόμενο των ιστοσελίδων.
- Παρακολούθηση πόρων συστήματος και καθυστέρησης δικτύου.
- Δυναμική βελτιστοποίηση της διαμόρφωσης του Apache με βάση τα αποτελέσματα.

## Κύριες Κλάσεις του Ascoos OS
- **TApacheHandler**  
  Διαχειρίζεται τη διαμόρφωση του Apache, την καταγραφή και τη βελτιστοποίηση (π.χ. ενεργοποίηση mod_rewrite, ορισμός κανόνων QoS).  
- **TNetwork**  
  Ελέγχει τη συνδεσιμότητα δικτύου και μετρά την καθυστέρηση.  
- **TWebsiteHandler**  
  Εκτελεί ελέγχους διαθεσιμότητας, ανάλυση SEO και ανάκτηση περιεχομένου ιστοσελίδων.  
- **TLanguageHandler**  
  Ανιχνεύει τη γλώσσα κειμένου και εκτελεί ανάλυση συναισθήματος.  
- **TFilesHandler**  
  Διαχειρίζεται λειτουργίες αρχείων, όπως backups και δημιουργία αναφορών.  
- **TCoreSystemHandler**  
  Παρακολουθεί πόρους συστήματος, όπως ο φόρτος της CPU.  
- **TQueueHandler**, **TStackHandler**, **TTaskHandler**, **TThreadHandler**  
  Διαχειρίζονται την ουρά εργασιών, την εκτέλεση και την παράλληλη επεξεργασία με νήματα.

## Δομή Αρχείων
Η υλοποίηση περιέχεται σε ένα αρχείο PHP:
- [`website_monitoring_with_apache_optimization.php`](website_monitoring_with_apache_optimization.php)

Το αρχείο περιλαμβάνει όλη τη λογική για την παρακολούθηση ιστοσελίδων, τη γλωσσική ανάλυση, τους ελέγχους δικτύου και τη βελτιστοποίηση του Apache.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Αρχικοποιούνται οι δημόσιες μεταβλητές και οι ιδιότητες για καταγραφή, διαχείριση αρχείων και γλωσσική ανάλυση.
2. Ορίζεται λίστα ιστοσελίδων για παρακολούθηση (`https://example.com`, `https://test.com`, `https://demo.org`).
3. Δημιουργούνται εργασίες για κάθε ιστοσελίδα που:
   - Ελέγχουν τη συνδεσιμότητα δικτύου και την καθυστέρηση.
   - Επαληθεύουν τη διαθεσιμότητα, τη βαθμολογία SEO και τους σπασμένους συνδέσμους.
   - Ελέγχουν την εγκυρότητα των πιστοποιητικών SSL.
   - Ανακτούν και καθαρίζουν το περιεχόμενο της ιστοσελίδας για γλωσσική ανάλυση (ανίχνευση γλώσσας και ανάλυση συναισθήματος).
   - Παρακολουθούν τον φόρτο της CPU.
4. Οι εργασίες προστίθενται σε ουρά και εκτελούνται παράλληλα με έως 3 νήματα.
5. Τα αποτελέσματα αποθηκεύονται σε cache για αποφυγή επαναλαμβανόμενης επεξεργασίας.
6. Αναλύονται τα αποτελέσματα για να καθοριστεί αν απαιτείται βελτιστοποίηση του Apache (π.χ. ενεργοποίηση mod_rewrite, ορισμός κανόνων QoS).
7. Δημιουργείται backup της διαμόρφωσης του Apache αν τα πιστοποιητικά SSL έχουν λήξει.
8. Δημιουργείται και αποθηκεύεται αναφορά σε μορφή JSON.
9. Η αναφορά αποστέλλεται μέσω email στον διαχειριστή.
10. Απελευθερώνονται οι πόροι.

## Παράδειγμα Κώδικα
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
            $apache->logger?->log("Ανάλυση για $url: " . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $apache->logger::DEBUG_LEVEL_INFO);
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

## Αναμενόμενο Αποτέλεσμα
Δημιουργείται μια αναφορά JSON και αποθηκεύεται στον φάκελο αναφορών (π.χ. `website_analysis_20251003_1159.json`):
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
Η αναφορά αποστέλλεται μέσω email στο `admin@example.com`. Η διαμόρφωση του Apache ενημερώνεται αν χρειάζεται (π.χ. ενεργοποίηση mod_rewrite, ορισμός κανόνων QoS).

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [ASCOOS](https://www.ascoos.com)  
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να βελτιώσετε το σύστημα προσθέτοντας περισσότερες μετρήσεις ιστοσελίδων, βελτιώνοντας τη γλωσσική ανάλυση ή βελτιστοποιώντας τη διαχείριση νημάτων. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
