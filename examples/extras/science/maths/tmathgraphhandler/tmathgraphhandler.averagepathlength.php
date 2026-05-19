<?php
/*
dobu {
    file:id(`example-00002105`) {
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
            class {`TMathGraphHandler`},
            methods {`averagePathLength()`},
            source {`extras/science/maths/tmathgraphhandler/tmathgraphhandler.averagepathlength.php`},
            category:langs {
                en {`Graph Mathematics`},
                el {`Μαθηματικά Γραφημάτων`}
            },
            subcategory:langs {
                en {`Graph Distances`},
                el {`Αποστάσεις Γράφου`}
            },
            summary:langs {
                en {`Demonstrates computation of average path length.`},
                el {`Δείχνει τον υπολογισμό του μέσου μήκους διαδρομής.`}
            },
            desc:langs {
                en {`This example computes the average shortest‑path length of a small undirected graph.`},
                el {`Το παράδειγμα υπολογίζει το μέσο μήκος συντομότερης διαδρομής ενός μικρού μη κατευθυνόμενου γράφου.`}
            },
            author {`Drogidis Christos`},
            since {`1.0.0`},
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

$graph = [
    'A' => ['B','C'],
    'B' => ['A','C','D'],
    'C' => ['A','B'],
    'D' => ['B']
];

echo "<pre>";
echo "=== averagePathLength() Example ===\n\n";

$L = $math->averagePathLength($graph);

echo "Average Path Length: ";
var_dump($L);

echo "</pre>";

$math->Free();
print_stats($startTime, $startMem);
?>