# Συνδυασμός Γεωγραφικών και Μετεωρολογικών Δεδομένων

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για τη δημιουργία μικροεφαρμογών που συνδυάζουν δεδομένα γεωγραφικής τοποθεσίας και μετεωρολογικής πρόβλεψης. Το παράδειγμα αξιοποιεί APIs, επικύρωση δεδομένων, καταγραφή γεγονότων και ασφαλή αποθήκευση.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TGoogleMapsHandler**: Ανάκτηση γεωγραφικών δεδομένων μέσω Google Maps API.
- **TOpenWeatherMapHandler**: Λήψη μετεωρολογικών δεδομένων μέσω OpenWeatherMap API.
- **TXValidationHandler**: Επικύρωση των δεδομένων που επιστρέφουν τα APIs.
- **TFilesHandler**: Αποθήκευση και κρυπτογράφηση των συνδυασμένων δεδομένων.
- **TEventHandler**: Καταγραφή γεγονότων επικύρωσης και αποθήκευσης.
- **TDatesHandler**: Διαχείριση χρονικών στιγμών και μορφοποίησης ημερομηνιών.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`microapp_geo_weather.php`](./microapp_geo_weather.php): Περιλαμβάνει λήψη δεδομένων, επικύρωση, αποθήκευση και καταγραφή.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), είναι ήδη προεγκατεστημένο.
2. Έγκυρα API keys για Google Maps και OpenWeatherMap.
3. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/microapp_data/`.
4. Οι μεταβλητές `$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH` ρυθμίζονται αυτόματα από το Ascoos OS.
5. Η βιβλιοθήκη [`phpBCL8`](https://github.com/ascoos/phpbcl8) είναι προεγκατεστημένη και φορτώνεται αυτόματα.

## Ξεκινώντας
1. Ρυθμίστε τα API keys στο αρχείο.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/location/weather/microapp_geo_weather.php
   ```

## Παράδειγμα Χρήσης
```php
$geoResponse = $googleMapsHandler->geocode(['address' => 'Athens, Greece', 'key' => $apiKey]);
$weatherResponse = $weatherHandler->getWeather([
    'lat' => $geoData['lat'],
    'lon' => $geoData['lng'],
    'appid' => $weatherApiKey
]);
$filesHandler->encryptFile($rawFile, $encryptedFile, 'Hi! I\'m Ascoos OS');
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί ένα κρυπτογραφημένο αρχείο JSON με γεωγραφικά και μετεωρολογικά δεδομένα. Παράδειγμα εξόδου:
```json
{
  "location": {
    "address": "Athens, Greece",
    "coordinates": {
      "lat": 37.9838,
      "lng": 23.7275
    }
  },
  "weather": {
    "temp": 29.5,
    "weather": "clear sky",
    "timestamp": "2025-08-28 18:45:00"
  },
  "processed_at": "2025-08-28 18:49:00"
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `microapp_geo_weather.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
