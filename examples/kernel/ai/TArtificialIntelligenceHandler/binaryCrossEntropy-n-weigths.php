<?php
/*
dobu {
    file:id(`4`),name(`binaryCrossEntropy-n-weigths`) {
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
            source {`examples/ai/TArtificialIntelligenceHandler/binaryCrossEntropy-n-weigths.php`},
            category:langs {
                en {`N-Dimensional Numeric Arrays with weigths`},
                el {`Πολυδιάστατα Αριθμητικά Διανύσματα με βάρη`}
            },
            description:langs {
                en {`Computes the Binary Cross-Entropy loss for N-Dimensional arrays recursively with weigths.`},
                el {`Υπολογίζει την απώλεια Διωνυμικής Διασταυρούμενης Εντροπίας για N-Διαστασιακούς πίνακες με αναδρομική διάσχιση και με βάρη.`}
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