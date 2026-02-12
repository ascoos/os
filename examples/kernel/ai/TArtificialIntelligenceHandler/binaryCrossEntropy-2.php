<?php
/*
dobu {
    file:id(`2`),name(`binaryCrossEntropy-2`) {
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
            source {`examples/ai/TArtificialIntelligenceHandler/binaryCrossEntropy-2.php`},
            category:langs {
                en {`2D Numeric Arrays`},
                el {`Αριθμητικά Διανύσματα δύο διαστάσεων`}
            },
            description:langs {
                en {`Computes the Binary Cross-Entropy loss for 2D numeric arrays.`},
                el {`Υπολογίζει την απώλεια Διωνυμικής Διασταυρούμενης Εντροπίας για 2D αριθμητικούς πίνακες.`}
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
