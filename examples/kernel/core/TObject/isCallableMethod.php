<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Demonstrates checking and invoking methods dynamically using hasMethod, invokeMethod, and isCallableMethod.
 * @desc <Greek> Παρουσιάζει τον έλεγχο και τη δυναμική κλήση μεθόδων με τις hasMethod, invokeMethod και isCallableMethod.
 * 
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Core\TObject;

// <English> Define a test class extending TObject with a sample method
// <Greek> Ορισμός μιας δοκιμαστικής κλάσης που επεκτείνει την TObject με δείγμα μεθόδου
class TestClass extends TObject {
    public function sayHello($name) {
        return "Hello, $name!";
    }
}

// <English> Create a new instance of TestClass
// <Greek> Δημιουργία νέου instance της TestClass
$object = new TestClass(['name' => 'Test']);

// <English> Check if a method exists
// <Greek> Έλεγχος αν υπάρχει μια μέθοδος
$hasMethod = $object->hasMethod('sayHello');
// <English> Output method existence
// <Greek> Εμφάνιση ύπαρξης μεθόδου
echo $hasMethod ? "Method 'sayHello' exists\n" : "Method 'sayHello' does not exist\n"; // Outputs: Method 'sayHello' exists

// <English> Check if a method is callable
// <Greek> Έλεγχος αν μια μέθοδος είναι κλητή
$isCallable = $object->isCallableMethod('sayHello');
// <English> Output callable status
// <Greek> Εμφάνιση κατάστασης κλητότητας
echo $isCallable ? "Method 'sayHello' is callable\n" : "Method 'sayHello' is not callable\n"; // Outputs: Method 'sayHello' is callable

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