<?php
/*
dobu {
    file:id(`example-00002101`) {
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
            methods {`assortativity()`},
            source {`extras/science/maths/tmathgraphhandler/tmathgraphhandler.assortativity.php`},
            category:langs {
                en {`Graph Mathematics`},
                el {`Μαθηματικά Γραφημάτων`}
            },
            subcategory:langs {
                en {`Graph Metrics`},
                el {`Μετρικές Γράφου`}
            },
            summary:langs {
                en {`Demonstrates computation of degree assortativity.`},
                el {`Δείχνει τον υπολογισμό assortativity βαθμού.`}
            },
            desc:langs {
                en {`This example computes the assortativity of a small undirected graph.`},
                el {`Το παράδειγμα υπολογίζει την assortativity ενός μικρού μη κατευθυνόμενου γράφου.`}
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
echo "=== assortativity() Example ===\n\n";

$r = $math->assortativity($graph);

echo "Assortativity: ";
var_dump($r);

echo "</pre>";

$math->Free();
print_stats($startTime, $startMem);
?>