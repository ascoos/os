# Συνθετική Ανάλυση Μακροεντολών

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να οργανώσει την εκτέλεση μακροεντολών με χρήση συνθετικής ανάλυσης, DSL scripting, NLP και πρόβλεψη μέσω AI. Το σύστημα αναλύει συντακτικό περιεχόμενο, εντοπίζει συναίσθημα και θεματική, μεταφράζει DSL σε μακροεντολές και τις εκτελεί βάσει βαθμολογίας νευρωνικού δικτύου.

---

## Σκοπός
- Ανάλυση περιεχομένου με NLP
- Πρόβλεψη εκτέλεσης μακροεντολής με AI
- Μετάφραση DSL σε AST και εκτέλεση
- Οπτικοποίηση semantic scores και αποθήκευση αποτελεσμάτων

---

## Κύριες Κλάσεις του Ascoos OS
- **TLanguageProcessingAIHandler**  
  Ανίχνευση συναισθήματος και θεματικής  
- **TNeuralNetworkHandler**  
  Σύνθεση, εκπαίδευση και πρόβλεψη νευρωνικού δικτύου  
- **AbstractDslAstBuilder**  
  Ανάλυση DSL και δημιουργία AST  
- **AstMacroTranslator**  
  Μετάφραση και εκτέλεση μακροεντολών  
- **TChartsHandler**  
  Δημιουργία γραφήματος semantic scores  
- **TFilesHandler**  
  Δημιουργία JSON αναφοράς και διαχείριση αρχείων  
- **TEventHandler**  
  Καταγραφή συμβάντων μακροεντολών  
- **TErrorMessageHandler**  
  Διαχείριση σφαλμάτων και μηνυμάτων

---

## Δομή Αρχείων
Η υλοποίηση βρίσκεται σε ένα αρχείο PHP:
- [`semantic_macro_profiler.php`](https://github.com/ascoos/os/blob/main/examples/case-studies/ai/semantic_macro_profiler/semantic_macro_profiler.php)

Περιλαμβάνει όλη τη λογική: NLP ανάλυση, πρόβλεψη AI, ανάλυση DSL, εκτέλεση μακροεντολών και αναφορά.

---

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES 26`](https://awes.ascoos.com)

---

## Ροή Εκτέλεσης
1. Ορίζεται macro script σε DSL με semantic συνθήκες.
2. Αναλύεται το περιεχόμενο με NLP:
   - Ανίχνευση συναισθήματος (θετικό, ουδέτερο, αρνητικό)
   - Εξαγωγή ενεργοποιημένων εννοιών
3. Συντίθεται και εκπαιδεύεται νευρωνικό δίκτυο:
   - Είσοδος: 3 → Κρυφό: 4 (ReLU)
   - Κρυφό: 4 → Έξοδος: 1 (Sigmoid)
4. Υπολογίζεται βαθμολογία πρόβλεψης.
5. Αν η βαθμολογία > 0.5, εκτελείται macro.
6. Δημιουργείται γράφημα και αποθηκεύεται JSON αναφορά.

---

## Παράδειγμα Κώδικα
```php
$sentiment = $nlp->naiveBayesSentiment($text);
$concepts  = $nlp->conceptActivationVector([...], [$text]);

$ai->compile([...]);
$ai->fit([...], [...], epochs: 500, lr: 0.01);
$score = $ai->predictNetwork([[...]])[0];

if ($score > 0.5) {
    $macroContainer->executeIfTrue();
}
```

---

## Αναμενόμενο Αποτέλεσμα
Αν η πρόβλεψη είναι υψηλή:
```
Εκτέλεση μακροεντολής: audit_macro
```
Αλλιώς:
```
Η μακροεντολή παραλείφθηκε λόγω χαμηλής πρόβλεψης AI
```

---

## Πόροι
- [Τεκμηρίωση Ascoos OS](https://docs.ascoos.com/os)  
- [Επίσημη ιστοσελίδα Ascoos OS](https://os.ascoos.com)  
- [AWES Studio](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

---

## Συνεισφορά
Μπορείτε να επεκτείνετε τη λογική των μακροεντολών, να ενσωματώσετε επιπλέον semantic triggers ή να βελτιώσετε το AI μοντέλο. Δείτε το [CONTRIBUTING.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING.md) για οδηγίες.

---

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](https://github.com/ascoos/os/blob/main/LICENSE.md).
