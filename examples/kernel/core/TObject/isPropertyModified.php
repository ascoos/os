<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates checking if a property has been modified using the isPropertyModified method.
 * @desc <Greek> Παρουσιάζει τον έλεγχο αν μια ιδιότητα έχει τροποποιηθεί χρησιμοποιώντας τη μέθοδο isPropertyModified.
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

// <English> Enable property change tracking
// <Greek> Ενεργοποίηση παρακολούθησης αλλαγών ιδιοτήτων
$object->trackPropertyChanges(true);

// <English> Update a property
// <Greek> Ενημέρωση ιδιότητας
$object->setProperty('name', 'UpdatedObject');

// <English> Check if property was modified
// <Greek> Έλεγχος αν η ιδιότητα τροποποιήθηκε
$isModified = $object->isPropertyModified('name');
// <English> Output result
// <Greek> Εμφάνιση αποτελέσματος
echo $isModified ? "Property 'name' was modified\n" : "Property 'name' was not modified\n"; // Outputs: Property 'name' was modified

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>