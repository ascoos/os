<?php
/*
dobu {
    file:id(`example-00000301`) {
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
            methods {`fromConstant()`},
            source {`kernel/enums/debuglevel/debuglevel.fromconstant.php`},
            category:lang {               
                en {`Debugging and Error Classification`},
                el {`Αποσφαλμάτωση και Κατηγοριοποίηση Σφαλμάτων`}
            },
            subcategory:langs {
                en {`Converting Legacy Debug Constants to Enum Values`},
                el {`Μετατροπή Παλαιών Σταθερών Αποσφαλμάτωσης σε Τιμές Enum`}
            },
            summary:langs {
                en {`Demonstrates how to convert legacy debug constants into strongly‑typed DebugLevel enum values.`},
                el {`Δείχνει πώς μετατρέπονται παλαιού τύπου σταθερές αποσφαλμάτωσης σε ισχυρά τυποποιημένες τιμές enum DebugLevel.`}
            },
            desc:langs {
                en {`This example illustrates how the fromConstant() method can be used to convert legacy debug level constants (such as TCoreHandler::DEBUG_LEVEL_WARNING) into DebugLevel enum values.  
                    The converted enum value is then passed into a custom exception class, which uses a match expression to produce different messages depending on the debug level.  
                    This demonstrates how enums improve type safety, readability, and maintainability while remaining fully compatible with older Ascoos OS components.`},
                el {`Το παράδειγμα αυτό δείχνει πώς η μέθοδος fromConstant() μπορεί να χρησιμοποιηθεί για τη μετατροπή παλαιού τύπου σταθερών επιπέδων αποσφαλμάτωσης (όπως TCoreHandler::DEBUG_LEVEL_WARNING) σε τιμές enum DebugLevel.  
                    Η μετατρεμένη τιμή enum περνά στη συνέχεια σε μια προσαρμοσμένη κλάση εξαίρεσης, η οποία χρησιμοποιεί έκφραση match για να παράγει διαφορετικά μηνύματα ανάλογα με το επίπεδο αποσφαλμάτωσης.  
                    Αυτό αναδεικνύει πώς τα enums βελτιώνουν την τυποποίηση, την αναγνωσιμότητα και τη συντηρησιμότητα, παραμένοντας πλήρως συμβατά με παλαιότερα στοιχεία του Ascoos OS.`}
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
use ASCOOS\OS\Kernel\Core\TCoreHandler;

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
    throw new MyException(DebugLevel::fromConstant(TCoreHandler::DEBUG_LEVEL_WARNING));
} catch (MyException $e) {
    echo $e->getMessage();  // Bad Request - Warning Message
}

print_stats($startTime, $startMem);
?>