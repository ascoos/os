<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 1.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 *
 * @CLASS-METHOD-STUDY  : TArtificialIntelligenceHandler::binaryCrossEntropy()
 * @file                : binaryCrossEntropy-2.php
 * @test                : 2D Numeric Arrays
 *
 * @desc <English> Computes the Binary Cross-Entropy loss for 2D numeric arrays.
 * @desc <Greek> Υπολογίζει την απώλεια Binary Cross-Entropy για 2D αριθμητικούς πίνακες.
 *
 * @since PHP 8.4.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\AI\TArtificialIntelligenceHandler;

$ai = new TArtificialIntelligenceHandler([], []);

$y_true = [
    [1, 0],
    [0, 1]
];

$y_pred = [
    [0.9, 0.1],
    [0.1, 0.9]
];

$loss = $ai->binaryCrossEntropy($y_true, $y_pred);

echo "Binary Cross-Entropy Loss (2D): {$loss}\n"; // Expected output: Binary Cross-Entropy Loss (2D): 0.10536051565783
?>
