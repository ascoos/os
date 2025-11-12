# Συνθέτης Ροής Μακροεντολών με Νευρωνικά Δίκτυα

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να εκτελέσει μακροεντολές με βάση το ιστορικό του συστήματος, χρησιμοποιώντας νευρωνικά δίκτυα. Το σύστημα μαθαίνει από προηγούμενα δεδομένα και προβλέπει τη βέλτιστη ενέργεια.

## Σκοπός
- Εκπαίδευση νευρωνικού δικτύου με ιστορικά δεδομένα
- Πρόβλεψη εκτέλεσης μακροεντολής
- Εκτέλεση μακροεντολών βάσει πρόβλεψης

## Κύριες Κλάσεις του Ascoos OS
- **TNeuralNetworkHandler**  
  Σύνθεση, εκπαίδευση και πρόβλεψη νευρωνικού δικτύου  
- **TMacroHandler**  
  Ορισμός και εκτέλεση μακροεντολών  

## Δομή Αρχείων
Η υλοποίηση βρίσκεται σε ένα αρχείο PHP:
- [`neural_workflow_composer.php`](https://github.com/ascoos/os/blob/main/examples/case-studies/ai/neural/neural_workflow_composer/neural_workflow_composer.php)

Περιλαμβάνει όλη τη λογική: προετοιμασία δεδομένων, εκπαίδευση μοντέλου, πρόβλεψη και εκτέλεση μακροεντολών.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Ορίζονται ιστορικά δεδομένα συστήματος (CPU, RAM, Δίσκος).
2. Συντίθεται νευρωνικό δίκτυο με δύο επίπεδα:
   - Είσοδος: 3 → Κρυφό: 4 (ReLU)
   - Κρυφό: 4 → Έξοδος: 1 (Sigmoid)
3. Το μοντέλο εκπαιδεύεται με `fit()` για 1000 εποχές και learning rate 0.01.
4. Αξιολογείται η τρέχουσα κατάσταση συστήματος.
5. Αν η πρόβλεψη είναι > 0.5, εκτελείται macro.
6. Αλλιώς, η μακροεντολή παραλείπεται.

## Παράδειγμα Κώδικα
```php
$composer = new TNeuralNetworkHandler();
$composer->compile([
    ['input' => 3, 'output' => 4, 'activation' => 'relu'],
    ['input' => 4, 'output' => 1, 'activation' => 'sigmoid']
]);
$composer->fit($systemData, $actions, epochs: 1000, lr: 0.01);

$score = $composer->predictNetwork([$currentState])[0];

if ($score > 0.5) {
    $macroHandler = new TMacroHandler();
    $macroHandler->addMacro(fn() => print("Εκτέλεση βελτιστοποιημένης μακροεντολής"), [], delay: 0, priority: 1);
    $macroHandler->runNext();
} else {
    print("Η μακροεντολή παραλείφθηκε βάσει πρόβλεψης\n");
}
```

## Αναμενόμενο Αποτέλεσμα
Αν η πρόβλεψη είναι υψηλή:
```
Εκτέλεση βελτιστοποιημένης μακροεντολής
```
Αλλιώς:
```
Η μακροεντολή παραλείφθηκε βάσει πρόβλεψης
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να βελτιώσετε το μοντέλο, να ενσωματώσετε επιπλέον μετρικές συστήματος ή να επεκτείνετε τη λογική των μακροεντολών. Δείτε το [CONTRIBUTING.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](https://github.com/ascoos/os/blob/main/LICENSE.md).
