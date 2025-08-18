<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates locking object properties using the lockProperties method.
 * @desc <Greek> Παρουσιάζει το κλείδωμα των ιδιοτήτων του αντικειμένου χρησιμοποιώντας τη μέθοδο lockProperties.
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

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>