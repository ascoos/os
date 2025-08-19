# Παραδείγματα TObject

Αυτός ο φάκελος περιέχει παραδείγματα που δείχνουν τη χρήση της κλάσης `TObject`, της θεμελιώδους κλάσης του **Ascoos OS**. 

Η `TObject` παρέχει βασικές λειτουργίες για διαχείριση ιδιοτήτων, versioning, αποθήκευση σε cache και αποσφαλμάτωση, αποτελώντας τη βάση για όλες τις άλλες κλάσεις.

## Σκοπός
Τα παραδείγματα αυτά καταδεικνύουν πώς να χρησιμοποιήσετε τις μεθόδους της `TObject` σε πραγματικά σενάρια, όπως:
- Διαχείριση ιδιοτήτων αντικειμένων (π.χ., `setProperty`, `getProperty`).
- Πάγωμα ή κλείδωμα ιδιοτήτων (π.χ., `freezeObject`, `isFreezed`, `isLocked`).
- Κλωνοποίηση αντικειμένων και διαχείριση μεταδεδομένων.

## Δομή
Τα παραδείγματα είναι οργανωμένα με βάση το namespace `ASCOOS\OS\Kernel\Core\TObject` για συνέπεια με την αρχιτεκτονική του `Ascoos OS`:
- Κάθε παράδειγμα είναι ένα αυτόνομο PHP αρχείο, με όνομα που αντικατοπτρίζει τη μέθοδο που παρουσιάζει (π.χ., `freezeObject.php`).
- Η τεκμηρίωση της κλάσης `TObject` βρίσκεται στο [`/docs/kernel/core/TObject/README-GR.md`](/docs/kernel/core/TObject/README-GR.md).

