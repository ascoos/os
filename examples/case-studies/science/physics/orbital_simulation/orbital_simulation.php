<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @test OrbitalSimulation
 * 
 * @desc <English> Simulates a satellite in circular orbit around Earth. Calculates orbital velocity, kinetic energy, and potential energy. Results are visualized and saved in JSON.
 * @desc <Greek>   Προσομοιώνει έναν δορυφόρο σε κυκλική τροχιά γύρω από τη Γη. Υπολογίζει την τροχιακή ταχύτητα, την κινητική ενέργεια και τη δυναμική ενέργεια. Τα αποτελέσματα απεικονίζονται και αποθηκεύονται σε JSON.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

// <English> Import required Ascoos OS classes
// <Greek>   Εισαγωγή απαιτούμενων κλάσεων του Ascoos OS
use ASCOOS\OS\Kernel\Arrays\Physics\TPhysicsHandler;              // <English> Physics calculations
                                                                  // <Greek>   Υπολογισμοί φυσικής
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;            // <English> Graph generation
                                                                  // <Greek>   Δημιουργία γραφημάτων
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;                 // <English> Event logging
                                                                  // <Greek>   Καταγραφή συμβάντων
use ASCOOS\OS\Kernel\Core\Errors\Messages\TErrorMessageHandler;   // <English> Error handling
                                                                  // <Greek>   Διαχείριση σφαλμάτων

// <English> Define global paths for data and fonts
// <Greek>   Ορισμός καθολικών διαδρομών για δεδομένα και γραμματοσειρές
global $AOS_TMP_DATA_PATH, $AOS_FONTS_PATH;

// <English> Define configuration for file storage and chart rendering
// <Greek>   Ορισμός ρυθμίσεων για αποθήκευση αρχείων και δημιουργία γραφημάτων
$properties = [
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/reports/orbital_simulation'
    ],
    'LineChart' => [
        'width' => 800,
        'height' => 600,
        'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf',
        'backgroundColorIndex' => 1,
        'lineColorIndex' => 0,
        'axisColorIndex' => 0
    ]
];

// <English> Initialize handlers
// <Greek>   Αρχικοποίηση χειριστών
$physicsHandler = new TPhysicsHandler([], $properties);
$graphHandler   = new TArrayGraphHandler([], $properties['LineChart']);
$eventHandler   = new TEventHandler([], $properties);
$errorHandler   = new TErrorMessageHandler('el-GR', $properties);

try {
    // <English> Define physical parameters of the satellite
    // <Greek>   Ορισμός φυσικών παραμέτρων του δορυφόρου
    $satelliteMass = 1000.0;              // kg
    $earthMass = 5.972e24;                // kg
    $orbitalRadius = 6.792e6;             // m (Earth radius + 400 km)
    $gravitationalConstant = 6.67430e-11; // m³ kg⁻¹ s⁻²

    // <English> Calculate orbital velocity: v = √(GM / r)
    // <Greek>   Υπολογισμός τροχιακής ταχύτητας: v = √(GM / r)
    $orbitalVelocity = $physicsHandler->OrbitalVelocity($gravitationalConstant, $earthMass, $orbitalRadius);

    // <English> Calculate kinetic energy: K = ½ m v²
    // <Greek>   Υπολογισμός κινητικής ενέργειας: K = ½ m v²
    $kineticEnergy = $physicsHandler->KineticEnergy($satelliteMass, $orbitalVelocity);

    // <English> Calculate potential energy: U = -GMm / r
    // <Greek>   Υπολογισμός δυναμικής ενέργειας: U = -GMm / r
    $potentialEnergy = -$gravitationalConstant * $earthMass * $satelliteMass / $orbitalRadius;

    // <English> Generate chart with calculated values
    // <Greek>   Δημιουργία γραφήματος με τις υπολογισμένες τιμές
    $graphHandler->setArray([
        ['label' => 'Orbital Velocity (m/s)', 'value' => $orbitalVelocity],
        ['label' => 'Kinetic Energy (J)', 'value' => $kineticEnergy],
        ['label' => 'Potential Energy (J)', 'value' => $potentialEnergy]
    ], ['label', 'value']);
    $graphHandler->createLineChart($properties['file']['baseDir'] . '/orbital_simulation.png');

    // <English> Log completion event using TEventHandler
    // <Greek>   Καταγραφή συμβάντος ολοκλήρωσης με TEventHandler
    $eventHandler->register('orbital_simulation_completed', 'astrophysics', fn() =>
        $eventHandler->logger->log('Orbital simulation completed successfully', $eventHandler::DEBUG_LEVEL_INFO)
    );
    $eventHandler->trigger('orbital_simulation_completed', 'astrophysics');

    // <English> Save JSON report with all results
    // <Greek>   Αποθήκευση αναφοράς JSON με όλα τα αποτελέσματα
    $report = [
        'satellite_mass' => $satelliteMass,
        'earth_mass' => $earthMass,
        'orbital_radius' => $orbitalRadius,
        'gravitational_constant' => $gravitationalConstant,
        'orbital_velocity' => $orbitalVelocity,
        'kinetic_energy' => $kineticEnergy,
        'potential_energy' => $potentialEnergy
    ];
    file_put_contents(
        $properties['file']['baseDir'] . '/orbital_report.json',
        json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    // <English> Output summary to console
    // <Greek>   Εμφάνιση σύνοψης στην κονσόλα
    echo "Orbital Simulation Complete.\n";
    echo "Orbital Velocity: {$orbitalVelocity} m/s\n";
    echo "Kinetic Energy: {$kineticEnergy} J\n";
    echo "Potential Energy: {$potentialEnergy} J\n";

} catch (Exception $e) {
    // <English> Handle exceptions and log error
    // <Greek>   Διαχείριση εξαιρέσεων και καταγραφή σφάλματος
    $errorHandler->logError(1013, $e);
    echo $errorHandler->getMessage(1013);
}

// <English> Free all handlers
// <Greek>   Απελευθέρωση όλων των χειριστών
$physicsHandler->Free($physicsHandler);
$graphHandler->Free($graphHandler);
$eventHandler->Free($eventHandler);
$errorHandler->Free($errorHandler);
?>
