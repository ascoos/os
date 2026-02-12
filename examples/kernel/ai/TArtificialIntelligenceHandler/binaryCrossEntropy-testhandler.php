<?php
/*
dobu {
    file:id(`6`),name(`binaryCrossEntropy-testhandler`) {
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
            source {`examples/ai/TArtificialIntelligenceHandler/binaryCrossEntropy-testhandler.php`},
            category:langs {
                en {`Binary Cross-Entropy Visual Test`},
                el {`Οπτική Δοκιμή Διωνυμικής Διασταυρούμενης Εντροπίας`}
            },
            description:langs {
                en {`Visual validation of Binary Cross-Entropy loss using TTestHandler.`},
                el {`Οπτική επαλήθευση απώλειας Διωνυμικής Διασταυρούμενης Εντροπίας με χρήση TTestHandler.`}
            },
            author {`Drogidis Christos`},
            sincePHP {`8.4.0`}
        }
    }
}
*/
declare(strict_types=1);

use ASCOOS\OS\Kernel\Tests\TTestHandler;
use ASCOOS\OS\Kernel\AI\TArtificialIntelligenceHandler;

$ai = new TArtificialIntelligenceHandler([], []);

$y_true = [1, 0, 1];
$y_pred = [0.9, 0.1, 0.8];

$expected = 0.14462152754329;
$actual   = $ai->binaryCrossEntropy($y_true, $y_pred);

$test = new TTestHandler([
    'titleTest' => 'Binary Cross-Entropy Loss Test',
    'subtitle'  => '1D Error Validation',
    'desc'      => 'Visual test of Binary Cross-Entropy loss'
]);

$test->runTest(
    name: 'Binary Cross-Entropy 1D',
    condition : $test->assertFloatEquals($expected, $actual, 1e-12),
    expected: $expected,
    actual: $actual,
    description: 'Binary Cross-Entropy computed correctly for 1D arrays'
);

$test->extractHTML(false);
$test->Free();
?>
