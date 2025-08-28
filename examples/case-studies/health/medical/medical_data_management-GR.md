# Διαχείριση Ιατρικών Δεδομένων και Ειδοποιήσεων

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την ασφαλή και αυτοματοποιημένη διαχείριση ιατρικών δεδομένων. Το παράδειγμα επικυρώνει δεδομένα ασθενών, επεξεργάζεται ιατρικές εικόνες (π.χ. ακτινογραφίες), καταγράφει γεγονότα και αποθηκεύει τα αποτελέσματα σε κρυπτογραφημένα αρχεία.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TImagesHandler**: Επεξεργασία εικόνων (αλλαγή μεγέθους, υδατογράφηση).
- **TDatesHandler**: Διαχείριση ημερομηνιών και προγραμματισμός επανεξέτασης.
- **TXValidationHandler**: Επικύρωση δεδομένων ασθενών με κανόνες.
- **TFilesHandler**: Αποθήκευση και κρυπτογράφηση αρχείων με quota.
- **TEventHandler**: Καταγραφή γεγονότων για έλεγχο και διαφάνεια.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`medical_data_management.php`](./medical_data_management.php): Περιλαμβάνει επικύρωση, επεξεργασία εικόνας, αποθήκευση και καταγραφή.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`Ascoos Web Extended Studio 26`](https://awes.ascoos.com), είναι ήδη προεγκατεστημένο.
2. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/medical/`.
3. Προεγκατεστημένα αρχεία εικόνας (π.χ. `xray_input.jpg`, `watermark.png`) στο φάκελο `medical/`.
4. Η γραμματοσειρά `Murecho-Regular.ttf` είναι διαθέσιμη στο `$AOS_FONTS_PATH/Murecho/`.
5. Οι μεταβλητές `$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH` ρυθμίζονται αυτόματα από το Ascoos OS.
6. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Ελέγξτε ότι οι εικόνες εισόδου υπάρχουν στον φάκελο `medical/`.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/health/medical/medical_data_management.php
   ```

## Παράδειγμα Χρήσης
```php
// Επικύρωση δεδομένων ασθενών
$rules = [
    'patient_id' => 'required|string|min:5|max:10',
    'name' => 'required|string|max:100',
    'appointment_date' => 'required|date',
    'xray_image' => 'required|string|file_exists'
];
if ($validator->validate($patientData, $rules)) {
    $patientData['follow_up_date'] = $datesHandler->addDays($patientData['appointment_date'], 7, 'Y-m-d');
    $eventHandler->trigger('medical', 'validation.success', $patientData);
}

// Επεξεργασία εικόνας ακτινογραφίας
$imageData = $imagesHandler->loadFromFile($imagePath);
$processedImage = $imagesHandler->resize($imageData, 800, 600);
$processedImage = $imagesHandler->addWatermark($processedImage, $watermarkData, 10, 10, 0.5);
$imagesHandler->saveToFile($processedImage, $outputImagePath);
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί ένα κρυπτογραφημένο αρχείο JSON με τα δεδομένα του ασθενή και την επεξεργασμένη εικόνα. Παράδειγμα εξόδου:
```json
{
    "patient_id": "P12345",
    "name": "John Doe",
    "appointment_date": "2025-08-15",
    "follow_up_date": "2025-08-22",
    "processed_image": "/medical/xray_processed_20250828_175400.jpg",
    "processed_at": "2025-08-28 17:54:00"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `medical_data_management.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
