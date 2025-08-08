# Κλάσεις Πυρήνα - Ascoos OS

Ο πυρήνας του Ascoos OS περιλαμβάνει βασικές κλάσεις για τη διαχείριση του πλαισίου.

## Βασικές Κλάσεις
| Κλάση | Περιγραφή |
|-------|-----------|
| `TArrayHandler` | Διαχείριση πινάκων με μετατροπές (JSON, CSV, XML, κ.λπ.) και καθαρισμό. |
| `TDebugHandler` | Εντοπισμός σφαλμάτων με χρονομέτρηση και προσαρμοσμένους handlers. |
| `TLoggerHandler` | Καταγραφή μηνυμάτων (INFO, WARNING, ERROR). |
| [`TObject`](/docs/kernel/core/TObject/README-GR.md) | Βάση όλων των κλάσεων, παρέχει versioning και debugging. |
| `TPHPHandler` | Διαχείριση PHP ρυθμίσεων, επεκτάσεων, και περιβάλλοντος. |

## Χρήση
Οι κλάσεις φορτώνονται αυτόματα μέσω `autoload.php`. Χρησιμοποιήστε το namespace `ASCOOS\OS\`.

## Παραδείγματα
Δείτε το `/examples/kernel/` για παραδείγματα.

## Σύνδεσμοι
- [Επίσημη Ιστοσελίδα Τεκμηρίωσης](https://docs.ascoos.com) (Υπό κατασκευή)
- [Bug Tracker](https://issues.ascoos.com)