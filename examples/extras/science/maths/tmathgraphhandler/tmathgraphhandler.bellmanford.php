<?php
/*
dobu {
    file:id(`example-00002043`) {
        ascoos {
            logo {`
                  __ _  ___  ___ ___   ___   ___     ___   ___
                 / _' |/  / / __/ _ \ / _ \ /  /    / _ \ /  /
                | (_| |\  \| (_| (_) | (_) |\  \   | (_) |\  \
                 \__,_|/__/ \___\___/ \___/ /__/    \___/ /__/
            `},
            name {`ASCOOS OS`},
            version {`1.0.0`},
        },
        example {
            class {`TMathGraphHandler`},
            methods {`bellmanFord()`},
            source {`extras/science/maths/tmathgraphhandler/tmathgraphhandler.bellmanford.php`},
            category:langs {
                en {`Graph Mathematics`},
                el {`Μαθηματικά Γραφημάτων`}
            },
            subcategory:langs {
                en {`Shortest Path Algorithms`},
                el {`Αλγόριθμοι Συντομότερων Διαδρομών`}
            },
            summary:langs {
                en {`Shortest paths with support for negative weights.`},
                el {`Συντομότερες διαδρομές με υποστήριξη αρνητικών βαρών.`}
            },
            desc:langs {
                en {`Demonstrates Bellman-Ford on a weighted directed graph.`},
                el {`Παρουσιάζει τον Bellman-Ford σε σταθμισμένο κατευθυνόμενο γράφο.`}
            },
            author {`Drogidis Christos`},
            since {`1.0.0.16677`},
            sincePHP {`8.4.0`}
        }
    }
}
*/
declare(strict_types=1);
use ASCOOS\OS\Kernel\Science\Maths\TMathGraphHandler;

$startTime = microtime(true);
$startMem  = memory_get_usage();

$math = new TMathGraphHandler();

echo "<pre>";

$graph = [
    'A' => ['B' => 4, 'C' => 2],
    'B' => ['C' => -1, 'D' => 2],
    'C' => ['D' => 3],
    'D' => []
];

echo "=== Bellman-Ford Example ===\n\n";

$result = $math->bellmanFord($graph, 'A');

print_r($result);

echo "</pre>";

$math->Free();

print_stats($startTime, $startMem);
?>