# Σχεδιασμός και Επεξεργασία Σήματος με RLC Band-Pass Φίλτρο και Ψηφιακό FIR Φίλτρο

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να χρησιμοποιηθεί για το σχεδιασμό ενός αναλογικού RLC ζωνοπερατού φίλτρου, την εφαρμογή ψηφιακού FIR φίλτρου σε σήμα ήχου, τη δημιουργία SPICE netlist για προσομοίωση, και την επεξεργασία ήχου με περικοπή, κανονικοποίηση και εφέ fade. Επιπλέον, παράγεται γράφημα απόκρισης συχνότητας.

## Σκοπός
Το παράδειγμα αξιοποιεί τις παρακάτω κλάσεις του Ascoos OS:
- **TElectronicsHandler**: Υπολογισμός παραμέτρων RLC φίλτρου και σύνθετης αντίστασης.
- **TCircuitHandler**: Δημιουργία SPICE netlist για προσομοίωση.
- **TDigitalCircuitHandler**: Σχεδιασμός FIR φίλτρου και ανάλυση απόκρισης συχνότητας.
- **TAudioHandler**: Επεξεργασία ήχου (περικοπή, κανονικοποίηση, fade-in/out).
- **TValidationHandler**: Επικύρωση παραμέτρων φίλτρου.
- **TEventHandler**: Καταγραφή συμβάντων επεξεργασίας.
- **TErrorMessageHandler**: Διαχείριση σφαλμάτων και εξαιρέσεων.
- **TArrayGraphHandler**: Δημιουργία γραφημάτων απόκρισης συχνότητας.

## Δομή
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`audio_rlc_fir_processing.php`](./audio_rlc_fir_processing.php): Περιλαμβάνει σχεδιασμό RLC φίλτρου, ψηφιακή επεξεργασία ήχου, ανάλυση, και δημιουργία αναφοράς.

## Προαπαιτούμενα
1. Εγκατάσταση του Ascoos OS ([κύριο repository](https://github.com/ascoos/os)).
2. Πρόσβαση σε αρχείο WAV ήχου (π.χ., `input_audio.wav`) στο `$AOS_TMP_DATA_PATH`.
3. Δικαιώματα εγγραφής στους φακέλους `$AOS_LOGS_PATH` και `$AOS_TMP_DATA_PATH/reports/audio_rlc_fir/`.
4. Εγκατεστημένη γραμματοσειρά (π.χ., Murecho) για γραφήματα.

## Ξεκινώντας
1. Τοποθετήστε ένα αρχείο WAV στο `$AOS_TMP_DATA_PATH`.
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/electronics/audio_rlc_fir_processing/audio_rlc_fir_processing.php
   ```

## Παράδειγμα Χρήσης
```php
$electronicsHandler = new TElectronicsHandler();
$centerFrequency = 1000; // Hz
$resistance = 1000; // 1 kΩ
$inductance = 0.1; // 100 mH
$capacitance = 1 / (4 * pi() * pi() * $inductance * $centerFrequency * $centerFrequency);
$bandpassGain = $electronicsHandler->bandpassFilterGain($centerFrequency, $resistance, $inductance, $capacitance);

$digitalHandler = new TDigitalCircuitHandler();
$firCoefficients = [0.25, 0.5, 0.25];
$signal = $audioHandler->readWavFile("input_audio.wav");
$filteredSignal = $digitalHandler->applyFIRFilter($firCoefficients, $signal);

$audioHandler = new TAudioHandler();
$trimmedSignal = $audioHandler->trimSignal($filteredSignal, 1.0, 9.0, 44100);
$signalWithFade = $audioHandler->fadeIn($trimmedSignal, 44100 * 0.5);
$signalWithFade = $audioHandler->fadeOut($signalWithFade, 44100 * 0.5);
$normalizedSignal = $audioHandler->normalizeSignal($signalWithFade, 0.9);
$audioHandler->writeWavFile($normalizedSignal, 44100, "processed_audio.wav");
```

## Αναμενόμενο Αποτέλεσμα
Το script δημιουργεί:
- Ένα SPICE netlist αρχείο (`rlc_filter.sp`).
- Ένα γράφημα απόκρισης συχνότητας του FIR φίλτρου (`fir_frequency_response.png`).
- Ένα επεξεργασμένο αρχείο WAV (`processed_audio.wav`).
- Ένα JSON αρχείο αναφοράς (`audio_rlc_fir_report.json`):
```json
{
    "rlc_filter": {
        "center_frequency": 1000,
        "resistance": 1000,
        "inductance": 0.1,
        "capacitance": 2.533e-5,
        "gain_at_center": 0.707
    },
    "fir_filter": {
        "coefficients": [0.25, 0.5, 0.25]
    },
    "signal_stats": {
        "samples": 352800,
        "duration": 8
    }
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, τροποποιήστε ή προσθέστε νέες λειτουργίες στο `audio_rlc_fir_processing.php`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
