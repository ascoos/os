<?php
/*
dobu {
    file:id(`example-00000300`) {
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
            enum {`DebugLevel`},
            source {`kernel/enums/debuglevel/debuglevel.example.php`},
            category:lang {
                en {`Debugging and Error Classification`},
                el {`Αποσφαλμάτωση και Κατηγοριοποίηση Σφαλμάτων`}
            },
            subcategory:langs {
                en {`Using DebugLevel in Custom Exceptions`},
                el {`Χρήση του DebugLevel σε Προσαρμοσμένες Εξαιρέσεις`}
            },
            summary:langs {
                en {`Demonstrates how the DebugLevel enum can be used to classify exception messages.`},
                el {`Δείχνει πώς το enum DebugLevel μπορεί να χρησιμοποιηθεί για την κατηγοριοποίηση μηνυμάτων εξαιρέσεων.`}
            },
            desc:langs {
                en {`This example shows how a custom exception class can accept a DebugLevel enum value and produce different messages depending on the selected debug level.  
                    The match expression maps each DebugLevel case to a specific HTTP‑style error message, demonstrating how enums can replace legacy constants and improve type safety in exception handling.`},
                el {`Το παράδειγμα δείχνει πώς μια προσαρμοσμένη κλάση εξαίρεσης μπορεί να δέχεται μια τιμή enum DebugLevel και να παράγει διαφορετικά μηνύματα ανάλογα με το επιλεγμένο επίπεδο αποσφαλμάτωσης.  
                    Η έκφραση match αντιστοιχίζει κάθε case του DebugLevel σε ένα συγκεκριμένο μήνυμα σφάλματος τύπου HTTP, δείχνοντας πώς τα enums μπορούν να αντικαταστήσουν παλαιού τύπου σταθερές και να βελτιώσουν την τυποποίηση στον χειρισμό εξαιρέσεων.`}
            },
            author {`Drogidis Christos`},
            since {`1.0.0`},
            sincePHP {`8.4.0`}
        }
    }
}
*/
declare(strict_types=1);

use ASCOOS\OS\Kernel\Core\DebugLevel;

$startTime = microtime(true);
$startMem  = memory_get_usage();

class MyException extends Exception {
    function __construct(private DebugLevel $dbg)
    {
        match($dbg){
            DebugLevel::Info      =>    parent::__construct("Bad Request - Information Message", 400),
            DebugLevel::Warning   =>    parent::__construct("Bad Request - Warning Message", 400),
            DebugLevel::Error     =>    parent::__construct("Bad Request - Error Message", 400)
        };
    }
}

// Testing my custom exception class
try {
    throw new MyException(DebugLevel::Info);
} catch (MyException $e) {
    echo $e->getMessage();  // Bad Request - Information Message
}

print_stats($startTime, $startMem);
?>