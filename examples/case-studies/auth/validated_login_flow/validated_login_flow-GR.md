# Επικύρωση και Αυθεντικοποίηση Χρήστη με Καταγραφή Γεγονότων

Αυτή η μελέτη περίπτωσης παρουσιάζει πώς το **Ascoos OS** μπορεί να επικυρώσει τα credentials ενός χρήστη πριν την αυθεντικοποίηση, καταγράφοντας τα αντίστοιχα γεγονότα. Το σύστημα αξιοποιεί modular handlers για επικύρωση, αυθεντικοποίηση και διαχείριση γεγονότων.

## Σκοπός
- Επικύρωση credentials χρήστη με κανόνες
- Αυθεντικοποίηση χρήστη βάσει επικυρωμένων δεδομένων
- Καταγραφή γεγονότων επιτυχίας ή αποτυχίας

## Κύριες Κλάσεις του Ascoos OS
- **TValidationHandler**  
  Επικύρωση δεδομένων σύμφωνα με προκαθορισμένους κανόνες  
- **TAuthenticationHandler**  
  Αυθεντικοποίηση χρήστη και δημιουργία token  
- **TEventHandler**  
  Καταγραφή και διαχείριση γεγονότων  

## Δομή Αρχείων
Η υλοποίηση βρίσκεται σε ένα αρχείο PHP:
- [`validated_login_flow.php`](validated_login_flow.php)

Περιλαμβάνει όλη τη λογική: επικύρωση, αυθεντικοποίηση και καταγραφή γεγονότων.

## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο το **Ascoos OS** ή το [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Ορίζονται ρυθμίσεις για καταγραφή σε αρχείο `validated_login.log`.
2. Αρχικοποιούνται οι handlers επικύρωσης, αυθεντικοποίησης και γεγονότων.
3. Συνδέονται οι handlers με τον διαχειριστή γεγονότων.
4. Καταχωρούνται γεγονότα:
   - `validation.failed`: αποτυχία επικύρωσης
   - `auth.success`: επιτυχής αυθεντικοποίηση
   - `auth.failed`: αποτυχία αυθεντικοποίησης
5. Ορίζονται credentials χρήστη και κανόνες επικύρωσης.
6. Αν η επικύρωση αποτύχει, καταγράφεται το σφάλμα και επιστρέφεται JSON με τα λάθη.
7. Αν η αυθεντικοποίηση πετύχει, δημιουργείται token και καταγράφεται επιτυχία.
8. Αν αποτύχει, καταγράφεται αποτυχία.
9. Επιστρέφεται JSON με το αποτέλεσμα.

## Παράδειγμα Κώδικα
```php
$auth = new TAuthenticationHandler($properties);
$validator = new TValidationHandler($properties);
$events = new TEventHandler([], $properties);

$auth->setEventHandler($events);
$validator->setEventHandler($events);

$events->register('login', 'validation.failed', fn($errors) => $events->logger->log("Validation failed: " . json_encode($errors)));
$events->register('login', 'auth.success', fn($user) => $events->logger->log("Authentication successful for: $user"));
$events->register('login', 'auth.failed', fn($user) => $events->logger->log("Authentication failed for: $user"));

$credentials = ['username' => 'admin', 'password' => 'securePass123'];
$rules = ['username' => 'required|string|min:3', 'password' => 'required|string|min:8'];

if (!$validator->validate($credentials, $rules)) {
    $validator->emit('validation.failed', $validator->getErrors());
    echo json_encode(['status' => 'validation_error', 'errors' => $validator->getErrors()], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return;
}

if ($auth->authenticate($credentials)) {
    $token = $auth->generateToken();
    $auth->emit('auth.success', $credentials['username']);
} else {
    $auth->emit('auth.failed', $credentials['username']);
    $token = null;
}

echo json_encode([
    'user' => $credentials['username'],
    'authenticated' => $token !== null,
    'token' => $token
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

## Αναμενόμενο Αποτέλεσμα
Αν η επικύρωση αποτύχει:
```json
{
  "status": "validation_error",
  "errors": {
    "password": "Το πεδίο password πρέπει να έχει τουλάχιστον 8 χαρακτήρες."
  }
}
```

Αν η αυθεντικοποίηση πετύχει:
```json
{
  "user": "admin",
  "authenticated": true,
  "token": "..."
}
```

Αν αποτύχει:
```json
{
  "user": "admin",
  "authenticated": false,
  "token": null
}
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να επεκτείνετε τη λογική προσθέτοντας επιπλέον γεγονότα, υποστήριξη για πολλαπλούς χρήστες ή εναλλακτικούς μηχανισμούς αυθεντικοποίησης. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Αυτή η μελέτη καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
