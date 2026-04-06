<?php
/*
dobu {
    file:id(`example-00000096`) {
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
            methods {`TCollection ArrayAccess (offsetExists, offsetGet, offsetSet, offsetUnset)`},
            source {`kernel/core/tcollection/tcollection.array_access.php`},
            category:langs {
                en {`Objects Collection`},
                el {`Συλλογή Αντικειμένων`}
            },
            summary:langs {
                en {`Using a collection like an array with offset`},
                el {`Χρήση συλλογής σαν array με offset`}
            },
            desc:langs {
                en {`Demonstrates array-like access using ArrayAccess interface.`},
                el {` Παρουσιάζει πρόσβαση τύπου array μέσω interface ArrayAccess`}
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

echo "<h1>TCollection ArrayAccess</h1>";

// ────────────────────────────────────────────────
// <EN> Creating collection
// <EL> Δημιουργία συλλογής
// ────────────────────────────────────────────────
$collection = new TCollection();

// ────────────────────────────────────────────────
// <EN> offsetSet - adding with offset (like $collection['key'] = value)
// <EL> offsetSet - προσθήκη με offset (σαν $collection['key'] = value)
// ────────────────────────────────────────────────
$collection['a'] = new stdClass();
$collection[10]  = new stdClass();

// ────────────────────────────────────────────────
// <EN> offsetExists + offsetGet - existence check and retrieval
// <EL> offsetExists + offsetGet - έλεγχος ύπαρξης και ανάκτηση
// ────────────────────────────────────────────────
echo "<h2>offsetExists + offsetGet - existence check and retrieval</h2>";
if (isset($collection['a'])) {
    echo "<pre>"."The key 'a' exists\n"."</pre>";
    $itemA = $collection['a'];
}

if (isset($collection[10])) {
    echo "<pre>"."Key 10 exists\n"."</pre>";
}

// ────────────────────────────────────────────────
// <EN> offsetUnset - removal of an element (like unset($collection['key']))
// <EL> offsetUnset - αφαίρεση στοιχείου (σαν unset($collection['key']))
// ────────────────────────────────────────────────
echo "<h2>offsetUnset - removal of an element</h2>";
unset($collection['a']);

if (!isset($collection['a'])) {
    echo "<pre>"."The key 'a' was removed\n"."</pre>";
}

// ────────────────────────────────────────────────
// <EN> Addition without key (push like array)
// <EL> Προσθήκη χωρίς κλειδί (push σαν array)
// ────────────────────────────────────────────────
echo "<h2>Addition without key (push like array)</h2>";
$collection[] = new stdClass();  // offsetSet with null offset -> add()

echo "<pre>"."Total elements after the changes: " . $collection->count() . "\n"."</pre>";

// ────────────────────────────────────────────────
// <EN> Memory cleanup
// <EL> Καθαρισμός μνήμης
// ────────────────────────────────────────────────
$collection->Free();

echo "Example completed.\n";

// ==================== STATISTICS ====================

print_stats($startTime, $startMem);
?>