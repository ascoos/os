# Ενσωμάτωση Laravel στο Ascoos OS

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS**, ένα Full Modular PHP Web5 Kernel, ενσωματώνει το **Laravel Framework** μέσω του συστήματος `LibIn` upload, εκμεταλλευόμενο το οικοσύστημα του (macros, events, κ.λπ.) χωρίς εξάρτηση από το Composer. Επιδεικνύει τη φόρτωση του Laravel, την αρχικοποίηση με macros και events, και τη σύνδεση με το global scope.

## Σκοπός
- Φόρτωση και αρχικοποίηση του Laravel μέσω του `LibIn` upload system.
- Ενσωμάτωση του Laravel με το `TMacroHandler` για εκτέλεση macros.
- Καταγραφή γεγονότων αρχικοποίησης με το `TEventHandler`.
- Παροχή παγκόσμιας πρόσβασης στο `$laravel_app` για μικτή χρήση.
- Δυνατότητα επέκτασης από προγραμματιστές Laravel.

## Κύριες Κλάσεις του Ascoos OS
- **TMacroHandler**: Διαχειρίζεται την εκτέλεση macros για το Laravel.
- **TEventHandler**: Καταγράφει και εκπέμπει γεγονότα, όπως το `laravel_init`.
- **TLoggerHandler**: Χρησιμοποιείται για καταγραφή logs από το Laravel.

## Δομή Αρχείων
Η υλοποίηση περιέχεται σε ένα αρχείο PHP:
- [`laravel_autoload.php`](./laravel_autoload.php)

## Προαπαιτούμενα
1. PHP ≥ 8.2
2. Εγκατεστημένο **Ascoos OS** ή [`AWES 26`](https://awes.ascoos.com)
3. Ένα ascoos `.az` archive του Laravel (συμπεριλαμβανομένων `vendor` και `bootstrap`).

## Ροή Εκτέλεσης
1. Ορισμός του `LARAVEL_BASE_PATH` μέσω του `$AOS_LIBS_PATH`.
2. Έλεγχος ύπαρξης του `vendor/autoload.php` και εκτέλεση εξαίρεσης αν δεν υπάρχει.
3. Φόρτωση του `vendor/autoload.php` και εκκίνηση του `bootstrap/app.php`.
4. Αρχικοποίηση του `$laravel_app` και σύνδεσή του στο `$GLOBALS['laravel_app']`.
5. Εκτέλεση macro για logging της αρχικοποίησης με το `TMacroHandler`.
6. Καταγραφή του γεγονότος `laravel_init` με χρονική σήμανση μέσω του `TEventHandler`.
7. Απελευθέρωση πόρων με `Free()`.

## Παράδειγμα Κώδικα
```php
// Πρόσβαση στην εφαρμογή Laravel παγκοσμίως
$laravel_app = $GLOBALS['laravel_app'];
$laravel_app->make('log')->info('Προσαρμοσμένο μήνυμα');

// Εκτέλεση ενός macro
$macroHandler = TMacroHandler::getInstance();
$macroHandler->addMacro(fn() => $laravel_app->make('log')->info('Custom macro executed'));
$macroHandler->runNext();
```

## Αναμενόμενο Αποτέλεσμα
- **Log Μήνυμα** (`laravel_loads.log`):
  ```
  [2025-10-04 19:27:00] INFO: Laravel initialized with Ascoos OS
  ```
- **Event Log** (μέσω `TEventHandler`):
  ```
  [2025-10-04 19:27:00] INFO: Laravel integration successful at 2025-10-04 19:27:00
  ```
- **Παγκόσμια Πρόσβαση**: Η μεταβλητή `$GLOBALS['laravel_app']` είναι διαθέσιμη για περαιτέρω χρήση.

## Πόροι
- [Τεκμηρίωση Ascoos OS](https://os.ascoos.com/docs/)
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Βελτιώστε το case study προσθέτοντας υποστήριξη για άλλα frameworks (π.χ. Symfony), ενσωματώνοντας περισσότερα macros, ή δημιουργώντας ένα `AscoosServiceProvider`. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
