# Παρακολούθηση Συστήματος και Backup

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** πραγματοποιεί παρακολούθηση πόρων συστήματος, αυτόματη δημιουργία αντιγράφων ασφαλείας, κρυπτογράφηση και αποστολή ειδοποιήσεων σε πραγματικό χρόνο μέσω Telegram. Αναδεικνύεται η συνεργασία πολλαπλών χειριστών για τη διασφάλιση της σταθερότητας και της προστασίας δεδομένων του συστήματος.

## Σκοπός
Το παράδειγμα αυτό αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TCoreSystemHandler**: Παρακολουθεί το φορτίο CPU, τη χρήση μνήμης και τον χρόνο λειτουργίας του συστήματος.
- **TFilesHandler**: Διαχειρίζεται λειτουργίες αρχείων, όπως δημιουργία φακέλων, έλεγχο quota και κρυπτογράφηση.
- **TTelegramAPIHandler**: Στέλνει ειδοποιήσεις σε πραγματικό χρόνο μέσω Telegram.
- **TEventHandler**: Καταχωρεί και ενεργοποιεί προσαρμοσμένα γεγονότα συστήματος.

## Δομή
Η μελέτη περίπτωσης υλοποιείται σε ένα αρχείο PHP:
- [`system_monitoring_backup.php`](./system_monitoring_backup.php): Παρακολουθεί το σύστημα, δημιουργεί κρυπτογραφημένα στιγμιότυπα και στέλνει ειδοποιήσεις.

## Προαπαιτούμενα
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κεντρικό αποθετήριο](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`AWES 26`](https://awes.ascoos.com), το Ascoos OS είναι προεγκατεστημένο.
2. Απαιτείται έγκυρο bot token και chat ID για το Telegram (`TTelegramAPIHandler`).
3. Δικαιώματα εγγραφής στους φακέλους που ορίζονται από τις μεταβλητές `$AOS_LOGS_PATH` και `$AOS_BACKUP_PATH`.
4. Οι μεταβλητές (`$conf`, `$AOS_LOGS_PATH`, `$AOS_BACKUP_PATH`) ρυθμίζονται αυτόματα κατά την αρχικοποίηση του Ascoos OS.
5. Η βιβλιοθήκη [`phpBCL8`](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Ρυθμίστε τον πίνακα `$properties` στο script με το bot token και το chat ID του Telegram.
2. Εκτελέστε το script μέσω web server, π.χ.:
   ```
   https://localhost/aos/examples/case-studies/system/monitoring/system_monitoring_backup.php
   ```

## Παράδειγμα Χρήσης
```php
use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;
use ASCOOS\OS\Kernel\API\TTelegramAPIHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;

global $AOS_LOGS_PATH, $AOS_BACKUP_PATH;

// Αρχικοποίηση ρυθμίσεων
$properties = [
    'file' => [
        'dataDir' => $AOS_BACKUP_PATH . '/system_backups',
        'quotaSize' => 1000000
    ],
    'telegram' => [
        'url' => 'https://api.telegram.org',
        'bot_token' => 'your_bot_token_here'
    ],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/ascoos',
        'file' => 'system_monitor.log'
    ]
];
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί ένα κρυπτογραφημένο στιγμιότυπο συστήματος και στέλνει ειδοποίηση Telegram αν το φορτίο CPU ξεπεράσει το 80%. Παράδειγμα JSON στιγμιότυπου:
```json
{
    "cpu_load_percent": 85,
    "memory_stats": {
        "total": 8192,
        "used": 6144,
        "free": 2048
    },
    "uptime_seconds": 36000,
    "timestamp": "2025-08-28 15:35:00"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [Αποθετήριο GitHub](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork στο αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `system_monitoring_backup.php` και υποβάλετε ένα pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης διατίθεται υπό την Άδεια Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
