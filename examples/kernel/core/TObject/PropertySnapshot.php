<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates creation, comparison, and retrieval of a snapshot of properties.
 * @desc <Greek> Παρουσιάζει τη δημιουργία, σύγκριση και ανάκτηση ενός στιγμιοτύπου ιδιοτήτων.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Core\TObject;

// <English> Initialize properties array with configuration
// <Greek> Αρχικοποίηση πίνακα ιδιοτήτων με διαμόρφωση
$properties = [
    'name' => 'TestObject',
    'version' => 260000
];

// <English> Create a new TObject instance
// <Greek> Δημιουργία νέου instance της TObject
$object = new TObject($properties);

// <English> Create a snapshot of current properties
// <Greek> Δημιουργία στιγμιοτύπου των τρεχουσών ιδιοτήτων
$object->setPropertySnapshot('initial');

// <English> Update properties
// <Greek> Ενημέρωση ιδιοτήτων
$object->setProperty('name', 'UpdatedObject');
$object->setProperty('version', 260001);

// <English> Output current properties
// <Greek> Εμφάνιση τρεχουσών ιδιοτήτων
print_r($object->getProperties()); // Outputs: ['name' => 'UpdatedObject', 'version' => '260001', ...]

// <English> Output snapshot
// <Greek> Εμφάνιση στιγμιοτύπου
print_r($object->getPropertySnapshot('initial')); // Outputs: ['name' => 'TestObject', 'version' => 260000, ...]

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>