## Διαθέσιμα Παραδείγματα
| Αρχείο Παραδείγματος | Μέθοδος | Περιγραφή |
|----------------------|---------|-----------|
| [`batchUpdateProperties.php`](batchUpdateProperties.php) | `batchUpdateProperties` | Παρουσιάζει την μαζική ενημέρωση ιδιοτήτων με επικύρωση.
| [`cacheProperties.php`](cacheProperties.php) | `cacheProperties` | Παρουσιάζει την αποθήκευση ιδιοτήτων αντικειμένου στην cache
| [`cloneObject.php`](cloneObject.php) | `cloneObject` | Παρουσιάζει τη δημιουργία ενός βαθύ κλώνου ενός instance της TObject
| [`cloneProperties.php`](cloneProperties.php) | `cloneProperties` | Παρουσιάζει την κλωνοποίηση ιδιοτήτων
| [`compareProperties.php`](compareProperties.php) | `compareProperties` | Παρουσιάζει τη σύγκριση ιδιοτήτων
| [`executeBatchOperations.php`](executeBatchOperations.php) | `executeBatchOperations` | Παρουσιάζει την εκτέλεση μιας σειράς λειτουργιών
| [`exportToJson.php`](exportToJson.php) | `exportToJson` | Παρουσιάζει την εξαγωγή ενός instance της TObject σε JSON
| [`Free.php`](Free.php) | `Free` | Παρουσιάζει την απελευθέρωση του αντικειμένου και των πόρων που καταλαμβάνει
| [`FreeProperties.php`](FreeProperties.php) | `FreeProperties` | Απελευθέρωση και αρχικοποίηση όλων των ιδιοτήτων του αντικειμένου
| [`freezeObject.php`](freezeObject.php) | `freezeObject` | Παρουσιάζει το πάγωμα ενός αντικειμένου
| [`getChildren.php`](getChildren.php) | `getChildren` | Παρουσιάζει την ανάκτηση παιδικών κλάσεων.
| [`getClassDeprecated.php`](getClassDeprecated.php) | `getClassDeprecated` | Παρουσιάζει τον έλεγχο κατάργησης κλάσης
| [`getClassMetadata.php`](getClassMetadata.php) | `getClassMetadata` | Παρουσιάζει την ανάκτηση μεταδεδομένων
| [`getClassVersion.php`](getClassVersion.php) | `getClassVersion` | Παρουσιάζει την απόκτηση έκδοσης κλάσης
| [`getDeepProperty.php`](getDeepProperty.php) | `getDeepProperty` | Παρουσιάζει την ανάκτηση μιας ένθετης ιδιότητας
| [`getDescendantsTree.php`](getDescendantsTree.php) | `getDescendantsTree` | Παρουσιάζει την ανάκτηση ενός ιεραρχικού δέντρου απογόνων κλάσεων
| [`getParents.php`](getParents.php) | `getParents` | Παρουσιάζει την ανάκτηση γονικών κλάσεων
| [`getProperty.php`](Properties.php) | `getProperty` | Παρουσιάζει την ανάκτηση μιας ιδιότητας
| [`getPropertyMetadata.php`](getPropertyMetadata.php) | `getPropertyMetadata` | Παρουσιάζει την ανάκτηση μεταδεδομένων ιδιοτήτων
| [`getPropertySnapshot.php`](getPropertySnapshot.php) | `getPropertySnapshot` | Παρουσιάζει τη ανάκτηση στιγμιοτύπου ιδιοτήτων
| [`hasProperty.php`](hasProperty.php) | `hasProperty` | Παρουσιάζει τον έλεγχο ύπαρξης ιδιότητας
| [`hasRequiredProperties.php`](hasRequiredProperties.php) | `hasRequiredProperties` | Παρουσιάζει τον έλεγχο απαιτούμενων ιδιοτήτων
| [`invalidateCache.php`](invalidateCache.php) | `invalidateCache` | Παρουσιάζει την ακύρωση cached ιδιοτήτων
| [`invokeMethod.php`](invokeMethod.php) | `invokeMethod` | Παρουσιάζει την δυναμική κλήση μιας μεθόδου
| [`isCallableMethod.php`](isCallableMethod.php) | `isCallableMethod` | Ελέγχει εάν μια μέθοδος μπορεί να κληθεί
| [`isExecutable.php`](isExecutable.php) | `isExecutable` | Ελέγχει εάν η κλάση είναι εκτελέσιμη
| [`isFreezed.php`](isFreezed.php) | `isFreezed` | Ελέγχει αν οι ιδιότητες ενός αντικειμένου είναι παγωμένες. |
| [`isLocked.php`](isLocked.php) | `isLocked` | Ελέγχει αν οι ιδιότητες ενός αντικειμένου είναι κλειδωμένες. |
| [`isPropertyModified.php`](isPropertyModified.php) | `isPropertyModified` | Ελέγχει αν μια ιδιότητα έχει τροποποιηθεί
| [`lockProperties.php`](lockProperties.php) | `lockProperties` | Παρουσιάζει το κλείδωμα των ιδιοτήτων του αντικειμένου
| [`mergeProperties.php`](mergeProperties.php) | `mergeProperties` | Παρουσιάζει τη συγχώνευση ιδιοτήτων με διαφορετικές στρατηγικές `overwrite`, `merge` ή `append`.
| [`Properties.php`](Properties.php) | `setProperty, getProperty` | Παρουσιάζει την εισαγωγή και ανάκτηση ιδιοτήτων
| [`PropertySnapshot.php`](PropertySnapshot.php) | `getPropertySnapshot, setPropertySnapshot` | Παρουσιάζει τη δημιουργία και ανάκτηση ενός στιγμιοτύπου ιδιοτήτων
| [`propertyValidation.php`](propertyValidation.php) | `propertyValidation` | Ελέγχει αν το κλείδι μιας ιδιότητας είναι συμβολοσειρά ή ακέραιος
| [`resetProperties.php`](resetProperties.php) | `resetProperties` | Παρουσιάζει την επαναφορά στην αρχική κατάσταση των ιδιοτήτων αντικειμένου
| [`restoreFromCache.php`](restoreFromCache.php) | `restoreFromCache` | Παρουσιάζει την επαναφορά ιδιοτήτων αντικειμένου από το cache
| [`serializeToArray.php`](serializeToArray.php) | `serializeToArray` | Παρουσιάζει τη σειριοποίηση ενός instance της TObject σε πίνακα
| [`setDeepProperty.php`](setDeepProperty.php) | `setDeepProperty` | Παρουσιάζει την εισαγωγή μιας ένθετης ιδιότητας
| [`setProjectVersion.php`](setProjectVersion.php) | `setProjectVersion` | Παρουσιάζει την εισαγωγή έκδοσης έργου
| [`setProperty.php`](setProperty.php) | `setProperty` | Παρουσιάζει την εισαγωγή μιας νέας ιδιότητας
| [`trackPropertyChanges.php`](trackPropertyChanges.php) | `trackPropertyChanges` | Παρουσιάζει την παρακολούθηση αλλαγών ιδιοτήτων
| [`unfreezeObject.php`](unfreezeObject.php) | `unfreezeObject` | Παρουσιάζει την απόψυξη ενός αντικειμένου
| [`unlockProperties.php`](unlockProperties.php) | `unlockProperties` | Παρουσιάζει το ξεκλείδωμα των ιδιοτήτων του αντικειμένου
| [`validatePropertyConstraints.php`](validatePropertyConstraints.php) | `validatePropertyConstraints` | Παρουσιάζει την επικύρωση περιορισμών ιδιοτήτων 
| *(Περισσότερα παραδείγματα θα προστεθούν)* | | |

## Ξεκινώντας
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κύριο αποθετήριο](https://github.com/ascoos/os)). Εάν χρησιμοποιείται την σουίτα ανάπτυξης [`ASCOOS Web Extended Studio (AWES)`](https://github.com/ascoos/awes) τότε δεν χρειάζεται να εγκαταστήσετε το `Ascoos OS` καθώς είναι ρυθμισμένο να προφορτώνεται.
2. Πλοηγηθείτε στα αρχεία παραδειγμάτων στο `/examples/kernel/core/TObject/`.
3. Εκτελέστε τα PHP αρχεία (π.χ., `https://localhost/aos/examples/kernel/core/TObject/freezeObject.php`) για να δείτε το αποτέλεσμα.

## Παράδειγμα Χρήσης
```php
use ASCOOS\OS\Kernel\Core\TObject;

$object = new TObject(['name' => 'TestObject']);
$object->freezeObject();
echo $object->isFreezed() ? "Το αντικείμενο είναι παγωμένο\n" : "Το αντικείμενο δεν είναι παγωμένο\n";
```

## Πόροι
- [Τεκμηρίωση TObject](/docs/kernel/core/TObject/)
- [Τεκμηρίωση Ascoos OS](/docs/)
- [Αποθετήριο GitHub](https://github.com/ascoos/os)
- [Ascoos OS στο LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS στο X](https://www.x.com/ascoos)

## Συνεισφορά
Θέλετε να προσθέσετε περισσότερα παραδείγματα; Κάντε fork το αποθετήριο, δημιουργήστε ένα νέο αρχείο παραδείγματος και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Τα παραδείγματα αυτά υπόκεινται στην Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
