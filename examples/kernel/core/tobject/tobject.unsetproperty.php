<?php
/*
dobu {
    file:id(`example-00000009`) {
        ascoos {
            name {`ASCOOS OS`},
            version {`1.0.0`}
        },
        example {
            class {`TObject`},
            methods {`unsetProperty(), setProperty(), getProperties(), Free()`},
            source {`examples/kernel/core/tobject/tobject.unsetproperty.php`},
            category:langs {
                en {`Object Properties`},
                el {`Ιδιότητες Αντικειμένου`}
            },
            summary:langs {
                en {`Demonstrates unsetProperty() with deep dot-notation paths on both external arrays and internal TObject properties.`},
                el {`Επίδειξη της unsetProperty() με βαθιές διαδρομές dot-notation τόσο σε εξωτερικούς πίνακες όσο και σε εσωτερικές ιδιότητες του TObject.`}
            },
            desc:langs {
                en {`Complete example showing how to remove properties at root level or deep nested paths using dot-notation.
                    Supports both internal object properties and external arrays.
                    Uses the clean version of getProperties() that excludes internal metadata.`},
                el {`Πλήρες παράδειγμα που δείχνει πώς να διαγράφουμε ιδιότητες είτε στο root είτε σε βαθιά εμφωλευμένα επίπεδα με dot-notation.
                    Υποστηρίζει τόσο τις εσωτερικές ιδιότητες του αντικειμένου όσο και εξωτερικούς πίνακες.
                    Χρησιμοποιεί την καθαρή εκδοχή του getProperties() που εξαιρεί τα εσωτερικά μεταδεδομένα.`}
            },
            author {`Drogidis Christos`},
            sincePHP {`8.4.0`}
        }
    }
}
*/
declare(strict_types=1);

use ASCOOS\OS\Kernel\Core\TObject;

$startTime = microtime(true);
$startMem  = memory_get_usage();

$object = new TObject();

// ==================== 1. unsetProperty() IN EXTERNAL ARRAY ====================

echo "<h2>1. unsetProperty() on an external array</h2>";

$data = [
    'user' => [
        'name'     => 'Maria',
        'email'    => 'maria@example.com',
        'address'  => [
            'city'     => 'Athens',
            'postcode' => '11527',
            'country'  => 'Greece'
        ],
        'active'   => true
    ],
    'settings' => [
        'theme' => 'dark',
        'notifications' => true
    ]
];

echo "<strong>Initial data:</strong><br>";
echo "<pre>" . print_r($data, true) . "</pre>";

// <EN> Deletion of specific properties with deep path
// <EL> Διαγραφή συγκεκριμένων ιδιοτήτων με deep path
$object->unsetProperty('user.address.postcode', $data);
$object->unsetProperty('user.email', $data);
$object->unsetProperty('settings', $data);           // delete entire subarray

echo "<strong>After the unsetProperty (external array):</strong><br>";
echo "<pre>" . print_r($data, true) . "</pre>";

// ==================== 2. unsetProperty() IN INTERNAL PROPERTIES ====================

echo "<h2>2. unsetProperty() on the internal properties of TObject</h2>";

$object->setProperty('user.name', 'John');
$object->setProperty('user.age', 35);
$object->setProperty('config.debug', true);
$object->setProperty('config.version', '1.2.3');

echo "<strong>After setProperty:</strong><br>";
echo "<pre>" . print_r($object->getProperties(), true) . "</pre>";

$object->unsetProperty('user.age');
$object->unsetProperty('config.debug');

echo "<strong>After unsetProperty (clean appearance):</strong><br>";
echo "<pre>" . print_r($object->getProperties(), true) . "</pre>";

// ==================== 3. TEST OF NON-EXISTENT PROPERTY ====================

echo "<h2>3. Test of non-existent property</h2>";

$result = $object->unsetProperty('user.phone');
echo "unsetProperty('user.phone') → " . ($result ? 'true' : 'false') . " (there was not)<br><br>";

// ==================== CLEANING ====================

$object->Free();

echo "<p><em>The object was cleaned with Free().</em></p>";

echo "<pre>";
echo "<strong>Execution statistics</strong>\n\n";
echo "Execution Time          : " . round((microtime(true) - $startTime) * 1000, 3) . " ms\n";
echo "Memory Usage Delta (Δ)  : " . formatBytes(memory_get_usage() - $startMem) . "\n";
echo "Peak Memory             : " . formatBytes(memory_get_peak_usage(true)) . "\n";
echo "PHP Version             : " . PHP_VERSION . "\n";
echo "</pre>";
?>
