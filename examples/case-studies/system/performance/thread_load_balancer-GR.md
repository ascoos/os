# Ισορροπιστής Φόρτου με Νήματα

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να κατανείμει δυναμικά εργασίες σε νήματα με βάση τον τρέχοντα φόρτο CPU και μνήμης. Εξασφαλίζει βέλτιστη απόδοση παρακάμπτοντας νήματα όταν οι πόροι είναι υπερφορτωμένοι.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TThreadHandler**: Διαχειρίζεται και εκτελεί νήματα ταυτόχρονα.
- **TCoreSystemHandler**: Παρακολουθεί πόρους συστήματος όπως CPU και μνήμη.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`thread_load_balancer.php`](./thread_load_balancer.php): Περιλαμβάνει λογική δυναμικής κατανομής εργασιών βάσει φόρτου συστήματος.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στον φάκελο `$AOS_LOGS_PATH`.
3. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Ορίστε τις εργασίες και τα όρια φόρτου.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/system/performance/thread_load_balancer.php
   ```

## Παράδειγμα Χρήσης
```php
$cpuLoad = $systemHandler->get_cpu_load();
$memoryLoad = $systemHandler->get_memory_stats()['percent'];

if ($cpuLoad < 80 && $memoryLoad < 85) {
    $threadHandler->startThread("task_$index", $task);
}
```

## Αναμενόμενο Αποτέλεσμα
Το script εκκινεί νήματα μόνο όταν ο φόρτος είναι αποδεκτός. Παράδειγμα log:
```
Thread task_0 started (CPU: 42%, Memory: 61%)
Thread task_3 skipped due to high load (CPU: 87%, Memory: 90%)
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `thread_load_balancer.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
