<?php
/*
dobu {
    file:id(`5`),name(`binaryCrossEntropy-n`) {
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
            source {`examples/ai/TArtificialIntelligenceHandler/binaryCrossEntropy-n.php`},
            category:langs {
                en {`N-Dimensional Numeric Arrays`},
                el {`Πολυδιάστατα Αριθμητικά Διανύσματα`}
            },
            description:langs {
                en {`Computes the Binary Cross-Entropy loss for N-Dimensional arrays recursively.`},
                el {`Υπολογίζει την απώλεια Διωνυμικής Διασταυρούμενης Εντροπίας για N-Διαστασιακούς πίνακες με αναδρομική διάσχιση.`}
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
    [[1, 0], [0, 1]],
    [[1, 1], [0, 0]]
];
$y_pred = [
    [[0.9, 0.1], [0.1, 0.9]],
    [[0.9, 0.9], [0.1, 0.1]]
];

$loss = $ai->binaryCrossEntropy($y_true, $y_pred);

echo "Binary Cross-Entropy Loss (3D): {$loss}\n"; // Expected output: Binary Cross-Entropy Loss (3D): 0.10536051565783
?>
