<?php
/**
 * Example: Use of TObject in Ascoos OS
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * @since PHP 8.2.0
 */
use ASCOOS\OS\Kernel\Core\TObject;

$object = new TObject([
    'version' => 2400070000,
    'MinPHPVersion' => 80200
]);
echo $object->getClassVersion(); // Display: 2400070000
echo $object->__toString(); // Display: TObject
$object->setProperty('custom', 'value');
var_dump($object->getProperty('custom')); // Display: string(5) "value"
if ($object->isExecutable(260000, PHP_VERSION_ID)) {
    echo "The class is executable!";
}
?>
