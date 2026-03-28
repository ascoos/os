<?php
/*
dobu {
    file:id(`example-00000010`) {
        ascoos {
            name {`ASCOOS OS`},
            version {`1.0.0`}
        },
        example {
            class {`TObject`},
            methods {`getProperties(), setProperty(), Free()`},
            source {`examples/kernel/core/tobject/tobject.getproperties.php`},
            category:langs {
                en {`Object Properties`},
                el {`Ιδιότητες Αντικειμένου`}
            },
            summary:langs {
                en {`Demonstrates all three calling modes of getProperties() using the same array as both external and internal.`},
                el {`Επίδειξη και των τριών τρόπων κλήσης της getProperties() χρησιμοποιώντας το ίδιο array ως εξωτερικό και εσωτερικό.`}
            },
            desc:langs {
                en {`Initializes TObject by passing an array to the constructor. Then demonstrates the three different ways to call getProperties():
                    - Default clean version (filters metadata)
                    - Full internal structure (`getProperties(null, [])`)
                    - Selective metadata filtering.`},
                el {`Αρχικοποιεί το TObject περνώντας έναν πίνακα στον constructor. Στη συνέχεια επιδεικνύει τους τρεις διαφορετικούς τρόπους κλήσης της getProperties().
                    - Προεπιλεγμένη καθαρή έκδοση (φιλτράρει μεταδεδομένα)
                    - Πλήρης εσωτερική δομή (`getProperties(null, [])`)
                    - Επιλεκτικό φιλτράρισμα μεταδεδομένων.`}
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

$properties = [
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

$object = new TObject($properties);

echo "<h2>1. TObject initialized with external array</h2>";
echo "<strong>Array passed to constructor:</strong><br>";
echo "<pre>" . print_r($properties, true) . "</pre>";

// Modifications
$object->setProperty('user.address.state', 'Attica', $properties);
$object->setProperty('user.website', 'www.example.com', $properties);

echo "<strong>After setProperty() calls → getProperties(\$properties) [clean external]:</strong><br>";
echo "<pre>" . print_r($object->getProperties($properties), true) . "</pre>";

// ==================== THREE MODES ====================

echo "<h2>2. Three calling modes of getProperties()</h2>";

echo "<h3>A. Clean version (default - recommended for normal use):</h3>";
echo "<pre>" . print_r($object->getProperties(), true) . "</pre>";

echo "<h3>B. Full internal structure with all metadata:</h3>";
echo "<pre>" . print_r($object->getProperties(null, []), true) . "</pre>";

echo "<h3>C. Selective metadata filtering:</h3>";
echo "<pre>" . print_r($object->getProperties(null, ['deprecated', 'MinAscoosVersion', 'MinPHPVersion']), true) . "</pre>";

// ==================== CLEANUP ====================

$object->Free();

echo "<p><em>Object cleaned with Free().</em></p>";

// ==================== STATISTICS ====================

echo "<pre>";
echo "<strong>Execution statistics</strong>\n\n";
echo "Execution Time     : " . round((microtime(true) - $startTime) * 1000, 3) . " ms\n";
echo "Memory Delta       : " . formatBytes(memory_get_usage() - $startMem) . "\n";
echo "Peak Memory        : " . formatBytes(memory_get_peak_usage(true)) . "\n";
echo "PHP Version        : " . PHP_VERSION . "\n";
echo "</pre>";
?>