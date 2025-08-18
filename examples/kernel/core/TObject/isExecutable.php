<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates the use of the isExecutable method to check if the current class version is executable based on Ascoos CMS and PHP versions.
 * @desc <Greek> Παρουσιάζει τη χρήση της μεθόδου isExecutable για τον έλεγχο αν η τρέχουσα έκδοση της κλάσης είναι εκτελέσιμη με βάση τις εκδόσεις του Ascoos CMS και της PHP.
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
    'version' => 260000,
    'logs' => [
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'test.log'
    ]
];

// <English> Create a new TObject instance with properties
// <Greek> Δημιουργία νέου instance της TObject με ιδιότητες
$object = new TObject($properties);

// <English> Check if the class is executable for Ascoos CMS version 26000 and PHP version 80200
// <Greek> Έλεγχος αν η κλάση είναι εκτελέσιμη για την έκδοση 26000 του Ascoos CMS και την έκδοση 80200 της PHP
$isExecutable = $object->isExecutable(260000, 80200);
// <English> Output the result
// <Greek> Εμφάνιση του αποτελέσματος
echo $isExecutable ? "Class is executable\n" : "Class is not executable\n"; // Outputs: Class is executable

// <English> Check with an incompatible version
// <Greek> Έλεγχος με μια μη συμβατή έκδοση
$isExecutable = $object->isExecutable(250000, 70200);
// <English> Output the result
// <Greek> Εμφάνιση του αποτελέσματος
echo $isExecutable ? "Class is executable\n" : "Class is not executable\n"; // Outputs: Class is not executable

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>