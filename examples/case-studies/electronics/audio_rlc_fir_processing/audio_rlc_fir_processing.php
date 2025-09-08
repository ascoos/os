<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Designs an RLC band-pass filter, applies a digital FIR filter to an audio signal, generates a SPICE netlist,
 *                and processes the audio with normalization, trimming, and fade effects. A frequency response graph is created.
 * @desc <Greek>   Σχεδιάζει ένα RLC ζωνοπερατό φίλτρο, εφαρμόζει ψηφιακό FIR φίλτρο σε σήμα ήχου, δημιουργεί SPICE netlist,
 *                και επεξεργάζεται τον ήχο με κανονικοποίηση, περικοπή και εφέ fade. Δημιουργείται γράφημα απόκρισης συχνότητας.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Extras\Science\Electronics\TElectronicsHandler;
use ASCOOS\OS\Extras\Science\Electronics\TCircuitHandler;
use ASCOOS\OS\Extras\Science\Electronics\TDigitalCircuitHandler;
use ASCOOS\OS\Extras\Sounds\TAudioHandler;
use ASCOOS\OS\Kernel\Validation\TValidationHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;
use ASCOOS\OS\Kernel\Core\Errors\Messages\TErrorMessageHandler;
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;

global $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH, $AOS_ESTR, $AOS_FONTS_PATH;

// <English> Initialize configuration for logging, data storage, audio, and graphing.
// <Greek> Αρχικοποίηση ρυθμίσεων για καταγραφή, αποθήκευση δεδομένων, ήχο και γραφήματα.
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir'       => $AOS_LOGS_PATH . '/',
        'file'      => 'audio_rlc_fir_processing.log'
    ],
    'file' => [
        'baseDir'   => $AOS_TMP_DATA_PATH . '/reports/audio_rlc_fir',
        'quotaSize' => 500000000 // 500MB quota
    ],
    'audio' => [
        'samplingFrequency' => 44100, // 44.1 kHz
        'inputFile'         => 'input_audio.wav',
        'outputFile'        => 'processed_audio.wav',
        'trimStart'         => 1.0, // Start trimming at 1 second
        'trimEnd'           => 9.0  // End trimming at 9 seconds
    ],
    'LineChart' => [
        'width' => 800, 
        'height' => 600,
        'showAxes' => true,
        'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf',
        'backgroundColorIndex' => 1, // White
        'lineColorIndex' => 0, // Black
        'axisColorIndex' => 0  // Black
    ]
];

// <English> Initialize handlers for electronics, circuits, digital processing, audio, validation, events, and error handling.
// <Greek> Αρχικοποίηση χειριστών για ηλεκτρονικά, κυκλώματα, ψηφιακή επεξεργασία, ήχο, επικύρωση, συμβάντα και διαχείριση σφαλμάτων.
$electronicsHandler = new TElectronicsHandler([], $properties);
$circuitHandler     = new TCircuitHandler([], $properties);
$digitalHandler     = new TDigitalCircuitHandler([], $properties);
$audioHandler       = new TAudioHandler([], $properties);
$validationHandler  = new TValidationHandler($properties);
$eventHandler       = new TEventHandler([], $properties);
$errorHandler       = new TErrorMessageHandler('el-GR', $properties);
$graphHandler       = new TArrayGraphHandler([], $properties['LineChart']);

