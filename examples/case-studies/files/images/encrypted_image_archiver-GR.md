# Αρχειοθέτηση Εικόνων με Κρυπτογράφηση

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την ασφαλή επεξεργασία και αρχειοθέτηση εικόνων. Το σύστημα αλλάζει το μέγεθος και προσθέτει υδατογράφημα στις εικόνες, τις κρυπτογραφεί, αναλύει τα μεγέθη αρχείων και δημιουργεί οπτική αναφορά.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TImagesHandler**: Φόρτωση, αλλαγή μεγέθους και υδατογράφηση εικόνων.
- **TFilesHandler**: Αποθήκευση και κρυπτογράφηση αρχείων, έλεγχος quota.
- **TEventHandler**: Καταγραφή γεγονότων για διαφάνεια και debugging.
- **TArrayAnalysisHandler**: Ανάλυση μεγεθών αρχείων.
- **TArrayGraphHandler**: Δημιουργία γραφήματος σύγκρισης μεγεθών.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`encrypted_image_archiver.php`](./encrypted_image_archiver.php): Περιλαμβάνει επεξεργασία εικόνας, κρυπτογράφηση, ανάλυση και αναφορά.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/image_archiver/`.
3. Εικόνες εισόδου (`xray.jpg`, `watermark.png`) στον φάκελο `input/`.
4. Η γραμματοσειρά `Murecho-Regular.ttf` πρέπει να υπάρχει στο `$AOS_FONTS_PATH/Murecho/`.
5. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Βεβαιωθείτε ότι οι εικόνες εισόδου υπάρχουν στον φάκελο `input/`.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/files/images/encrypted_image_archiver.php
   ```

## Παράδειγμα Χρήσης
```php
$processedImage = $imagesHandler->resize($imageData, 800, 600);
$processedImage = $imagesHandler->addWatermark($processedImage, $watermarkData, 10, 10, 0.5);
$imagesHandler->saveToFile($processedImage, $outputImage);
$filesHandler->encryptFile($outputImage, $encryptedImage, "AscoosSecretKey");
$graphHandler->setArray([$originalSize, $processedSize, $encryptedSize]);
$graphHandler->createBarChart('image_size_chart.png');
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί μία επεξεργασμένη εικόνα, ένα κρυπτογραφημένο αντίγραφο και ένα γράφημα σύγκρισης μεγεθών. Παράδειγμα εξόδου:
```json
{
    "original": "/tmp/input/xray.jpg",
    "processed": "/image_archiver/image_20250828_230900.jpg",
    "encrypted": "/image_archiver/image_20250828_230900.enc",
    "chart": "/image_archiver/image_size_chart.png"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `encrypted_image_archiver.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
