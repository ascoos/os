<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> A system that uses an Arduino to monitor environmental sensors
 *                (e.g., temperature, humidity), validates raw ADC data,
 *                converts to real °C/%RH, logs events using the built-in logger,
 *                and generates visual reports.
 * @desc <Greek>    Ένα σύστημα που χρησιμοποιεί Arduino για την παρακολούθηση
 *                περιβαλλοντικών αισθητήρων (π.χ. θερμοκρασία, υγρασία),
 *                επικυρώνει raw ADC δεδομένα, μετατρέπει σε πραγματικές
 *                τιμές °C/%RH, καταγράφει συμβάντα με τον ενσωματωμένο logger
 *                και παράγει οπτικές αναφορές.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Extras\Hardware\Arduino\TArduinoHandler;
use ASCOOS\OS\Kernel\Validation\TValidationHandler;
use ASCOOS\OS\Extras\Arrays\Analysis\TArrayAnalysisHandler;
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;
use ASCOOS\OS\Kernel\Core\Errors\Messages\TErrorMessageHandler;

global $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH, $AOS_ESTR, $AOS_FONTS_PATH;

// <English> Initialize configuration for logging and data storage.
// <Greek> Αρχικοποίηση ρυθμίσεων για καταγραφή και αποθήκευση δεδομένων.
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir'       => $AOS_LOGS_PATH . '/',
        'file'      => 'arduino_monitoring.log'
    ],
    'file' => [
        'baseDir'   => $AOS_TMP_DATA_PATH . '/reports/arduino',
        'quotaSize' => 500000000 // 500MB quota
    ],
    'arduino' => [
        'port' => '/dev/ttyACM0',
        'baud' => 9600
    ],
    'LineChart' => [
        'width' => 800, 
        'height' => 600,
        'showAxes' => true, // Display axes
        'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf', // Path to the font file
        'backgroundColorIndex' => 1, // 0=Black, 1=White, 2=Red, 3=Green, 4=Blue, 5=Yellow, 6=Cyan, 7=Magenta, 8=Maroon, 9=Dark Green, 10=Navy, 11=Olive, 12=Purple, 13=Teal, 14=Orange, 15=Pink, 16=Indigo, 17=Deep Pink
        'lineColorIndex' => 0, // Color index for the line
        'axisColorIndex' => 0  // Color index for the axes
    ]
];

// <English> Initialize handlers for Arduino, validation, analysis, graphing, events, and error handling.
// <Greek> Αρχικοποίηση χειριστών για Arduino, επικύρωση, ανάλυση, γραφήματα, συμβάντα και διαχείριση σφαλμάτων.
$arduinoHandler    = new TArduinoHandler($properties['arduino']['port'], ['baud' => $properties['arduino']['baud']]);
$validationHandler = new TValidationHandler($properties);
$analysisHandler   = new TArrayAnalysisHandler([], $properties);
$graphHandler      = new TArrayGraphHandler([], $properties['LineChart']);
$eventHandler      = new TEventHandler([], $properties);
$errorHandler      = new TErrorMessageHandler('el-GR', $properties);

