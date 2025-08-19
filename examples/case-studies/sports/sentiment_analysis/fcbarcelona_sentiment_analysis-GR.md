# Ανάλυση Συναισθήματος FC Barcelona

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** αναλύει δεδομένα από κοινωνικά μέσα σχετικά με τον αθλητισμό, εκτελεί ανάλυση συναισθήματος μέσω NLP και οπτικοποιεί τα αποτελέσματα με γραφήματα. Το παράδειγμα εστιάζει στην ανάκτηση tweets για την FC Barcelona από την πλατφόρμα X, την ανάλυση του συναισθήματός τους, τη δημιουργία ενός γραφήματος και την αποθήκευση των αποτελεσμάτων σε αρχείο JSON.

## Σκοπός
Αυτό το παράδειγμα δείχνει την ενσωμάτωση πολλαπλών στοιχείων του Ascoos OS:
- **TTwitterAPIHandler**: Ανακτά tweets από την πλατφόρμα X.
- **TLinguisticAnalysisHandler**: Εκτελεί ανάλυση συναισθήματος στα κείμενα των tweets.
- **TArrayGraphHandler**: Δημιουργεί ένα γράφημα ράβδων για την κατανομή των συναισθημάτων.
- **TFilesHandler**: Διαχειρίζεται λειτουργίες αρχείων, όπως η αποθήκευση της αναφοράς.
- **TCoreSystemHandler**: Παρακολουθεί τους πόρους του συστήματος και καταγράφει υψηλό φόρτο CPU.

## Δομή
Η μελέτη περίπτωσης υλοποιείται σε ένα μόνο αρχείο PHP:
- [`fcbarcelona_sentiment_analysis.php`](./fcbarcelona_sentiment_analysis.php): Δείχνει τη συνολική ροή εργασιών για ανάκτηση tweets, ανάλυση συναισθήματος, δημιουργία γραφήματος και αποθήκευση αποτελεσμάτων.

## Προαπαιτήσεις
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), το Ascoos OS είναι προεγκατεστημένο.
2. Απαιτείται ένα έγκυρο OAuth token του X API για το `TTwitterAPIHandler`.
3. Μια διαμορφωμένη βάση δεδομένων NLP (π.χ., MySQL) για το `TLinguisticAnalysisHandler`. Η διαμόρφωση της βάσης δεδομένων ορίζεται αυτόματα μέσω του global πίνακα `$conf['db']['mysqli']` κατά την εκκίνηση του Ascoos OS.
4. Δικαιώματα εγγραφής στους φακέλους που ορίζονται από το `$AOS_LOGS_PATH` (logs) και `$AOS_TMP_DATA_PATH/sports/` (αρχεία εξόδου). Αυτές οι διαδρομές διαμορφώνονται αυτόματα από το Ascoos OS.
5. Το αρχείο γραμματοσειράς `Murecho-Regular.ttf` είναι προεγκατεστημένο με το Ascoos OS στο `$AOS_FONTS_PATH/Murecho/Murecho-Regular.ttf`. Πρόσθετες γραμματοσειρές μπορούν να προστεθούν δυναμικά μέσω του προγράμματος `LibIn` με χρήση φόρμας Ajax.
6. Οι global μεταβλητές (`$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH`, `$AOS_FONTS_PATH`) ορίζονται αυτόματα από το Ascoos OS κατά την εκκίνηση.
7. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα από το Ascoos OS χωρίς τη χρήση Composer.

## Ξεκινώντας
1. Ρυθμίστε το πίνακα `$properties` στο script με το OAuth token του X API (αν παρακάμπτετε την προεπιλεγμένη διαμόρφωση).
2. Εκτελέστε το script μέσω ενός web server, π.χ., `https://localhost/aos/examples/case-studies/sports/sentiment_analysis/fcbarcelona_sentiment_analysis.php`.

## Παράδειγμα Χρήσης
```php
use ASCOOS\OS\Kernel\API\TTwitterAPIHandler;
use ASCOOS\OS\Kernel\AI\TLinguisticAnalysisHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;
use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;

global $conf, $AOS_TMP_DATA_PATH, $AOS_FONTS_PATH, $AOS_LOGS_PATH;

// Αρχικοποίηση ρυθμίσεων
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'sports_analysis.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/sports/',
        'quotaSize' => 1000000000
    ],
    'nlp' => [
        'host' => $conf['db']['mysqli']['host'] ?? 'localhost',
        'user' => $conf['db']['mysqli']['user'] ?? 'root',
        'password' => $conf['db']['mysqli']['pass'] ?? 'root',
        'dbname' => $conf['db']['mysqli']['dbname'] ?? 'nlp'
    ]
];

// Αρχικοποίηση κλάσεων ASCOOS
$twitter = new TTwitterAPIHandler('https://api.x.com', 0, [], 'GET', $properties);
$twitter->setOAuthToken('your_oauth_token_here');
$tweets = $twitter->getTweets(['query' => 'from:FCBarcelona', 'max_results' => 10]);
```

## Αναμενόμενη Έξοδος
Το script παράγει μια αναφορά JSON και δημιουργεί ένα γράφημα ράβδων (`sentiment_trend.png`). Παράδειγμα εξόδου JSON:
```json
{
    "team": "FCBarcelona",
    "sentiments": {
        "positive": 7,
        "neutral": 2,
        "negative": 1
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
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το repository, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `fcbarcelona_sentiment_analysis.php` και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
