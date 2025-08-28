# Δημιουργία και Παρακολούθηση Barcode

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** δημιουργεί και αποθηκεύει barcode ενώ παρακολουθεί τον φόρτο του συστήματος. Το παράδειγμα παράγει ένα barcode τύπου EAN-13 για έναν κωδικό προϊόντος (π.χ., 4002593016013) και το αποθηκεύει ως αρχείο PNG, παρακολουθώντας τη χρήση CPU κατά τη διαδικασία.

## Σκοπός
Αυτό το παράδειγμα δείχνει την ενσωμάτωση πολλαπλών στοιχείων του Ascoos OS:
- **TBarcodeHandler**: Δημιουργεί barcode με προσαρμόσιμες διαστάσεις και τύπους (π.χ., EAN-13).
- **TFilesHandler**: Διαχειρίζεται λειτουργίες αρχείων, όπως η αποθήκευση της εικόνας barcode.
- **TCoreSystemHandler**: Παρακολουθεί τον φόρτο του συστήματος και καταγράφει υψηλή χρήση CPU.

## Δομή
Η μελέτη περίπτωσης υλοποιείται σε ένα μόνο αρχείο PHP:
- [`barcode_creation.php`](./barcode_creation.php): Δείχνει τη ροή εργασιών για τη δημιουργία, αποθήκευση barcode, και παρακολούθηση συστήματος.

## Προαπαιτήσεις
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), το Ascoos OS είναι προεγκατεστημένο.
2. Δικαιώματα εγγραφής στον φάκελο που ορίζεται από το `$AOS_LOGS_PATH` (logs) και `$AOS_TMP_DATA_PATH/barcodes/` (αρχεία εξόδου). Αυτές οι διαδρομές διαμορφώνονται αυτόματα από το Ascoos OS.
3. Το αρχείο γραμματοσειράς `Murecho-Regular.ttf` είναι προεγκατεστημένο με το Ascoos OS στο `$AOS_FONTS_PATH/Murecho/Murecho-Regular.ttf`. Πρόσθετες γραμματοσειρές μπορούν να προστεθούν δυναμικά μέσω του προγράμματος `LibIn` με χρήση φόρμας Ajax.
4. Οι global μεταβλητές (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`) ορίζονται αυτόματα από το Ascoos OS κατά την εκκίνηση.
5. Η βιβλιοθήκη `phpBCL8` ([https://github.com/ascoos/phpbcl8](https://github.com/ascoos/phpbcl8)) είναι προεγκατεστημένη και φορτώνεται αυτόματα από το Ascoos OS χωρίς τη χρήση Composer.

## Ξεκινώντας
1. Βεβαιωθείτε ότι οι global μεταβλητές (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`) είναι διαθέσιμες, όπως ορίζονται από το Ascoos OS κατά την εκκίνηση.
2. Τροποποιήστε τον κωδικό προϊόντος και τις παραμέτρους barcode (π.χ., `width`, `height`, `type`) στην αρχικοποίηση του `$barcode` αν χρειάζεται (προεπιλογή είναι `4002593016013`, EAN-13).
3. Εκτελέστε το script μέσω ενός web server, π.χ., `https://localhost/aos/examples/case-studies/barcodes/creation/barcode_creation.php`.

## Παράδειγμα Χρήσης
```php
use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Files\TFilesHandler,
    Barcodes\TBarcodeHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

// Αρχικοποίηση διαμόρφωσης
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'disk_barcode.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/barcodes',
        'quotaSize' => 1000000000 // 1GB quota
    ]
];

// Αρχικοποίηση κλάσεων ASCOOS
$system = new TCoreSystemHandler($properties);
$files = new TFilesHandler([], $properties['file']);
$barcode = new TBarcodeHandler('4002593016013', ['width' => 300, 'height' => 120, 'fontSize' => 5, 'type' => 'ean13', 'thickness' => 2]);
```

## Αναμενόμενη Έξοδος
Το script παράγει ένα αρχείο barcode PNG (`file_4002593016013.png`) και εκτυπώνει μεταδεδομένα JSON. Παράδειγμα εξόδου:
```json
{
    "barcode_file": "file_4002593016013.png"
}
```
- Το αρχείο καταγραφής (disk_barcode.log) μπορεί να περιλαμβάνει: "Υψηλός φόρτος CPU κατά τη δημιουργία barcode: 85.2%" (εάν ο φόρτος CPU υπερβεί το 80%).
- Αρχεία που δημιουργήθηκαν: `$AOS_TMP_DATA_PATH/barcodes/file_4002593016013.png`.

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS στο LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS στο X](https://www.x.com/ascoos)
- [Ascoos Web Extended Studio](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το repository, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `barcode_creation.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
