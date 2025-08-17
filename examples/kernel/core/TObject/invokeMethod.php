<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Illustrates the use of hasMethod and invokeMethod to check for method existence and dynamically invoke a method.
 * @desc <Greek> Επιδεικνύει τη χρήση των hasMethod και invokeMethod για τον έλεγχο ύπαρξης μεθόδου και τη δυναμική κλήση της.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Core\TObject;

// <English> Define a test class extending TObject with a sample method
// <Greek> Ορισμός μιας δοκιμαστικής κλάσης που επεκτείνει την TObject με μια δείγμα μεθόδου
class TestClass extends TObject {
    public function sayHello($name) {
        return "Hello, $name!";
    }
}

// <English> Create a new instance of TestClass
// <Greek> Δημιουργία νέου instance της TestClass
$object = new TestClass(['name' => 'Test']);

// <English> Check if method exists
// <Greek> Έλεγχος ύπαρξης μεθόδου
$hasMethod = $object->hasMethod('sayHello');

// <English> Output method existence result
// <Greek> Εμφάνιση αποτελέσματος ύπαρξης μεθόδου
echo $hasMethod ? "Method exists\n" : "Method does not exist\n"; // Outputs: Method exists

// <English> Dynamically invoke the method
// <Greek> Δυναμική κλήση της μεθόδου
$result = $object->invokeMethod('sayHello', ['World']);

// <English> Output the method result
// <Greek> Εμφάνιση του αποτελέσματος της μεθόδου
echo $result; // Outputs: Hello, World!

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$object->Free($object);
?>