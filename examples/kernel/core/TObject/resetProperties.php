<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates resetting object properties using the resetProperties method.
 * @desc <Greek> Παρουσιάζει την επαναφορά ιδιοτήτων αντικειμένου χρησιμοποιώντας τη μέθοδο resetProperties.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Core\TObject;

// <English> Initialize properties array with configuration
// <Greek> Αρχικοποίηση πίνακα ιδιοτήτων με διαμόρφωση
$initialProperties = [
    'name' => 'TestObject',
    'version' => 260000
];

// <English> Create a new TObject instance
// <Greek> Δημιουργία νέου instance της TObject
$object = new TObject($initialProperties);

// <English> Update properties
// <Greek> Ενημέρωση ιδιοτήτων
$object->setProperty('name', 'UpdatedObject');
$object->setProperty('version', 260001);

// <English> Reset properties to initial state
// <Greek> Επαναφορά ιδιοτήτων στην αρχική κατάσταση
$success = $object->resetProperties($initialProperties);
// <English> Output reset result
// <Greek> Εμφάνιση αποτελέσματος επαναφοράς
echo $success ? "Properties reset successfully\n" : "Failed to reset properties\n"; // Outputs: Properties reset successfully

// <English> Output current properties
// <Greek> Εμφάνιση τρεχουσών ιδιοτήτων
print_r($object->getProperties()); // Outputs: ['name' => 'TestObject', 'version' => 260000]

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>