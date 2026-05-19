<?php
/*
dobu {
    file:id(`example-00002082`) {
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
            methods {`articulationPoints()`},
            source {`extras/science/maths/tmathgraphhandler/tmathgraphhandler.articulationpoints.php`},
            category:langs {
                en {`Graph Mathematics`},
                el {`Μαθηματικά Γραφημάτων`}
            },
            subcategory:langs {
                en {`Critical Vertex Analysis`},
                el {`Ανάλυση Κρίσιμων Κορυφών`}
            },
            summary:langs {
                en {`Demonstrates how articulationPoints() detects critical vertices.`},
                el {`Δείχνει πώς η articulationPoints() εντοπίζει κρίσιμες κορυφές.`}
            },
            desc:langs {
                en {`This example tests a graph where B is the only articulation point.`},
                el {`Το παράδειγμα ελέγχει έναν γράφο όπου ο B είναι το μοναδικό σημείο άρθρωσης.`}
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

$g = new TMathGraphHandler();

$graph = [
    'A' => ['B'],
    'B' => ['A', 'C', 'D'],
    'C' => ['B'],
    'D' => ['B']
];

echo "<pre>";
echo "=== articulationPoints() Example ===\n\n";

print_r($g->articulationPoints($graph));

echo "</pre>";

$g->Free();
print_stats($startTime, $startMem);
?>