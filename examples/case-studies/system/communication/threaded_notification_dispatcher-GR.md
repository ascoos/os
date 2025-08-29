# Αποστολέας Ειδοποιήσεων με Νήματα

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την αποστολή ειδοποιήσεων σε πολλαπλούς παραλήπτες ταυτόχρονα μέσω νήματος και του Telegram API. Χρησιμοποιεί ασύγχρονη εκτέλεση, παρατηρητές και δυναμική ειδοποίηση.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TThreadHandler**: Εκτελεί πολλαπλές εργασίες ταυτόχρονα.
- **TTelegramAPIHandler**: Στέλνει μηνύματα μέσω του Telegram Bot API.
- **TObserverHandler**: Παρακολουθεί και καταγράφει γεγονότα αποστολής μέσω παρατηρητών.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`threaded_notification_dispatcher.php`](./threaded_notification_dispatcher.php): Περιλαμβάνει λογική αποστολής με νήματα, ενσωμάτωση Telegram και παρακολούθηση γεγονότων.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Δημιουργία Telegram bot και λήψη `bot_token`.
3. Δικαιώματα εγγραφής στον φάκελο `$AOS_LOGS_PATH`.
4. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Αντικαταστήστε τα `your_bot_token` και `your_chat_id` με πραγματικές τιμές.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/system/communication/threaded_notification_dispatcher.php
   ```

## Παράδειγμα Χρήσης
```php
$observerHandler = TObserverHandler::getInstance([$properties['logs']]);
$observerHandler->attach(new SystemObserver(), 10);

$threadHandler->startThread('task_chat_id'.$chat_id, function () use (...) {
    $telegram = new TTelegramAPIHandler(...);
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $message]);
    $observerHandler->notify(['event' => 'telegram.sent', 'data' => ['chat_id' => $chat_id]]);
});
```

## Αναμενόμενο Αποτέλεσμα
Το script στέλνει μήνυμα σε κάθε παραλήπτη και καταγράφει επιτυχία ή αποτυχία. Παράδειγμα log:
```
System event observed: {"event":"telegram.sent","data":{"chat_id":"123456789"}}
System event observed: {"event":"telegram.failed","data":{"chat_id":"987654321"}}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `threaded_notification_dispatcher.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
