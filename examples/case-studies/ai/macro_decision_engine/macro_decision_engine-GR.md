# Μηχανή Μακροεντολών με Προβλέψεις AI

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να εκτελέσει macros βάσει προβλέψεων AI, συνδυάζοντας λογιστική παλινδρόμηση με DSL (Domain-Specific Language). Χρησιμοποιούνται οι κλάσεις `TArtificialIntelligenceHandler`, `AbstractDslAstBuilder` και `AstMacroTranslator` για να εκπαιδεύσουμε ένα μοντέλο, να αναλύσουμε κανόνες σε AST, να τους μεταφράσουμε σε μακροεντολές και να τους εκτελέσουμε δυναμικά.

## Σκοπός
- Εκπαίδευση μοντέλου με `trainLogisticRegression()`  
- Δημιουργία AST από DSL με `AbstractDslAstBuilder`  
- Μετάφραση AST σε εκτελέσιμα macros με `AstMacroTranslator`  
- Εκτέλεση των macros όταν οι προβλέψεις ικανοποιούν συνθήκη

## Κύριες Κλάσεις του Ascoos OS
- **TArtificialIntelligenceHandler**  
  Εκπαίδευση και πρόβλεψη μοντέλων λογιστικής παλινδρόμησης  
- **AbstractDslAstBuilder**  
  Ανάλυση DSL γραμμών σε Abstract Syntax Tree  
- **AstMacroTranslator**  
  Μετατροπή AST σε container με callbacks για κάθε macro  

## Δομή Αρχείων
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`macro_decision_engine.php`](macro_decision_engine.php)
Περιέχει ολόκληρο τον κώδικα: φόρτωση δεδομένων, εκπαίδευση, DSL parsing, μετάφραση και εκτέλεση macros.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS**. Αν χρησιμοποιείτε το [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), είναι ήδη προεγκατεστημένο.

## Ξεκινώντας
1. Προσαρμόστε τα training data (`$X`, `$y`) κατά βούληση.  
2. Εκτελέστε το script μέσω web server:
   ```
   https://localhost/aos/examples/case-studies/ai/macro_decision_engine/macro_decision_engine.php
   ```

## Παράδειγμα DSL
```dsl
WHEN predict(user.features) > 0.5 THEN
    LOG "User is eligible"
    ENABLE MODULE "AdvancedAnalytics"
```

## Ροή Εκτέλεσης
1. Ο `TArtificialIntelligenceHandler` εκπαιδεύει ένα μοντέλο logistic regression με δεδομένα `$X` και `$y`.  
2. Το `AbstractDslAstBuilder` μετατρέπει το DSL script σε AST nodes.  
3. Ο `AstMacroTranslator` χαρτογραφεί κάθε node σε callback:
   - `LOG` → εκτύπωση μηνύματος  
   - `ENABLE MODULE` → ενεργοποίηση συγκεκριμένου module  
   - `predict` → κλήση σε `predictLogisticRegression()`  
4. Το `TMacroHandler` εκτελεί τις εντολές μόνο αν η πρόβλεψη υπερβαίνει το όριο (`> 0.5`).

## Παράδειγμα Κώδικα
```php
// Εκπαίδευση μοντέλου
$ai    = new TArtificialIntelligenceHandler();
$model = $ai->trainLogisticRegression($X, $y);

// DSL script
$dsl = <<<DSL
WHEN predict(user.features) > 0.5 THEN
    LOG "User is eligible"
    ENABLE MODULE "AdvancedAnalytics"
DSL;

// AST & μετάφραση
$astBuilder      = new class extends AbstractDslAstBuilder {};
$ast             = $astBuilder->buildAst($dsl);
$translator      = new class([...]) extends AstMacroTranslator {};
$macroContainer  = $translator->translateAst($ast);

// Εκτέλεση βάσει χρήστη
$user = ['features' => [1, 1, 0]];
$macroContainer->executeIfTrue($user);
```

## Αναμενόμενο Αποτέλεσμα
Εάν η πρόβλεψη `predict([1,1,0])` > 0.5:
```
📣 User is eligible
✅ Module enabled: AdvancedAnalytics
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [GitHub Repository](https://github.com/ascoos/os)  
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)  
- [phpBCL8](https://github.com/ascoos/phpbcl8)  

## Συνεισφορά
Θέλετε να συνεισφέρετε σε αυτή τη μελέτη περίπτωσης; Κάντε fork το αποθετήριο, προσθέστε νέα macros ή βελτιώσεις DSL στο `macro_decision_engine.php` και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).