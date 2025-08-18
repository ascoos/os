<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates unlocking object properties using the unlockProperties method.
 * @desc <Greek> Παρουσιάζει το ξεκλείδωμα των ιδιοτήτων του αντικειμένου χρησιμοποιώντας τη μέθοδο unlockProperties.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Core\TObject;

// <English> Define a custom class to handle locked properties
// <Greek> Ορισμός μιας προσαρμοσμένης κλάσης για τη διαχείριση κλειδωμένων ιδιοτήτων
class CustomObject extends TObject {
    public function __construct(array $properties = []) {
        parent::__construct($properties);
    }
}

// <English> Initialize properties array with configuration
// <Greek> Αρχικοποίηση πίνακα ιδιοτήτων με διαμόρφωση
$properties = [
    'name' => 'TestObject',
    'version' => 260000
];

// <English> Create a new CustomObject instance with properties
// <Greek> Δημιουργία νέου instance της CustomObject με ιδιότητες
$object = new CustomObject($properties);

// <English> Set a property before locking
// <Greek> Εισαγωγή ιδιότητας πριν το κλείδωμα
$object->setProperty('author', 'Lead Developer');

// <English> Lock the properties
// <Greek> Κλείδωμα των ιδιοτήτων
$locked = $object->lockProperties();
// <English> Output locking result
// <Greek> Εμφάνιση αποτελέσματος κλειδώματος
echo $locked ? "Properties locked\n" : "Failed to lock properties\n"; // Outputs: Properties locked

// <English> Attempt to set a property after locking
// <Greek> Προσπάθεια εισαγωγής ιδιότητας μετά το κλείδωμα
$object->setProperty('author', 'Other Developer');
// <English> Output properties to verify no change
// <Greek> Εμφάνιση ιδιοτήτων για επαλήθευση ότι δεν έγινε αλλαγή
echo $object->getProperty('author'); // Outputs: Lead Developer

// <English> Unlock the properties
// <Greek> Ξεκλείδωμα των ιδιοτήτων
$locked = $object->unlockProperties();
// <English> Output unlocking result
// <Greek> Εμφάνιση αποτελέσματος ξεκλειδώματος
echo $locked ? "Properties unlocked\n" : "Failed to unlock properties\n"; // Outputs: Properties unlocked

// <English> Attempt to set a property after unlocking
// <Greek> Προσπάθεια εισαγωγής ιδιότητας μετά το ξεκλείδωμα
$object->setProperty('author', 'Other Developer');
// <English> Output properties to verify change
// <Greek> Εμφάνιση ιδιοτήτων για επαλήθευση ότι έγινε αλλαγή
echo $object->getProperty('author'); // Outputs: Other Developer

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>