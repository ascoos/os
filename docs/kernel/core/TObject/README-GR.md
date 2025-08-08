# Κλάση `TObject`

***Η βασική κλάση για όλες τις κλάσεις του Ascoos OS, παρέχοντας εργαλεία εκδόσεων και αποσφαλμάτωσης.***

> #### Επεκτείνει `stdClass`
> #### Υλοποιεί `TCoreHandler`, `Stringable`

## Χρήση
```php
use ASCOOS\OS\Kernel\Core\TObject;

class TNameClass extends TObject {
    // Προσαρμοσμένη υλοποίηση
}
```

Δείτε το `/examples/kernel/core/TObject/example1.php`.

## Λεπτομερής Τεκμηρίωση
Για πλήρεις λεπτομέρειες (παραμέτρους, τύπους, παραδείγματα), επισκεφθείτε το [Επίσημο Documentation Site](https://docs.ascoos.com) (υπό κατασκευή).

---

## Ιδιότητες
| Ιδιότητα | Τύπος | Περιγραφή |
|----------|-------|-----------|
| `properties` | Array | Δημόσιος πίνακας που αποθηκεύει τις ιδιότητες της κλάσης δυναμικά. |

### Κλειδιά του `properties`
| Κλειδί | Τύπος | Περιγραφή |
|--------|-------|-----------|
| `deprecated` | Boolean | Υποδεικνύει αν η κλάση είναι παρωχημένη (προεπιλογή: `false`). |
| `deprecatedAtAscoosVersion` | Integer | Έκδοση παρώχησης (-1 αν όχι). |
| `removedAtVersion` | Integer | Έκδοση αφαίρεσης (-1 αν όχι). |
| `version` | Integer | Έκδοση κλάσης (π.χ. 2400070000). |
| `MinAscoosVersion` | Integer | Ελάχιστη έκδοση Ascoos (π.χ. 2400070000). |
| `MaxAscoosVersion` | Integer | Μέγιστη έκδοση Ascoos (-1 αν απεριόριστη). |
| `MinPHPVersion` | Integer | Ελάχιστη έκδοση PHP (π.χ. 80200 για 8.2.0). |
| `MaxPHPVersion` | Integer | Μέγιστη έκδοση PHP (-1 αν απεριόριστη). |
| `ProjectVersion` | Integer | Έκδοση προϊόντος (-1 αν μη καθορισμένη). |

## Σταθερές
| Σταθερά | Τιμή | Περιγραφή |
|---------|------|-----------|
| `DEBUG_LEVEL_INFO` | `INFO` | Επίπεδο αποσφαλμάτωσης για πληροφορίες. |
| `DEBUG_LEVEL_WARNING` | `WARNING` | Επίπεδο αποσφαλμάτωσης για προειδοποιήσεις. |
| `DEBUG_LEVEL_ERROR` | `ERROR` | Επίπεδο αποσφαλμάτωσης για σφάλματα. |

## Μέθοδοι
```php
void __construct(array $properties=[])                          // Αρχικοποιεί την κλάση. Πρέπει να καλείται από τις θυγατρικές κλάσεις.
string __toString()                                             // Επιστρέφει το όνομα της κλάσης ως συμβολοσειρά.
bool Free(object $object)                                       // Ελευθερώνει τη μνήμη του αντικειμένου ή του κλώνου του.
bool FreeProperties(object $object)                             // Διαγράφει και ελευθερώνει μνήμη για όλες τις ιδιότητες.
array getChildren(object|string|null $object_or_class = null)   // Επιστρέφει τις θυγατρικές κλάσεις της δοθείσας κλάσης ή αντικειμένου.
bool getClassDeprecated()                                       // Επιστρέφει true αν η κλάση είναι παρωχημένη, αλλιώς false.
int getClassVersion()                                           // Επιστρέφει την έκδοση της κλάσης.
mixed getDeepProperty(array $keys, ?array $array = null)        // Λαμβάνει μια ιδιότητα σε οποιοδήποτε βάθος στον πίνακα ιδιοτήτων.
array getDescendantsTree(object|string|null $object_or_class = null) // Επιστρέφει δέντρο όλων των απογόνων της κλάσης ή αντικειμένου.
array|false getParents(object|string|null $object_or_class = null, bool $autoload = true) // Επιστρέφει τις γονικές κλάσεις της κλάσης ή αντικειμένου.
array getProperties()                                           // Επιστρέφει τον πίνακα ιδιοτήτων της κλάσης.
mixed getProperty(string $property)                             // Επιστρέφει το περιεχόμενο της ζητούμενης ιδιότητας.
?array getPublicProperties()                                    // Επιστρέφει πίνακα δημόσιων ιδιοτήτων.
int|false getVersion(string $property)                          // Λαμβάνει την έκδοση ως ακέραιο.
string|false getVersionStr(string $property)                    // Λαμβάνει την έκδοση ως μορφοποιημένη συμβολοσειρά.
bool isExecutable(int $currentVersion, int $currentPHPVersion)  // Ελέγχει αν η έκδοση της κλάσης είναι εκτελέσιμη με βάση τις καθορισμένες εκδόσεις.
void setDeepProperty(array $keys, mixed $value, ?array &$array = null) // Ορίζει μια ιδιότητα σε οποιοδήποτε βάθος στον πίνακα ιδιοτήτων.
void setProjectVersion(int|string $version = -1)                // Ορίζει την έκδοση του προϊόντος.
bool setProperties(array $properties, string|int|null $property_key = null) // Ορίζει ιδιότητες αναδρομικά, συνδυάζοντας υποπίνακες.
bool setProperty(string|int $property, mixed $value, string|int|null $property_key = null) // Ορίζει μία ιδιότητα της κλάσης.
```

---

<details>
<summary>🟠 ΚΛΗΡΟΝΟΜΙΕΣ</summary>

Κληρονομεί τη μέθοδο `__toString` από την `stdClass`, η οποία αντικαθίσταται για να επιστρέφει το όνομα της κλάσης. Υλοποιεί τα `TCoreHandler` και `Stringable` για βασικές λειτουργίες και μετατροπή σε συμβολοσειρά.

</details>

---

## Σύνδεσμοι
- [Κλάσεις Πυρήνα](/docs/kernel/CLASS-GR.md)
- [Αναφορά Προβλημάτων](https://issues.ascoos.com)