try {
    // <English> Configure and open the Arduino connection.
    // <Greek>   Ρύθμιση και άνοιγμα της σύνδεσης Arduino.
    $arduinoHandler->configure();
    $arduinoHandler->open();
    if (!$arduinoHandler->isOpen()) {
        // <English> Multilingual error messages and logs.
        // <Greek>   Πολύγλωσσα μηνύματα σφαλμάτων και καταγραφών.
        $errorHandler->logError(E_ASCOOS_HW_ARDUINO_FAILED_OPEN_CONNECTION, new Exception($AOS_ESTR[E_ASCOOS_HW_ARDUINO_FAILED_OPEN_CONNECTION]));
        echo $errorHandler->getMessage(E_ASCOOS_HW_ARDUINO_FAILED_OPEN_CONNECTION);
        exit;
    }

    // <English> Set analog mode for pins A0 (temperature) and A1 (humidity).
    // <Greek>   Ορισμός λειτουργίας αναλογικών pins A0 (θερμοκρασία) και A1 (υγρασία).
    $arduinoHandler->setPinMode(0, FIRMATA_PIN_MODE_ANALOG); // Temperature sensor on A0
    $arduinoHandler->setPinMode(1, FIRMATA_PIN_MODE_ANALOG); // Humidity sensor on A1

    // <English> Read 10 samples of raw ADC values.
    // <Greek>   Ανάγνωση 10 δειγμάτων raw ADC τιμών.
    $rawData = [];
    for ($i = 0; $i < 10; $i++) {
        $rawT = $arduinoHandler->analogRead(0);
        $rawH = $arduinoHandler->analogRead(1);
        $rawData[] = ['temperature' => $rawT, 'humidity' => $rawH];
        usleep(2000000); // Wait 2 seconds between readings
    }

    // <English> Validate that raw ADC values are within 0–1023.
    // <Greek>   Επικύρωση ότι οι raw ADC τιμές βρίσκονται εντός 0–1023.
    $rawRules = [
        'temperature' => 'required|numeric|min:0|max:1023',
        'humidity'    => 'required|numeric|min:0|max:1023'
    ];
    foreach ($rawData as $row) {
        if (!$validationHandler->validate($row, $rawRules)) {
            $errs = $validationHandler->getErrors();
            $errorHandler->logError(E_ASCOOS_INVALID_VALIDATION, new Exception(implode(', ', $errs)));
            echo $errorHandler->getMessage(E_ASCOOS_INVALID_VALIDATION);
            exit;
        }
    }

    // <English> Convert raw ADC readings to real °C and %RH for chosen sensor type.
    // <Greek>   Μετατροπή raw ADC σε πραγματικές τιμές °C και %RH για επιλεγμένο αισθητήρα.
    $realData = $arduinoHandler->convertAnalogReadings($rawData, 'DHT11');

    // <English> Extract temperatures for analysis.
    // <Greek>   Εξαγωγή θερμοκρασιών για ανάλυση.
    $temps = array_column($realData, 'temperature');

    // <English> Calculate mean temperature.
    // <Greek>   Υπολογισμός μέσης θερμοκρασίας.
    $analysisHandler->clean();
    $analysisHandler->setArray($temps, ['sensor', 'temperature']);
    $meanTemp = $analysisHandler->mean();

    // <English> Create temperature trend line chart.
    // <Greek>   Δημιουργία γραμμικού διαγράμματος τάσης θερμοκρασίας.
    $graphHandler->clean();
    $graphHandler->setArray($temps, ['sensor', 'temperature']);
    $graphHandler->createLineChart($properties['file']['baseDir'] . '/temperature_trend.png');

    // <English> Log successful data collection event.
    // <Greek>   Καταγραφή επιτυχούς συμβάντος συλλογής δεδομένων.
    $eventHandler->register('data_collected', 'arduino', fn() =>
        $eventHandler->logger->log('Environmental data collected successfully', $eventHandler::DEBUG_LEVEL_INFO)
    );
    $eventHandler->trigger('data_collected', 'arduino');

    // <English> Save JSON report with mean temperature and data count.
    // <Greek>   Αποθήκευση JSON αναφοράς με μέση θερμοκρασία και πλήθος δειγμάτων.
    $report = [
        'mean_temperature' => $meanTemp,
        'data_points'      => count($realData)
    ];
    file_put_contents(
        $properties['file']['baseDir'] . '/arduino_report.json',
        json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    // <English> Output completion message.
    // <Greek>   Εμφάνιση μηνύματος ολοκλήρωσης.
    echo "Arduino monitoring completed. Mean temperature: {$meanTemp}°C\n";

} catch (Exception $e) {
    // <English> Handle exceptions and log error.
    // <Greek>   Διαχείριση εξαιρέσεων και καταγραφή σφάλματος.
    $errorHandler->logError(1007, $e);
    echo $errorHandler->getMessage(1007);
}

// <English> Cleanup resources (close connection, free handlers).
// <Greek>   Απελευθέρωση πόρων (κλείσιμο σύνδεσης, εκκαθάριση χειριστών).
$arduinoHandler->close();
$arduinoHandler->Free($arduinoHandler);
$validationHandler->Free($validationHandler);
$analysisHandler->Free($analysisHandler);
$graphHandler->Free($graphHandler);
$eventHandler->Free($eventHandler);
$errorHandler->Free($errorHandler);
?>
