<?php
/*
dobu {
    file:id(`example-00000095`) {
        ascoos {
            logo {`
                  __ _  ___  ___ ___   ___   ___     ___   ___
                 / _` |/  / / __/ _ \ / _ \ /  /    / _ \ /  /
                | (_| |\  \| (_| (_) | (_) |\  \   | (_) |\  \
                 \__,_|/__/ \___\___/ \___/ /__/    \___/ /__/
            `},
            name {`ASCOOS OS`},
            version {`1.0.0`}
        },
        example {
            class {`TCollection`},
            methods {`sumBy(), avgBy(), add(), Free()`},
            source {`examples/kernel/core/tcollection/tcollection.sum_avg.php`},
            category:langs {
                en {`Objects Collection`},
                el {`Συλλογή Αντικειμένων`}
            },
            summary:langs {
                en {`Demonstrates summing and averaging numeric properties`},
                el {`Παρουσιάζει άθροισμα και μέσο όρο αριθμητικής ιδιότητας`}
            },
            desc:langs {
                en {`This example demonstrates how to use the sumBy() and avgBy() methods of TCollection to aggregate numeric values from a list of objects. 
                    Non‑numeric or null values are automatically ignored, ensuring accurate calculations. 
                    The example shows how to populate a collection, compute the total and average of a specific property, and finally release memory resources.`},
                el {`Το παράδειγμα αυτό παρουσιάζει τη χρήση των μεθόδων sumBy() και avgBy() της TCollection για τη συγκέντρωση αριθμητικών τιμών 
                    από μια λίστα αντικειμένων. 
                    Μη αριθμητικές ή null τιμές αγνοούνται αυτόματα, εξασφαλίζοντας σωστούς υπολογισμούς. 
                    Το παράδειγμα δείχνει πώς δημιουργείται μια συλλογή, πώς υπολογίζεται το άθροισμα και ο μέσος όρος μιας συγκεκριμένης ιδιότητας 
                    και τέλος πώς γίνεται ο καθαρισμός της μνήμης.`}
            },
            author {`Drogidis Christos`},
            sincePHP {`8.4.0`}
        }
    }
}
*/
declare(strict_types=1);

use Ascoos\OS\Kernel\Core\Collections\TCollection;

$startTime = microtime(true);
$startMem  = memory_get_usage();

// ────────────────────────────────────────────────
// <EN> Creating a collection with numerical data
// <EL> Δημιουργία συλλογής με αριθμητικά δεδομένα
// ────────────────────────────────────────────────
$collection = new TCollection();

$obj1 = new stdClass(); $obj1->score = 85;
$obj2 = new stdClass(); $obj2->score = 92;
$obj3 = new stdClass(); $obj3->score = 78;
$obj4 = new stdClass(); $obj4->score = null; // non-numeric → ignored

$collection->add($obj1);
$collection->add($obj2);
$collection->add($obj3);
$collection->add($obj4);

// ────────────────────────────────────────────────
// <EN> Sum and average score
// <EL> Άθροισμα και μέσος όρος σκορ
// ────────────────────────────────────────────────
$totalScore = $collection->sumBy('score');
$averageScore = $collection->avgBy('score');

echo "<h1>TCollection::sumBy() and avgBy()</h1>";
echo "<pre>";
echo "Score total   : {$totalScore}\n";
echo "Average score : " . ($averageScore !== null ? number_format($averageScore, 2) : 'No valid') . "\n";
echo "</pre>";

// ────────────────────────────────────────────────
// <EN> Memory cleaning
// <EL> Καθαρισμός μνήμης
// ────────────────────────────────────────────────
$collection->Free();

echo "Example completed.\n";

// ==================== STATISTICS ====================

print_stats($startTime, $startMem);
?>