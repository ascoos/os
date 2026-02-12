<?php
/*
dobu {
    file:id(`1`),name(`binaryCrossEntropy-1`) {
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
            source {`examples/ai/TArtificialIntelligenceHandler/binaryCrossEntropy-1.php`},
            category:langs {
                en {`1D Numeric Arrays`},
                el {`Αριθμητικά Διανύσματα μίας διάστασης`}
            },
            description:langs {
                en {`Demonstrates the calculation of Binary Cross-Entropy loss between true and predicted values using 1D arrays.`},
                el {`Παρουσιάζει τον υπολογισμό της απώλειας Διωνυμικής Διασταυρούμενης Εντροπίας μεταξύ πραγματικών και προβλεπόμενων τιμών με 1D πίνακες.`}
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

$loss = $ai->binaryCrossEntropy($y_true, $y_pred);

echo "Binary Cross-Entropy Loss: {$loss}\n"; // Expected output: Binary Cross-Entropy Loss: 0.14462152754329
?>
