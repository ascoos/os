<?php
/*
dobu {
    file:id(`example-00002521`),name(`taihandler.conv2d`) {
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
            methods {`conv2D()`},
            source {`kernel/ai/taihandler/taihandler.conv2d.php`},
            category:langs {
                en {`Convolution Layers`},
                el {`Συνελικτικά Στρώματα`}
            },
            subcategory:langs {
                en {`2D Convolution`},
                el {`2D Συνέλιξη`}
            },
            summary:langs {
                en {`2D convolution with SAME padding and ReLU activation`},
                el {`2D συνέλιξη με SAME padding και ενεργοποίηση ReLU`}
            },
            desc:langs {
                en {`Demonstrates conv2D on a 3x3 matrix using a 2x2 kernel and SAME padding.`},
                el {`Παρουσιάζει conv2D σε πίνακα 3x3 με πυρήνα 2x2 και SAME padding.`}
            },
            author {`Drogidis Christos`},
            since {`1.0.0`},
            sincePHP {`8.4.0`}
        },
        results:langs {
            all {`Input: [[1,2,3],[4,5,6],[7,8,9]]
Kernel: [[1,0],[0,-1]]
Output (conv2D SAME + ReLU): [[0,0],[0,0]]

Execution statistics
Execution Time 	0.167 ms
Memory Delta 	4.34 KB
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
    [1,2,3],
    [4,5,6],
    [7,8,9]
];

$kernel = [
    [1,0],
    [0,-1]
];

$output = $ai->conv2D($input, $kernel, 1, 'same', 0.0, fn($x) => max(0, $x));

echo "<pre>";
echo "Input: " . json_encode($input) . "\n";
echo "Kernel: " . json_encode($kernel) . "\n";
echo "Output (conv2D SAME + ReLU): " . json_encode($output) . "\n";
echo "</pre>";

$ai->Free();
print_stats($startTime, $startMem);
?>
