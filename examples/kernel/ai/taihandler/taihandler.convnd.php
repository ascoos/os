<?php
/*
dobu {
    file:id(`example-00002522`),name(`taihandler.convnd`) {
        ascoos {
            logo {`
                  __ _  ___  ___ ___   ___   ___     ___   ___
                 / _' |/  / / __/ _ \ / _ \ /  /    / _ \ /  /
                | (_| |\  \| (_| (_) | (_) |\  \   | (_) |\  \
                 \__,_|/__/ \___\___/ \___/ /__/    \___/ /__/
            `},
            name {`ASCOOS OS`},
            version {`1.0.0`}
        },
        example {
            class {`TAIHandler`},
            methods {`convND()`},
            source {`kernel/ai/taihandler/taihandler.convnd.php`},
            category:langs {
                en {`ND Convolution Engine`},
                el {`ND Συνελικτικός Μηχανισμός`}
            },
            subcategory:langs {
                en {`Multi-channel ND Convolution`},
                el {`Πολυκαναλική ND Συνέλιξη`}
            },
            summary:langs {
                en {`ND convolution on nested multi-channel tensors`},
                el {`ND συνέλιξη σε εμφωλευμένους πολυκαναλικούς πίνακες`}
            },
            desc:langs {
                en {`Demonstrates convND on a 2-channel 3x3 input using a multi-channel kernel.`},
                el {`Παρουσιάζει convND σε είσοδο 2 καναλιών 3x3 με πολυκαναλικό πυρήνα.`}
            },
            author {`Drogidis Christos`},
            since {`1.0.0`},
            sincePHP {`8.4.0`}
        },
        results:langs {
            all {`Input: [[[1,2,3],[4,5,6],[7,8,9]],[[9,8,7],[6,5,4],[3,2,1]]]
Kernel: [[[[1,0],[0,-1]],[[0,1],[-1,0]]]]
Output (convND VALID): [[[-2,-2],[-2,-2]]]

Execution statistics
Execution Time 	0.181 ms
Memory Delta 	4.55 KB
Peak Memory 	18.00 MB
PHP Version 	8.4.24
Ascoos OS`}
        }
    }
}
*/
declare(strict_types=1);
use ASCOOS\OS\Kernel\AI\TAIHandler;

$startTime = microtime(true);
$startMem  = memory_get_usage();

$ai = new TAIHandler([], []);

$input = [
    [ // Channel 1
        [1,2,3],
        [4,5,6],
        [7,8,9]
    ],
    [ // Channel 2
        [9,8,7],
        [6,5,4],
        [3,2,1]
    ]
];

$kernel = [
    [ // Output channel 1
        [ // Input channel 1
            [1,0],
            [0,-1]
        ],
        [ // Input channel 2
            [0,1],
            [-1,0]
        ]
    ]
];

$output = $ai->convND($input, $kernel, 1, 'valid');

echo "<pre>";
echo "Input: " . json_encode($input) . "\n";
echo "Kernel: " . json_encode($kernel) . "\n";
echo "Output (convND VALID): " . json_encode($output) . "\n";
echo "</pre>";

$ai->Free();
print_stats($startTime, $startMem);
?>
