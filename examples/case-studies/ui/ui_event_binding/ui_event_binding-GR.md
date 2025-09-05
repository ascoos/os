# Δέσμευση UI Συμβάντων με TEventHandler

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να δεσμεύσει συμβάντα από το UI (π.χ. `onClick`) με λογική στον server μέσω της κλάσης `TEventHandler`. Υποστηρίζει καταγραφή, εκτέλεση callbacks και σύνδεση με BootLib, Ajax ή DSL macros.

## Σκοπός
Το παράδειγμα χρησιμοποιεί την παρακάτω κλάση του Ascoos OS:
- **TEventHandler**: Καταχωρίζει και ενεργοποιεί συμβάντα, καταγράφει δραστηριότητα και εκτελεί λογική μέσω callbacks ή functions.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`ui_event_binding.php`](./ui_event_binding.php): Περιλαμβάνει καταχώριση συμβάντος, ενεργοποίηση, καταγραφή και εκτέλεση λογικής.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο αποθετήριο](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στον φάκελο `$AOS_LOGS_PATH/tmp/logs/`.

## Ξεκινώντας
1. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/ui/ui_event_binding/ui_event_binding.php
   ```

2. Ενεργοποιήστε το συμβάν με JavaScript:
   ```javascript
   fetch('/aos/examples/case-studies/ui/ui_event_binding/ui_event_binding.php', {
     method: 'POST',
     body: JSON.stringify({ event: 'ui.onClick', elementId: 'submitButton' }),
     headers: { 'Content-Type': 'application/json' }
   });
   ```

3. Ή χρησιμοποιήστε jQuery για υποβολή φόρμας:
   ```html
   <button id="submitButton">Υποβολή</button>
   <script>
     $('#submitButton').on('click', function() {
       $.ajax({
         url: 'server.php',
         type: 'POST',
         data: {
           target: 'ui',
           eventType: 'onClick',
           elementId: 'submitButton',
           formData: { name: 'Χρήστης', email: 'user@example.com' }
         },
         success: function(response) {
           console.log(response);
         }
       });
     });
   </script>
   ```

## Παράδειγμα Χρήσης
```php
$eventHandler->register('ui', 'onClick', fn($params) => processForm($params));
$eventHandler->trigger('ui', 'onClick', $data);
```

## Αναμενόμενο Αποτέλεσμα
Το script καταγράφει το συμβάν και επιστρέφει:
```plaintext
Ελήφθησαν δεδομένα: Όνομα = Χρήστης, Email = user@example.com
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [Αποθετήριο GitHub](https://github.com/ascoos/os)
- [BootLib UI Framework](https://github.com/ascoos/bootlib)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλεις να συνεισφέρεις σε αυτή τη μελέτη; Κάνε fork το αποθετήριο, τροποποίησε ή επέκτεινε το `ui_event_binding.php` και υπέβαλε pull request. Δες το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δες το [LICENSE](/LICENSE.md).
