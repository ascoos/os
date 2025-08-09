# Κλάση TErrorMessageHandler

**Διαχειριστής μηνυμάτων σφαλμάτων με υποστήριξη πολλών γλωσσών για εφαρμογές PHP. Ενσωματώνεται με συστήματα καταγραφής και αποσφαλμάτωσης. Μέρος του Ascoos OS Kernel.**

> #### Επεκτείνει `TArrayHandler`

---

## Χαρακτηριστικά

- 🌐 Πολύγλωσσα μηνύματα σφαλμάτων
- 🪵 Ενσωματωμένη καταγραφή μέσω `TLoggerHandler`
- 🐞 Ανάκτηση πληροφοριών αποσφαλμάτωσης από εξαιρέσεις
- 📄 Υποστήριξη πολλαπλών μορφών εξόδου: HTML, JSON, XML, YAML
- 🧩 Κληρονομεί από `TArrayHandler` για ευέλικτη παραμετροποίηση

## Εγκατάσταση

Η κλάση ως μέρος του βαθιού πυρήνα του **`Ascoos OS`** δεν χρειάζεται εγκατάσταση καθώς φορτώνεται αυτόματα κατά την φόρτωση του `Ascoos OS`.

## Χρήση

### Βασική Αρχικοποίηση

```php
use ASCOOS\OS\Kernel\Core\Errors\Messages\TErrorMessageHandler;

$handler = new TErrorMessageHandler('el', $logger);
```

### Απόδοση HTML Πίνακα Σφάλματος

```php
echo $handler->render(404);
```

### Καταγραφή Σφάλματος

```php
$handler->logError(500, new Exception("Εσωτερικό Σφάλμα Διακομιστή"));
```

### Λήψη Μηνύματος σε Διάφορες Μορφές

```php
echo $handler->getMessage(403);              // Απλό κείμενο
echo $handler->getMessageAsJSON(403);        // JSON
echo $handler->getMessageAsXML(403);         // XML
echo $handler->getMessageAsYAML(403);        // YAML
```

## Αναφορά Μεθόδων

| Μέθοδος                 | Περιγραφή                                         |
|------------------------|--------------------------------------------------|
| `__construct()`         | Αρχικοποιεί τον διαχειριστή με γλώσσα και logger |
| `getMessage()`          | Επιστρέφει μήνυμα σφάλματος για δοθέντα κωδικό   |
| `getDebugInfo()`        | Επιστρέφει λεπτομέρειες αποσφαλμάτωσης           |
| `logError()`            | Καταγράφει το σφάλμα                             |
| `render()`              | Αποδίδει HTML πίνακα                             |
| `getMessageAsJSON()`    | Επιστρέφει μήνυμα σε JSON                        |
| `getMessageAsXML()`     | Επιστρέφει μήνυμα σε XML                         |
| `getMessageAsYAML()`    | Επιστρέφει μήνυμα σε YAML                        |

## Λεπτομερής Τεκμηρίωση
Για περισσότερες λεπτομέρειες (παραμέτρους, τύπους, παραδείγματα), επισκεφθείτε το [Επίσημο Documentation Site](https://docs.ascoos.com) (υπό κατασκευή).

---

## 🔍 Παραδείγματα Χρήσης

### 1. Απόδοση Πίνακα Σφάλματος με Εξαίρεση

```php
try {
    throw new RuntimeException("Database connection failed");
} catch (Throwable $e) {
    echo $handler->render(1001, $e);
}
```

### 2. Καταγραφή Σφάλματος Χωρίς Εξαίρεση

```php
$handler->logError(1002);
```

### 3. Εξαγωγή Μηνύματος σε YAML για DevOps

```php
file_put_contents('error.yaml', $handler->getMessageAsYAML(1003));
```

---

<details>
<summary>🟠 ΚΛΗΡΟΝΟΜΙΕΣ</summary>

Κληρονομεί μέθοδους και ιδιότητες από τις κλάσεις `TArrayHandler` και `TObject`.

</details>

---

## Άδεια Χρήσης

[Ascoos General License](http://docs.ascoos.com/lics/ascoos/AGL.html) © Ascoos OS

---

## Σύνδεσμοι
- [Κλάσεις Πυρήνα](/docs/kernel/CLASS-GR.md)
- [Αναφορά Προβλημάτων](https://issues.ascoos.com)