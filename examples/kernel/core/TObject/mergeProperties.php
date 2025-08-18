<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates merging properties with different strategies using the mergeProperties method.
 * @desc <Greek> Παρουσιάζει τη συγχώνευση ιδιοτήτων με διαφορετικές στρατηγικές χρησιμοποιώντας τη μέθοδο mergeProperties.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Core\TObject;

// <English> Declare global AOS_LOGS_PATH for log directory
// <Greek> Δηλώνει τη global μεταβλητή AOS_LOGS_PATH για τον κατάλογο καταγραφής
global $AOS_LOGS_PATH;

// <English> Initialize properties array with configuration
// <Greek> Αρχικοποίηση πίνακα ιδιοτήτων με διαμόρφωση
$properties = [
    'name' => 'TestObject',
    'config' => ['host' => 'localhost']
];

// <English> Create a new TObject instance with properties
// <Greek> Δημιουργία νέου instance της TObject με ιδιότητες
$object = new TObject($properties);

// <English> Define new properties to merge
// <Greek> Ορισμός νέων ιδιοτήτων για συγχώνευση
$newProperties = [
    'config' => ['port' => 3306],
    'version' => 260000
];

// <English> Merge properties with 'merge' strategy
// <Greek> Συγχώνευση ιδιοτήτων με τη στρατηγική 'merge'
$object->mergeProperties($newProperties, 'merge');

// <English> Output merged properties
// <Greek> Εμφάνιση συγχωνευμένων ιδιοτήτων
print_r($object->getProperties()); // Outputs: ['name' => 'TestObject', 'config' => ['host' => 'localhost', 'port' => 3306], 'version' => 260000]

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>