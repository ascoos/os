# Πίνακας Συναγερμών Συστήματος σε Πραγματικό Χρόνο

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την παρακολούθηση πόρων συστήματος και του Apache server σε πραγματικό χρόνο, την ενεργοποίηση ειδοποιήσεων όταν ξεπερνιούνται όρια, την καταγραφή γεγονότων και τη δημιουργία οπτικών αναφορών.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TCoreSystemHandler**: Παρακολούθηση CPU, μνήμης, δίσκου, uptime και δικτύου.
- **TApacheHandler**: Έλεγχος κατάστασης και απόδοσης του Apache.
- **TEventHandler**: Καταγραφή ειδοποιήσεων και γεγονότων.
- **TArrayGraphHandler**: Δημιουργία γραφημάτων μετρήσεων.
- **THTAccessHandler**, **TCSPHandler**, **TCORSHeaderHandler**: Προαιρετική ενίσχυση ασφάλειας.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`system_alert_dashboard.php`](./system_alert_dashboard.php): Περιλαμβάνει παρακολούθηση, ειδοποίηση, καταγραφή και αναφορά.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/reports/`.
3. Η γραμματοσειρά `Murecho-Regular.ttf` πρέπει να υπάρχει στο `$AOS_FONTS_PATH/Murecho/`.
4. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/system/dashboard/system_alert_dashboard.php
   ```

## Παράδειγμα Χρήσης
```php
$cpu = $system->get_cpu_load(0);
$memory = $system->get_memory_stats()['percent'];
$apacheRunning = $apache->isServerRunning();

if ($cpu > 85) {
    $eventHandler->trigger('alerts', 'cpu.high', ['cpu' => $cpu]);
}
$graphHandler->setArray([$cpu, $memory]);
$graphHandler->createGaugeChart('/reports/system_metrics.png');
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί μία σύνοψη σε JSON και ένα γράφημα PNG. Παράδειγμα εξόδου:
```json
{
    "cpu": 87.5,
    "memory": 82.3,
    "apache_running": true,
    "graph": "/reports/system_metrics.png"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `system_alert_dashboard.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
