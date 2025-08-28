# Έξυπνος Προγραμματισμός Ραντεβού

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την επικύρωση και τον προγραμματισμό ραντεβού με έξυπνη διαχείριση συγκρούσεων. Το παράδειγμα επικυρώνει τα δεδομένα του αιτήματος, ελέγχει τη διαθεσιμότητα της ώρας και καταγράφει το αποτέλεσμα ως γεγονός.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TDatesHandler**: Διαχείριση ημερομηνιών και χρόνου.
- **TXValidationHandler**: Επικύρωση αιτήματος ραντεβού με κανόνες.
- **TEventHandler**: Καταγραφή γεγονότων (σύγκρουση ή επιβεβαίωση).

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`appointment_scheduler.php`](./appointment_scheduler.php): Περιλαμβάνει επικύρωση, έλεγχο διαθεσιμότητας και καταγραφή γεγονότων.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`Ascoos Web Extended Studio 26`](https://awes.ascoos.com), είναι ήδη προεγκατεστημένο.
2. Δικαιώματα εγγραφής στον φάκελο `$AOS_LOGS_PATH`.
3. Οι μεταβλητές `$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH` ρυθμίζονται αυτόματα από το Ascoos OS.
4. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/health/appointments/appointment_scheduler.php
   ```

## Παράδειγμα Χρήσης
```php
// Κανόνες επικύρωσης
$rules = [
    'patient_id' => 'required|string|min:5|max:10',
    'name' => 'required|string|max:100',
    'requested_date' => 'required|date',
    'requested_time' => 'required|string|regex:/^\d{2}:\d{2}$/'
];
if (!$validator->validate($request, $rules)) {
    $eventHandler->trigger('appointments', 'conflict', ['errors' => $validator->getErrors()]);
    exit("Validation failed.");
}

// Έλεγχος διαθεσιμότητας
$requestedSlot = $request['requested_date'] . ' ' . $request['requested_time'];
if (in_array($requestedSlot, $existingAppointments)) {
    $eventHandler->trigger('appointments', 'conflict', ['slot' => $requestedSlot]);
    exit("Time slot unavailable.");
}
```

## Αναμενόμενο Αποτέλεσμα
Το script επιστρέφει ένα JSON με τα επιβεβαιωμένα στοιχεία του ραντεβού. Παράδειγμα εξόδου:
```json
{
    "patient_id": "P1001",
    "name": "Maria Papadopoulou",
    "requested_date": "2025-09-01",
    "requested_time": "10:00",
    "confirmed": true,
    "scheduled_at": "2025-08-28 22:22:00"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `appointment_scheduler.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).