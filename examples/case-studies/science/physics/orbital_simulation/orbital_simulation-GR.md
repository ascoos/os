# Προσομοίωση Τροχιάς Δορυφόρου

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να προσομοιώσει έναν δορυφόρο σε κυκλική τροχιά γύρω από τη Γη.  
Υπολογίζει βασικές φυσικές ποσότητες και αποθηκεύει τα αποτελέσματα σε JSON, ενώ τα απεικονίζει γραφικά.

## Σκοπός
- Υπολογισμός τροχιακής ταχύτητας
- Υπολογισμός κινητικής και δυναμικής ενέργειας
- Δημιουργία γραφήματος με τις τιμές
- Καταγραφή συμβάντος ολοκλήρωσης
- Αποθήκευση αναφοράς σε JSON

## Κύριες Κλάσεις του Ascoos OS
- **TPhysicsHandler**  
  Υπολογισμοί φυσικής (ταχύτητα, ενέργεια κ.λπ.)  
- **TArrayGraphHandler**  
  Δημιουργία γραφήματος με τις υπολογισμένες τιμές  
- **TEventHandler**  
  Καταγραφή συμβάντων  
- **TErrorMessageHandler**  
  Διαχείριση σφαλμάτων και εξαιρέσεων  

## Δομή Αρχείων
Η υλοποίηση βρίσκεται σε ένα αρχείο PHP:
- [`orbital_simulation.php`](orbital_simulation.php)

Περιλαμβάνει όλη τη λογική: υπολογισμούς, απεικόνιση, καταγραφή και αποθήκευση.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Ορίζονται οι φυσικές παράμετροι του συστήματος (μάζες, ακτίνα, σταθερά G).
2. Υπολογίζεται η τροχιακή ταχύτητα με τον τύπο: `v = √(GM / r)`
3. Υπολογίζεται η κινητική ενέργεια: `K = ½ m v²`
4. Υπολογίζεται η δυναμική ενέργεια: `U = -GMm / r`
5. Δημιουργείται γράφημα με τις τιμές
6. Καταγράφεται συμβάν ολοκλήρωσης
7. Αποθηκεύεται αναφορά σε JSON
8. Εμφανίζεται σύνοψη στην κονσόλα

## Παράδειγμα Κώδικα
```php
$orbitalVelocity = $physicsHandler->OrbitalVelocity($G, $earthMass, $orbitalRadius);
$kineticEnergy = $physicsHandler->KineticEnergy($satelliteMass, $orbitalVelocity);
$potentialEnergy = -$G * $earthMass * $satelliteMass / $orbitalRadius;

$graphHandler->setArray([
    ['label' => 'Orbital Velocity (m/s)', 'value' => $orbitalVelocity],
    ['label' => 'Kinetic Energy (J)', 'value' => $kineticEnergy],
    ['label' => 'Potential Energy (J)', 'value' => $potentialEnergy]
], ['label', 'value']);
$graphHandler->createLineChart($outputPath . '/orbital_simulation.png');
```

## Αναμενόμενο Αποτέλεσμα
```
Orbital Simulation Complete.
Orbital Velocity: 7672.598648 m/s
Kinetic Energy: 29440800000 J
Potential Energy: -58881600000 J
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να επεκτείνετε την προσομοίωση με ελλειπτικές τροχιές, μεταβλητή μάζα ή αλληλεπίδραση με άλλα σώματα. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
