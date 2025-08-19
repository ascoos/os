# Ανάλυση Περιεχομένου Ιστοσελίδας

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** αναλύει το περιεχόμενο μιας ιστοσελίδας με γλωσσική επεξεργασία, εντοπίζει τη γλώσσα, και παρακολουθεί τον φόρτο του συστήματος κατά την επεξεργασία. Το παράδειγμα ανακτά περιεχόμενο από μια ιστοσελίδα (π.χ., https://example.com), εντοπίζει τη γλώσσα, εκτελεί ανάλυση NLP, και δημιουργεί αναφορά παρακολουθώντας τη χρήση CPU.

## Σκοπός
Αυτό το παράδειγμα δείχνει την ενσωμάτωση πολλαπλών στοιχείων του Ascoos OS:
- **TWebsiteHandler**: Ανακτά και καθαρίζει το HTML περιεχόμενο της ιστοσελίδας.
- **TLanguageHandler**: Εντοπίζει τη γλώσσα του κειμένου με βάση προκαθορισμένα αρχεία αλφαβήτων και λεξιλογίου.
- **TLinguisticAnalysisHandler**: Εκτελεί γλωσσική ανάλυση με βάση την εντοπισμένη γλώσσα.
- **TCoreSystemHandler**: Παρακολουθεί τον φόρτο του συστήματος και καταγράφει υψηλή χρήση CPU.
- **TFilesHandler**: Διαχειρίζεται λειτουργίες αρχείων, όπως η αποθήκευση της αναφοράς ανάλυσης.

## Δομή
Η μελέτη περίπτωσης υλοποιείται σε ένα μόνο αρχείο PHP:
- [`website_linguistic_analysis.php`](./website_linguistic_analysis.php): Δείχνει τη ροή εργασιών για ανάκτηση περιεχομένου, εντοπισμό γλώσσας, γλωσσική ανάλυση, και παρακολούθηση συστήματος.

## Προαπαιτήσεις
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), το Ascoos OS είναι προεγκατεστημένο.
2. Απαιτείται μια διαμορφωμένη βάση δεδομένων NLP (π.χ., MySQL) για το `TLinguisticAnalysisHandler`. Η διαμόρφωση της βάσης δεδομένων ορίζεται αυτόματα μέσω του global πίνακα `$conf['db']['mysqli']` κατά την εκκίνηση του Ascoos OS.
3. Δικαιώματα εγγραφής στους φακέλους που ορίζονται από το `$AOS_LOGS_PATH` (logs) και `$AOS_TMP_DATA_PATH/reports/nlp/` (αρχεία εξόδου). Αυτές οι διαδρομές διαμορφώνονται αυτόματα από το Ascoos OS.
4. Τα αρχεία διαμόρφωσης `alphabets.json` και `wordlist.json` πρέπει να είναι διαθέσιμα στο `$AOS_CONFIG_PATH/`.
5. Το αρχείο γραμματοσειράς `Murecho-Regular.ttf` είναι προεγκατεστημένο με το Ascoos OS στο `$AOS_FONTS_PATH/Murecho/Murecho-Regular.ttf`. Πρόσθετες γραμματοσειρές μπορούν να προστεθούν δυναμικά μέσω του προγράμματος `LibIn` με χρήση φόρμας Ajax.
6. Οι global μεταβλητές (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`, `$AOS_CONFIG_PATH`) ορίζονται αυτόματα από το Ascoos OS κατά την εκκίνηση.
7. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα από το Ascoos OS χωρίς τη χρήση Composer.

## Ξεκινώντας
1. Βεβαιωθείτε ότι οι global μεταβλητές (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`, `$AOS_CONFIG_PATH`) είναι διαθέσιμες, όπως ορίζονται από το Ascoos OS κατά την εκκίνηση.
2. Τροποποιήστε την μεταβλητή `$url` στο script για να στοχεύσετε την επιθυμητή ιστοσελίδα (προεπιλεγμένη είναι `https://example.com`).
3. Εκτελέστε το script μέσω ενός web server, π.χ., `https://localhost/aos/examples/case-studies/websites/linguistic_analysis/website_linguistic_analysis.php`.

## Παράδειγμα Χρήσης
```php
use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Websites\TWebsiteHandler,
    Languages\TLanguageHandler,
    AI\TLinguisticAnalysisHandler,
    Files\TFilesHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH, $AOS_CONFIG_PATH;

// Αρχικοποίηση ρυθμίσεων
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'sports_analysis.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . 'reports/nlp/',
        'quotaSize' => 1000000000
    ],
    'nlp' => [
        'host' => $conf['db']['mysqli']['host'] ?? 'localhost',
        'user' => $conf['db']['mysqli']['user'] ?? 'root',
        'password' => $conf['db']['mysqli']['pass'] ?? 'root',
        'dbname' => $conf['db']['mysqli']['dbname'] ?? 'linguistics'
    ]
];

// Αρχικοποίηση κλάσεων ASCOOS
$system = new TCoreSystemHandler(['cpu_percent_warn' => 80]);
$website = new TWebsiteHandler();
$language = new TLanguageHandler([], [
    'alphabetsPath' => $AOS_CONFIG_PATH . '/alphabets.json',
    'wordListPath' => $AOS_CONFIG_PATH . '/wordlist.json'
]);
$nlp = new TLinguisticAnalysisHandler([], $properties['nlp']);
```

## Αναμενόμενη Έξοδος
Το script παράγει μια αναφορά JSON (`report.json`) με λεπτομέρειες για την ιστοσελίδα, την εντοπισμένη γλώσσα, τον φόρτο CPU, και την γλωσσική ανάλυση. Παράδειγμα εξόδου JSON:
```json
{
    "url": "https://example.com",
    "language": "el",
    "cpu_load": 45.3,
    "analysis": {
        "sentiment": "ουδέτερο",
        "keywords": ["παράδειγμα", "δοκιμή"]
    }
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS στο LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS στο X](https://www.x.com/ascoos)
- [Ascoos Web Extended Studio](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το repository, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `website_linguistic_analysis.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
