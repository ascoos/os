<?php
/*
dobu {
    file:id(`example-00002108`) {
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
            methods {`betweennessCentrality()`},
            source {`extras/science/maths/tmathgraphhandler/tmathgraphhandler.betweennesscentrality.php`},
            category:langs {
                en {`Graph Mathematics`},
                el {`Μαθηματικά Γραφημάτων`}
            },
            subcategory:langs {
                en {`Graph Centrality`},
                el {`Κεντρικότητα Γράφου`}
            },
            summary:langs {
                en {`Demonstrates computation of betweenness centrality.`},
                el {`Δείχνει τον υπολογισμό της κεντρικότητας μεσότητας.`}
            },
            desc:langs {
                en {`This example computes the betweenness centrality of all vertices in a small undirected graph.`},
                el {`Το παράδειγμα υπολογίζει την κεντρικότητα μεσότητας όλων των κορυφών σε έναν μικρό μη κατευθυνόμενο γράφο.`}
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
echo "=== betweennessCentrality() Example ===\n\n";

$C = $math->betweennessCentrality($graph);

echo "Betweenness Centrality:\n";
print_r($C);

echo "</pre>";

$math->Free();
print_stats($startTime, $startMem);
?>