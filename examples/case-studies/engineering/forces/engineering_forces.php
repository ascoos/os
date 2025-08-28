<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 *
 * @desc <English> Calculate forces in mechanical structures and store results.
 *       <Greek> Υπολογισμός δυνάμεων σε μηχανικές κατασκευές και αποθήκευση αποτελεσμάτων.
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Maths\TMathsHandler,
    Files\TFilesHandler,
    Arrays\Events\TEventHandler,
    Systems\TCoreSystemHandler
};

global $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

// <English> Initialize configuration
// <Greek> Αρχικοποίηση διαμόρφωσης
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH. '/',
        'file' => 'engineering_forces.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/ascoos_data/engineering/',
        'quotaSize' => 1000000000 // 1GB quota
    ]
];

// <English> Initialize ASCOOS classes
// <Greek> Αρχικοποίηση κλάσεων ASCOOS
$system = new TCoreSystemHandler($properties);
$maths = new TMathsHandler();
$files = new TFilesHandler([], $properties['file']);
$eventHandler = new TEventHandler([], $properties);

// <English> Register event for force calculation
// <Greek> Καταχώριση γεγονότος για υπολογισμό δυνάμεων
$eventHandler->register('structure', 'calculated', function ($force) use ($system) {
    $system->logger?->log(
        "Force calculated: $force N",
        $system::DEBUG_LEVEL_INFO
    );
});

// <English> Calculate force using Newton's Second Law (F = m * a)
// <Greek> Υπολογισμός δύναμης με τον Δεύτερο Νόμο του Νεύτωνα (F = m * a)
$mass = 100.0; // kg
$acceleration = 9.81; // m/s^2 (gravity)
$force = $maths->power($mass * $acceleration, 1); // F = m * a

// <English> Save force calculation results
// <Greek> Αποθήκευση αποτελεσμάτων υπολογισμού δύναμης
$folder = $properties['file']['baseDir'] . 'structure_001/';
$files->createFolder($folder);
$forceFile = "$folder/force.json";
$report = [
    'structure_id' => 'STR001',
    'force' => $force,
    'timestamp' => date('c')
];
$files->writeToFileWithCheck(json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $forceFile);

// <English> Trigger force calculation event
// <Greek> Ενεργοποίηση γεγονότος υπολογισμού δύναμης
$eventHandler->trigger('structure', 'calculated', $force);

// <English> Check quota
// <Greek> Έλεγχος quota
if ($files->isQuotaExceeded($folder)) {
    $system->logger?->log(
        "Quota exceeded for structure 001",
        $system::DEBUG_LEVEL_WARNING
    );
}

// <English> Log high CPU load
// <Greek> Καταγραφή υψηλού φόρτου CPU
if ($system->get_cpu_load(0) > 80) {
    $system->logger?->log(
        "High CPU load during force calculation: {$system->get_cpu_load(0)}%",
        $system::DEBUG_LEVEL_WARNING
    );
}

// <English> Output result
// <Greek> Εκτύπωση αποτελέσματος
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$files->Free($files);
$system->Free($system);
$eventHandler->Free($eventHandler);
?>