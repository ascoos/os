# 📦 TTorrentFileHandler – Παραδείγματα Χρήσης

Αυτό το πακέτο περιλαμβάνει παραδείγματα χρήσης της κλάσης `TTorrentFileHandler` του ASCOOS Framework για διαχείριση αρχείων `.torrent`.

---

## 🧩 Κλάση: `TTorrentFileHandler`

Η κλάση επεκτείνει την `TArrayHandler` και παρέχει μεθόδους για:

- Ανάγνωση
- Ενημέρωση
- Επανακωδικοποίηση
- Ανέβασμα
- Κατέβασμα
- Επικύρωση
- Δημιουργία
- Σύγκριση

---

## 🛠️ Μέθοδοι

| Μέθοδος | Περιγραφή |
|--------|-----------|
| `readTorrentFile()` | Διαβάζει και αποκωδικοποιεί αρχείο torrent |
| `displayTorrentInfo()` | Εμφανίζει τις πληροφορίες του torrent |
| `updateAndEncode()` | Ενημερώνει και επανακωδικοποιεί τα δεδομένα |
| `uploadPieces()` | Ανεβάζει κομμάτια σε peers |
| `downloadPieces()` | Κατεβάζει κομμάτια από peers |
| `validateUrl()` | Ελέγχει την εγκυρότητα του tracker URL |
| `createTorrentFile()` | Δημιουργεί νέο αρχείο torrent |
| `compareTorrents()` | Συγκρίνει δύο αρχεία torrent |
| `checkIntegrity()` | Ελέγχει τη συνοχή των κομματιών |
| `setAnnounceUrl()` / `getAnnounceUrl()` | Ορισμός / Ανάκτηση του announce URL |
| `setComment()` / `getComment()` | Ορισμός / Ανάκτηση σχολίου |
| `setFiles()` / `getFiles()` | Ορισμός / Ανάκτηση λίστας αρχείων |
| `setName()` / `getName()` | Ορισμός / Ανάκτηση ονόματος torrent |
| `setCreatedDate()` / `getCreatedDate()` | Ορισμός / Ανάκτηση ημερομηνίας δημιουργίας |
| `getAnnounceList()` / `addAnnounceToList()` | Ανάκτηση / Προσθήκη στη λίστα announce |
| `isTorrentFile()` | Έλεγχος εγκυρότητας αρχείου torrent |

---

## 📂 Παραδείγματα

| Αρχείο | Περιγραφή |
|--------|-----------|
| `announceUrl.php` | Προσθήκη ή αλλαγή του announce URL |
| `checkIntegrity.php` | Έλεγχος συνοχής κομματιών |
| `compareTorrents.php` | Σύγκριση αρχείων torrent |
| `create.php` | Δημιουργία αρχείου torrent |
| `displayInfo.php` | Εμφάνιση πληροφοριών του torrent |
| `download.php` | Κατέβασμα κομματιών από peers |
| `readTorrentFile.php` | Ανάγνωση και αποκωδικοποίηση αρχείου torrent |
| `updateAndEncode.php` | Ενημέρωση και επανακωδικοποίηση δεδομένων |
| `upload.php` | Ανέβασμα κομματιών σε peers |
| `validateUrl.php` | Έλεγχος εγκυρότητας του tracker URL |

---

## 🚀 Χρήση

1. Ορίστε τη μεταβλητή `$AFW_EXTRAS_PATH` ώστε να δείχνει στον φάκελο extras του ASCOOS:

   ```php
   global $AFW_EXTRAS_PATH;
   ```

2. Εκτελέστε τα παραδείγματα μέσω CLI:

   ```bash
   php readTorrentFile.php
   php updateAndEncode.php
   php upload.php
   php validateUrl.php
   ```

---

## 📌 Σημείωση

Η κλάση αυτή χρησιμοποιείται ενεργά στην εφαρμογή **Web Torrent Client**, η οποία εκτελείται ως εγγενής εφαρμογή μέσα στο Ascoos CMS.

---

## 📄 Άδεια

Το έργο αποτελεί μέρος του ASCOOS Framework και διέπεται από τους όρους άδειας χρήσης του.

