<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 1.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 *
 * @CLASS-METHOD-STUDY  : TArtificialIntelligenceHandler::binaryCrossEntropy()
 * @file                : binaryCrossEntropy-n-weigths.php
 * @test                : N-Dimensional Numeric Arrays with weigths
 *
 * @desc <English> Computes the Binary Cross-Entropy loss for N-Dimensional arrays recursively with weigths.
 * @desc <Greek> Υπολογίζει την απώλεια Binary Cross-Entropy για N-Διαστασιακούς πίνακες με αναδρομική διάσχιση και με βάρη.
 *
 * @since PHP 8.4.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\AI\TArtificialIntelligenceHandler;

$ai = new TArtificialIntelligenceHandler([], []);

$y_true = [
    [[ [1,0,0], [0,1,0] ],
     [ [0,0,1], [1,0,0] ]],

    [[ [0,1,0], [1,0,0] ],
     [ [0,0,1], [0,1,0] ]]
];

$y_pred = [
    [[ [0.7,0.2,0.1], [0.1,0.8,0.1] ],
     [ [0.2,0.3,0.5], [0.6,0.3,0.1] ]],

    [[ [0.2,0.7,0.1], [0.8,0.1,0.1] ],
     [ [0.1,0.2,0.7], [0.2,0.6,0.2] ]]
];

$weights = [0.5,1.0,1.5,0.8,1.2,0.7,1.1,0.9];

$loss = $ai->binaryCrossEntropy($y_true, $y_pred, $weights);

echo "Binary Cross-Entropy Loss (3D) with Weigths: {$loss}\n"; // Expected output: Binary Cross-Entropy Loss (3D) with Weigths: 0.25228454778873
?>