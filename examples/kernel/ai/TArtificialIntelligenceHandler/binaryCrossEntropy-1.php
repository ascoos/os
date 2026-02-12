<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 1.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 *
 * @CLASS-METHOD-STUDY  : TArtificialIntelligenceHandler::binaryCrossEntropy()
 * @file                : binaryCrossEntropy-1.php
 * @test                : 1D Numeric Arrays
 *
 * @desc <English> Demonstrates the calculation of Binary Cross-Entropy loss between true and predicted values using 1D arrays.
 * @desc <Greek> Παρουσιάζει τον υπολογισμό της απώλειας Binary Cross-Entropy μεταξύ πραγματικών και προβλεπόμενων τιμών με 1D πίνακες.
 *
 * @since PHP 8.4.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\AI\TArtificialIntelligenceHandler;

$ai = new TArtificialIntelligenceHandler([], []);

$y_true = [1, 0, 1];
$y_pred = [0.9, 0.1, 0.8];

$loss = $ai->binaryCrossEntropy($y_true, $y_pred);

echo "Binary Cross-Entropy Loss: {$loss}\n"; // Expected output: Binary Cross-Entropy Loss: 0.14462152754329
?>
