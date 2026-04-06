<?php
/*
dobu {
    file:id(`example-0000097`) {
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
            class {`TCollection`},
            methods {`diff(), add(), intersect()`},
            source {`kernel/Core/TCollection/tcollection.diff_intersect.php`},
            category:langs {
                en {`Objects Collection`},
                el {`Συλλογή Αντικειμένων`}
            },
            summary:langs {
                en {`Comparison of two collections (differences & common objects)`},
                el {`Σύγκριση δύο συλλογών (διαφορές & κοινά αντικείμενα)`}
            },
            desc:langs {
                en {`Demonstrates finding differences and common objects between two collections.`},
                el {`Παρουσιάζει εύρεση διαφορών και κοινών αντικειμένων μεταξύ δύο συλλογών.`}
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

echo "<h1>TCollection::diff() and intersect()</h1>";


// ────────────────────────────────────────────────
// <EN> Creation of two collections with common and different objects
// <EL> Δημιουργία δύο συλλογών με κοινά και διαφορετικά αντικείμενα
// ────────────────────────────────────────────────
$collectionA = new TCollection();
$collectionB = new TCollection();

$obj1 = new stdClass(); $obj1->id = 1; $obj1->name = 'John';
$obj2 = new stdClass(); $obj2->id = 2; $obj2->name = 'Maria';
$obj3 = new stdClass(); $obj3->id = 3; $obj3->name = 'Kostas';

$collectionA->add($obj1);
$collectionA->add($obj2);
$collectionA->add($obj3);

$collectionB->add($obj2); // common
$collectionB->add($obj3); // common
$collectionB->add(new stdClass()); // only in B

// ────────────────────────────────────────────────
// <EN> Differences (objects only in A)
// <EL> Διαφορές (αντικείμενα μόνο στο A)
// ────────────────────────────────────────────────
$onlyInA = $collectionA->diff($collectionB);
echo "<h2>Differences (objects only in A)</h2>";
echo "<pre>"."Only at A: " . count($onlyInA) . " objects\n"."</pre>";

// ────────────────────────────────────────────────
// <EN> Common objects (A ∩ B)
// <EL> Κοινά αντικείμενα (A ∩ B)
// ────────────────────────────────────────────────
$common = $collectionA->intersect($collectionB);
echo "<h2>Common objects (A ∩ B)</h2>";
echo "<pre>"."Commons: " . count($common) . " objects\n"."</pre>";

// ────────────────────────────────────────────────
// <EN> Memory cleaning
// <EL> Καθαρισμός μνήμης
// ────────────────────────────────────────────────
$collectionA->Free();
$collectionB->Free();

echo "Example completed.\n";

// ==================== STATISTICS ====================

print_stats($startTime, $startMem);

/*
Expected:

Only at A: 1 objects
Commons: 2 objects
Example completed.
*/
?>