<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 1.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 *
 * @CLASS-METHOD-STUDY  : TArtificialIntelligenceHandler::binaryCrossEntropy()
 * @file                : binaryCrossEntropy-3.php
 * @test                : 1D Numeric Arrays with Weights
 *
 * @desc <English> Demonstrates the calculation of Binary Cross-Entropy loss with weights for each element in the 1D arrays.
 * @desc <Greek> Παρουσιάζει τον υπολογισμό της απώλειας Binary Cross-Entropy με βάρη για κάθε στοιχείο στους 1D πίνακες.
 *
 * @since PHP 8.4.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\AI\TArtificialIntelligenceHandler;

$ai = new TArtificialIntelligenceHandler([], []);

$y_true = [1, 0, 1];
$y_pred = [0.9, 0.1, 0.8];
$weights = [0.5, 1.0, 1.5]; // Here are the weights for each element

$loss = $ai->binaryCrossEntropy($y_true, $y_pred, $weights);

echo "Binary Cross-Entropy Loss with Weights: {$loss}\n"; // Expected output: Binary Cross-Entropy Loss with Weights: 0.16425203348602
?>