try {
    // <English> Step 1: Design an RLC band-pass filter for audio frequencies (300 Hz to 3 kHz).
    // <Greek> Βήμα 1: Σχεδιασμός RLC ζωνοπερατού φίλτρου για συχνότητες ήχου (300 Hz έως 3 kHz).
    $centerFrequency = 1000; // Hz
    $resistance = 1000; // 1 kΩ
    $inductance = 0.1; // 100 mH
    $capacitance = 1 / (4 * pi() * pi() * $inductance * $centerFrequency * $centerFrequency); // C = 1/(4π²f₀²L)
    $bandpassGain = $electronicsHandler->bandpassFilterGain($centerFrequency, $resistance, $inductance, $capacitance);

    // <English> Validate RLC parameters.
    // <Greek> Επικύρωση παραμέτρων RLC.
    $rlcRules = [
        'resistance'  => 'required|numeric|min:0',
        'inductance'  => 'required|numeric|min:0',
        'capacitance' => 'required|numeric бокасо|min:0'
    ];
    $rlcData = [
        'resistance'  => $resistance,
        'inductance'  => $inductance,
        'capacitance' => $capacitance
    ];
    if (!$validationHandler->validate($rlcData, $rlcRules)) {
        $errs = $validationHandler->getErrors();
        $errorHandler->logError(E_ASCOOS_INVALID_VALIDATION, new Exception(implode(', ', $errs)));
        echo $errorHandler->getMessage(E_ASCOOS_INVALID_VALIDATION);
        exit;
    }

    // <English> Step 2: Generate SPICE netlist for the RLC filter.
    // <Greek> Βήμα 2: Δημιουργία SPICE netlist για το RLC φίλτρο.
    $components = [
        ['type' => 'resistor', 'name' => 'R1', 'value' => $resistance, 'node1' => 'in', 'node2' => 'n1'],
        ['type' => 'inductor', 'name' => 'L1', 'value' => $inductance, 'node1' => 'n1', 'node2' => 'out'],
        ['type' => 'capacitor', 'name' => 'C1', 'value' => $capacitance, 'node1' => 'out', 'node2' => 'gnd']
    ];
    $netlist = $circuitHandler->generateSpiceNetlist($components);
    file_put_contents($properties['file']['baseDir'] . '/rlc_filter.sp', $netlist);

    // <English> Step 3: Read and process audio signal with an FIR filter.
    // <Greek> Βήμα 3: Ανάγνωση και επεξεργασία σήματος ήχου με FIR φίλτρο.
    $firCoefficients = [0.25, 0.5, 0.25]; // Simple 3-tap FIR filter
    $signal = $audioHandler->readWavFile($properties['audio']['inputFile']);
    $filteredSignal = $digitalHandler->applyFIRFilter($firCoefficients, $signal);

    // <English> Step 4: Analyze frequency response of the FIR filter.
    // <Greek> Βήμα 4: Ανάλυση απόκρισης συχνότητας του FIR φίλτρου.
    $freqResponse = $digitalHandler->frequencyResponse($firCoefficients, 512);

    $graphHandler->setArray(array_map('abs', $freqResponse), ['frequency', 'magnitude']);
    $graphHandler->createLineChart($properties['file']['baseDir'] . '/fir_frequency_response.png');

    // <English> Step 5: Trim, apply fade, and normalize the signal.
    // <Greek> Βήμα 5: Περικοπή, εφαρμογή εφέ fade και κανονικοποίηση του σήματος.
    $trimmedSignal = $audioHandler->trimSignal(
        $filteredSignal,
        $properties['audio']['trimStart'],
        $properties['audio']['trimEnd'],
        $properties['audio']['samplingFrequency']
    );
    $fadeSamples = (int)($properties['audio']['samplingFrequency'] * 0.5); // 0.5 seconds fade
    $signalWithFade = $audioHandler->fadeIn($trimmedSignal, $fadeSamples);
    $signalWithFade = $audioHandler->fadeOut($signalWithFade, $fadeSamples);
    $normalizedSignal = $audioHandler->normalizeSignal($signalWithFade, 0.9);
    $audioHandler->writeWavFile($normalizedSignal, $properties['audio']['samplingFrequency'], $properties['audio']['outputFile']);

    // <English> Step 6: Log successful processing event.
    // <Greek> Βήμα 6: Καταγραφή επιτυχούς συμβάντος επεξεργασίας.
    $eventHandler->register('signal_processed', 'audio', fn() =>
        $eventHandler->logger->log('Audio signal processed successfully with RLC and FIR filters', $eventHandler::DEBUG_LEVEL_INFO)
    );
    $eventHandler->trigger('signal_processed', 'audio');

    // <English> Step 7: Save JSON report with filter parameters and signal stats.
    // <Greek> Βήμα 7: Αποθήκευση JSON αναφοράς με παραμέτρους φίλτρου και στατιστικά σήματος.
    $report = [
        'rlc_filter' => [
            'center_frequency' => $centerFrequency,
            'resistance' => $resistance,
            'inductance' => $inductance,
            'capacitance' => $capacitance,
            'gain_at_center' => $bandpassGain
        ],
        'fir_filter' => [
            'coefficients' => $firCoefficients
        ],
        'signal_stats' => [
            'samples' => count($normalizedSignal),
            'duration' => $audioHandler->getDuration($normalizedSignal, $properties['audio']['samplingFrequency'])
        ]
    ];
    file_put_contents(
        $properties['file']['baseDir'] . '/audio_rlc_fir_report.json',
        json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    // <English> Output completion message.
    // <Greek> Εμφάνιση μηνύματος ολοκλήρωσης.
    echo "Audio processing with RLC and FIR filters completed. Report and netlist saved.\n";

} catch (Exception $e) {
    // <English> Handle exceptions and log error.
    // <Greek> Διαχείριση εξαιρέσεων και καταγραφή σφάλματος.
    $errorHandler->logError(1007, $e);
    echo $errorHandler->getMessage(1007);
}

// <English> Cleanup resources (free handlers).
// <Greek> Απελευθέρωση πόρων (εκκαθάριση χειριστών).
$electronicsHandler->Free($electronicsHandler);
$circuitHandler->Free($circuitHandler);
$digitalHandler->Free($digitalHandler);
$audioHandler->Free($audioHandler);
$validationHandler->Free($validationHandler);
$eventHandler->Free($eventHandler);
$errorHandler->Free($errorHandler);
$graphHandler->Free($graphHandler);
?>