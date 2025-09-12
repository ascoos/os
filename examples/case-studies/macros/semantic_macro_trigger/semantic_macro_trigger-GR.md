# Ενεργοποίηση Μακροεντολών βάσει NLP Ανάλυσης Συντακτικού Περιεχομένου

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να εκτελέσει μακροεντολές βάσει νοηματικής ανάλυσης συντακτικού περιεχομένου. Χρησιμοποιεί τεχνικές NLP για να εντοπίσει το συναίσθημα και τη θεματική του άρθρου, και ενεργοποιεί macros μέσω DSL script που μετατρέπεται σε AST.

## Σκοπός
- Ανάλυση άρθρου με `TLanguageProcessingAIHandler`
- Εντοπισμός συναισθήματος και ενεργοποιημένων εννοιών
- Ορισμός λογικής macro μέσω DSL
- Μετάφραση DSL σε εκτελέσιμες εντολές
- Εκτέλεση macros όταν πληρούνται νοηματικές συνθήκες

## Κύριες Κλάσεις του Ascoos OS
- **TLanguageProcessingAIHandler**  
  NLP ανάλυση, εντοπισμός θεμάτων και συναισθήματος  
- **AbstractDslAstBuilder**  
  Ανάλυση DSL σε AST κόμβους  
- **AstMacroTranslator**  
  Μετατροπή AST σε εκτελέσιμες ενέργειες και συνθήκες  

## Δομή Αρχείων
Η μελέτη υλοποιείται σε ένα αρχείο PHP:
- [`semantic_macro_trigger.php`](semantic_macro_trigger.php)

Περιλαμβάνει όλη τη λογική: NLP ανάλυση, DSL parsing, AST μετάφραση και εκτέλεση εντολών.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES`](https://awes.ascoos.com)

## Παράδειγμα DSL
```dsl
WHEN sentiment = negative AND topic = "economy" THEN
    TAG "alert"
    NOTIFY "Editor"
    FLAG "Review"
```

## Ροή Εκτέλεσης
1. Ο `TLanguageProcessingAIHandler` αναλύει το άρθρο.
2. Το συναίσθημα εξάγεται με `naiveBayesSentiment()`.
3. Οι έννοιες ενεργοποιούνται με `conceptActivationVector()`.
4. Το DSL μετατρέπεται σε AST με `AbstractDslAstBuilder`.
5. Ο `AstMacroTranslator` χαρτογραφεί:
   - `TAG` → προσθήκη ετικέτας  
   - `NOTIFY` → ειδοποίηση συντάκτη  
   - `FLAG` → επισήμανση για αναθεώρηση  
6. Οι εντολές εκτελούνται μόνο αν η συνθήκη είναι αληθής.

## Παράδειγμα Κώδικα
```php
$text = "...";
$nlp = new TLanguageProcessingAIHandler();
$sentiment = $nlp->naiveBayesSentiment($text);
$concepts  = $nlp->conceptActivationVector([...], [$text]);

$dsl = <<<DSL
WHEN sentiment = negative AND topic = "economy" THEN
    TAG "alert"
    NOTIFY "Editor"
    FLAG "Review"
DSL;

$astBuilder = new class extends AbstractDslAstBuilder {};
$ast        = $astBuilder->buildAst($dsl);

$translator = new class([...]) extends AstMacroTranslator {};
$macroContainer = $translator->translateAst($ast);
$macroContainer->executeIfTrue();
```

## Αναμενόμενο Αποτέλεσμα
Εάν το συναίσθημα είναι αρνητικό και η θεματική είναι "economy":
```
🏷️ Tagged: alert
📬 Notification sent to: Editor
🚩 Flagged for: Review
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να επεκτείνετε το DSL με νέες εντολές, να ενσωματώσετε επιπλέον NLP μοντέλα ή να προσαρμόσετε τις ενέργειες macro. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
