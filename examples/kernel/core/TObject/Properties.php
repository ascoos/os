<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates the initialization of a TObject instance, setting and retrieving properties, and converting the object to a string.
 * @desc <Greek> Παρουσιάζει την αρχικοποίηση ενός instance της TObject, την εισαγωγή και ανάκτηση ιδιοτήτων, και τη μετατροπή του αντικειμένου σε συμβολοσειρά.
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

// <English> Convert object to string using __toString
// <Greek> Μετατροπή του αντικειμένου σε συμβολοσειρά με τη __toString
echo $object->__toString(); // Outputs: TObject

// <English> Set a single property
// <Greek> Εισαγωγή μιας μεμονωμένης ιδιότητας
$object->setProperty('author', 'Lead Developer');

// <English> Retrieve a single property
// <Greek> Ανάκτηση μιας μεμονωμένης ιδιότητας
$author = $object->getProperty('author');
// <English> Output the retrieved property
// <Greek> Εμφάνιση της ανακτημένης ιδιότητας
echo $author; // Outputs: Lead Developer

// <English> Set multiple properties
// <Greek> Εισαγωγή πολλαπλών ιδιοτήτων
$object->setProperties(['config' => ['host' => 'localhost', 'port' => 3306]]);

// <English> Retrieve all properties
// <Greek> Ανάκτηση όλων των ιδιοτήτων
$allProperties = $object->getProperties();
// <English> Output all properties
// <Greek> Εμφάνιση όλων των ιδιοτήτων
print_r($allProperties); // Outputs: ['name' => 'TestObject', 'version' => 260000, 'logs' => [...], 'author' => 'Lead Developer', 'config' => [...]]

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>