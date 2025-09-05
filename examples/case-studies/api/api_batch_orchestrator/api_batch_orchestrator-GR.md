# Ορχηστρωτής Μαζικών API Αιτημάτων

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την ορχήστρωση πολλαπλών API αιτημάτων με caching και λογική γεγονότων. Το σύστημα εκτελεί μαζικά GET αιτήματα, αποθηκεύει αποκρίσεις στην cache, εκπέμπει γεγονότα επιτυχίας/αποτυχίας και καταγράφει δραστηριότητα.

## Σκοπός
Το παράδειγμα χρησιμοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TAPIHandler**: Εκτελεί API αιτήματα με υποστήριξη caching και γεγονότων.
- **TEventHandler**: Εκπέμπει και καταγράφει γεγονότα επιτυχίας και αποτυχίας.
- **TCacheHandler**: Αποθηκεύει και ανακτά αποκρίσεις από την cache.
- **selectCache()**: Επιλέγει τον κατάλληλο τύπο cache (π.χ. file, memcached).

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`api_batch_orchestrator.php`](./api_batch_orchestrator.php): Περιλαμβάνει εκτέλεση batch, caching, χειρισμό γεγονότων και καταγραφή.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο αποθετήριο](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στον φάκελο `/tmp/ascoos_cache/` και στο `$AOS_LOGS_PATH/`.
3. Πρόσβαση στο διαδίκτυο για επικοινωνία με το JSONPlaceholder API.
4. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Βεβαιωθείτε ότι ο φάκελος `/tmp/ascoos_cache/` υπάρχει και είναι εγγράψιμος.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/api/api_batch_orchestrator.php
   ```

## Παράδειγμα Χρήσης
```php
$response = $api->sendGetRequest('posts', ['userId' => 1]);
$cacheHandler->saveCache($cacheKey, $response);
$eventHandler->emit('api.batch.success', ['responses' => $responses]);
```

## Αναμενόμενο Αποτέλεσμα
Το script επιστρέφει έναν δομημένο πίνακα αποκρίσεων API, καταγράφει γεγονότα επιτυχίας ή αποτυχίας και αποθηκεύει τα αποτελέσματα στην cache. Παράδειγμα εξόδου:
```json
{
    "posts": [...],
    "comments": [...],
    "users": [...]
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [Αποθετήριο GitHub](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλεις να συνεισφέρεις σε αυτή τη μελέτη; Κάνε fork το αποθετήριο, τροποποίησε ή επέκτεινε το `api_batch_orchestrator.php` και υπέβαλε pull request. Δες το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δες το [LICENSE](/LICENSE.md).
