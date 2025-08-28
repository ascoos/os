# Υπολογισμός Δυνάμεων σε Μηχανικές Κατασκευές

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για τεχνικούς υπολογισμούς σε μηχανικές εφαρμογές. Το παράδειγμα υπολογίζει δύναμη με βάση τη μάζα και την επιτάχυνση (Νόμος του Νεύτωνα), αποθηκεύει τα αποτελέσματα σε αρχείο JSON και καταγράφει γεγονότα συστήματος.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TMathsHandler**: Υπολογισμός δύναμης με μαθηματικές πράξεις.
- **TFilesHandler**: Αποθήκευση αποτελεσμάτων και έλεγχος quota.
- **TEventHandler**: Καταγραφή γεγονότων υπολογισμού.
- **TCoreSystemHandler**: Παρακολούθηση φόρτου CPU και καταγραφή logs.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`engineering_forces.php`](./engineering_forces.php): Περιλαμβάνει τον υπολογισμό, αποθήκευση και καταγραφή.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/ascoos_data/engineering/`.
3. Οι μεταβλητές `$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH` ρυθμίζονται αυτόματα από το Ascoos OS.
4. Η βιβλιοθήκη [`phpBCL8`](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/engineering/forces/engineering_forces.php
   ```

## Παράδειγμα Χρήσης
```php
$mass = 100.0; // kg
$acceleration = 9.81; // m/s^2
$force = $maths->power($mass * $acceleration, 1); // F = m * a
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί ένα αρχείο JSON με τα αποτελέσματα υπολογισμού. Παράδειγμα εξόδου:
```json
{
  "structure_id": "STR001",
  "force": 981,
  "timestamp": "2025-08-18T15:21:00+03:00"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `engineering_forces.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
