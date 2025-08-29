# Μηχανή Εργασιών με Μακροεντολές

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** εκτελεί αλυσίδες ενεργειών (macros) χρησιμοποιώντας λογική FIFO, με υποστήριξη καθυστέρησης, προτεραιότητας, καταγραφής και σειριακής εκτέλεσης. Είναι ιδανική για αυτοματισμούς και DevOps.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TMacroHandler**: Διαχειρίζεται macros σε ουρά με καθυστέρηση και προτεραιότητα.
- **TLoggerHandler**: Καταγράφει τα αποτελέσματα εκτέλεσης.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`macro_workflow_engine.php`](./macro_workflow_engine.php): Προσθέτει macros στην ουρά και τα εκτελεί σειριακά.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στον φάκελο `$AOS_LOGS_PATH`.
3. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Προσθέστε macros με `addMacro()`.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/automation/macros/macro_workflow_engine.php
   ```

## Παράδειγμα Χρήσης
```php
$macroHandler->addMacro(function () {
    echo "Βήμα 1: Αρχικοποίηση<br>";
    return 'Αρχικοποίηση ολοκληρώθηκε';
}, [], delay: 1, priority: 1);

foreach ($macroHandler->runAll() as $result) {
    echo "Αποτέλεσμα: $result<br>";
}
```

## Αναμενόμενο Αποτέλεσμα
Το script εκτελεί τα macros με βάση την προτεραιότητα και την καθυστέρηση. Παράδειγμα εξόδου:
```
Βήμα 1: Αρχικοποίηση
Αποτέλεσμα: Αρχικοποίηση ολοκληρώθηκε
Βήμα 2: Επεξεργασία
Αποτέλεσμα: Η επεξεργασία ολοκληρώθηκε
Βήμα 3: Τελικό στάδιο
Αποτέλεσμα: Ολοκληρώθηκε
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `macro_workflow_engine.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
