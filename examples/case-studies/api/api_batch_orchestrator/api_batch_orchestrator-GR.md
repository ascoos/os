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
- [`api_batch_orchestrator.php`](https://github.com/ascoos/os/blob/main/examples/case-studies/api/api_batch_orchestrator/api_batch_orchestrator.php): Περιλαμβάνει εκτέλεση batch, caching, χειρισμό γεγονότων και καταγραφή.

## Προαπαιτούμενα
1. Εγκατάσταση του **Ascoos OS**. Αν χρησιμοποιείτε το [**ASCOOS Web Extended Studio (AWES) 26**](https://awes.ascoos.com), είναι ήδη προεγκατεστημένο.
2. Δικαιώματα εγγραφής στον φάκελο `$AOS_CACHE_PATH` και στο `$AOS_LOGS_PATH`.
3. Πρόσβαση στο διαδίκτυο για επικοινωνία με το JSONPlaceholder API.

## Ξεκινώντας
1. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/api/api_batch_orchestrator/api_batch_orchestrator.php
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
- [Τεκμηρίωση Ascoos OS](https://docs.ascoos.com/os)
- [Αποθετήριο GitHub](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://bootlib.ascoos.com)

## Συνεισφορά
Θέλεις να συνεισφέρεις σε αυτή τη μελέτη; Κάνε fork το αποθετήριο, τροποποίησε ή επέκτεινε το `api_batch_orchestrator.php` και υπέβαλε pull request. Δες [εδώ](https://github.com/ascoos/os/blob/main/CONTRIBUTING-GR.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δες την [άδεια χρήσης](https://github.com/ascoos/os/blob/main/LICENSE-GR.md).
