# Παρακολούθηση Περιβαλλοντικών Αισθητήρων με Arduino

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για την παρακολούθηση αισθητήρων θερμοκρασίας και υγρασίας μέσω Arduino. Το σύστημα επικυρώνει τα δεδομένα, καταγράφει γεγονότα, αναλύει τις τιμές και δημιουργεί οπτικές αναφορές.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TArduinoHandler**: Επικοινωνία με Arduino και ανάγνωση δεδομένων αισθητήρων.
- **TValidationHandler**: Επικύρωση των τιμών θερμοκρασίας και υγρασίας.
- **TArrayAnalysisHandler**: Ανάλυση στατιστικών δεδομένων.
- **TArrayGraphHandler**: Δημιουργία γραφήματος τάσης.
- **TEventHandler**: Καταγραφή γεγονότων συλλογής δεδομένων.
- **TErrorMessageHandler**: Διαχείριση σφαλμάτων και εξαιρέσεων.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`arduino_monitoring.php`](./arduino_monitoring.php): Περιλαμβάνει ανάγνωση αισθητήρων, επικύρωση, ανάλυση, καταγραφή και δημιουργία αναφοράς.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Σύνδεση Arduino με αισθητήρες θερμοκρασίας και υγρασίας στις αναλογικές εισόδους A0 και A1.
3. Πρόσβαση στη σειριακή θύρα (π.χ. `/dev/ttyACM0`) και σωστή ρύθμιση baud rate.
4. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/reports/arduino/`.
5. Η βιβλιοθήκη [phpBCL8](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Συνδέστε το Arduino και επιβεβαιώστε τη θύρα και τις ρυθμίσεις.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/iot/arduino/arduino_monitoring.php
   ```

## Παράδειγμα Χρήσης
```php
$arduinoHandler->setPinMode(0, FIRMATA_PIN_MODE_ANALOG); // Θερμοκρασία
$arduinoHandler->setPinMode(1, FIRMATA_PIN_MODE_ANALOG); // Υγρασία

$sensorData[] = ['temperature' => $arduinoHandler->analogRead(0), 'humidity' => $arduinoHandler->analogRead(1)];

$validationHandler->validate($sensorData[0], [
    'temperature' => 'required|numeric|min:0|max:1023',
    'humidity' => 'required|numeric|min:0|max:1023'
]);

$realData = $arduinoHandler->convertAnalogReadings($sensorData, 'DHT11');
$temps = array_column($realData, 'temperature');

$analysisHandler->clean();
$analysisHandler->setArray($temps, ['sensor', 'temperature']);
$meanTemp = $analysisHandler->mean();

$graphHandler->clean();
$graphHandler->setArray($temps, ['sensor', 'temperature']);
$graphHandler->createLineChart($graphHandler->getDeepProperty(['file', 'baseDir']) . '/temperature_trend.png');

```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί ένα αρχείο JSON με την ανάλυση και ένα γράφημα PNG. Παράδειγμα εξόδου:
```json
{
    "mean_temperature": 512.3,
    "data_points": 10
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `arduino_monitoring.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
