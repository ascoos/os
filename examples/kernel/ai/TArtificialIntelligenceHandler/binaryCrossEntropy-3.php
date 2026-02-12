<?php
/*
dobu {
    file:id(`3`),name(`binaryCrossEntropy-3`) {
        ascoos {
            logo {`
                  __ _  ___  ___ ___   ___   ___     ___   ___
                 / _` |/  / / __/ _ \ / _ \ /  /    / _ \ /  /
                | (_| |\  \| (_| (_) | (_) |\  \   | (_) |\  \
                 \__,_|/__/ \___\___/ \___/ /__/    \___/ /__/
            `},
            name {`ASCOOS OS`},
            version {`1.0.0`},
        },
        example {
            method {`TArtificialIntelligenceHandler::binaryCrossEntropy()`}
            source {`examples/ai/TArtificialIntelligenceHandler/binaryCrossEntropy-3.php`},
            category:langs {
                en {`1D Numeric Arrays with Weights`},
                el {`Αριθμητικά Διανύσματα μίας διάστασης με βάρη`}
            },
            description:langs {
                en {`Demonstrates the calculation of Binary Cross-Entropy loss with weights for each element in the 1D arrays.`},
                el {`Παρουσιάζει τον υπολογισμό της απώλειας Διωνυμικής Διασταυρούμενης Εντροπίας με βάρη για κάθε στοιχείο στους 1D πίνακες.`}
            },
            author {`Drogidis Christos`},
            sincePHP {`8.4.0`}
        }
    }
}
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
