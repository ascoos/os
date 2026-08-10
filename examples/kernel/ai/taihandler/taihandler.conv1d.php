<?php
/*
dobu {
    file:id(`example-00002520`),name(`taihandler.conv1d`) {
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
            methods {`conv1D()`},
            source {`kernel/ai/taihandler/taihandler.conv1d.php`},
            category:langs {
                en {`Convolution Layers`},
                el {`Συνελικτικά Στρώματα`}
            },
            subcategory:langs {
                en {`1D Convolution`},
                el {`1D Συνέλιξη`}
            },
            summary:langs {
                en {`1D convolution with padding, stride, bias and activation`},
                el {`1D συνέλιξη με padding, stride, bias και ενεργοποίηση`}
            },
            desc:langs {
                en {`Demonstrates conv1D on sequential numeric data using SAME padding and ReLU activation.`},
                el {`Παρουσιάζει conv1D σε σειριακά αριθμητικά δεδομένα με SAME padding και ενεργοποίηση ReLU.`}
            },
            author {`Drogidis Christos`},
            since {`1.0.0`},
            sincePHP {`8.4.0`}
        },
        results:langs {
            all {`Input: [1,2,3,4]
Kernel: [1,0,-1]
Output (conv1D SAME + ReLU): [0,0,0,3,4,0]

Execution statistics
Execution Time 	0.177 ms
Memory Delta 	3.92 KB
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

$input  = [1, 2, 3, 4];
$kernel = [1, 0, -1];

$output = $ai->conv1D($input, $kernel, 1, 'same', 0.0, fn($x) => max(0, $x));

echo "<pre>";
echo "Input: " . json_encode($input) . "\n";
echo "Kernel: " . json_encode($kernel) . "\n";
echo "Output (conv1D SAME + ReLU): " . json_encode($output) . "\n";
echo "</pre>";

$ai->Free();
print_stats($startTime, $startMem);
?>
