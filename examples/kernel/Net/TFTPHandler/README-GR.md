# Παραδείγματα TFTPHandler

Αυτός ο φάκελος περιέχει παραδείγματα που δείχνουν τη χρήση της κλάσης `TFTPHandler`, μιας προηγμένης κλάσης του **Ascoos OS** για διαχείριση συνδέσεων FTP και SFTP.

Η `TFTPHandler` παρέχει λειτουργίες για ασύγχρονες μεταφορές, πιστοποίηση με κλειδιά, συμπίεση/αποσυμπίεση αρχείων, προστασία CSRF, και ενσωμάτωση με WebFTPClient.

## Σκοπός
Τα παραδείγματα αυτά καταδεικνύουν πώς να χρησιμοποιήσετε τις μεθόδους της `TFTPHandler` σε πραγματικά σενάρια, όπως:
- Δημιουργία και διαχείριση συνδέσεων FTP/SFTP.
- Ασύγχρονες και μαζικές μεταφορές αρχείων.
- Διαχείριση καταλόγων και δικαιωμάτων.
- Καταγραφή δραστηριοτήτων και χρήση cache.

## Δομή
Τα παραδείγματα είναι οργανωμένα με βάση το namespace `ASCOOS\OS\Kernel\Net\TFTPHandler` για συνέπεια με την αρχιτεκτονική του `Ascoos OS`:
- Κάθε παράδειγμα είναι ένα αυτόνομο PHP αρχείο, με όνομα που αντικατοπτρίζει τη μέθοδο που παρουσιάζει (π.χ., `connect.php`).
- Η τεκμηρίωση της κλάσης `TFTPHandler` βρίσκεται στο [`/docs/kernel/net/TFTPHandler/README-GR.md`](/docs/kernel/net/TFTPHandler/README-GR.md).

## Διαθέσιμα Παραδείγματα
| Αρχείο Παραδείγματος | Μέθοδος | Περιγραφή |
|----------------------|---------|-----------|
| [`asyncDownloadFile.php`](asyncDownloadFile.php) | `asyncDownloadFile` | Παρουσιάζει την ασύγχρονη λήψη αρχείου από τον απομακρυσμένο διακομιστή. |
| [`asyncUploadFile.php`](asyncUploadFile.php) | `asyncUploadFile` | Παρουσιάζει την ασύγχρονη μεταφόρτωση αρχείου στον απομακρυσμένο διακομιστή. |
| [`authenticateWithKey.php`](authenticateWithKey.php) | `authenticateWithKey` | Παρουσιάζει την πιστοποίηση με δημόσιο/ιδιωτικό κλειδί για SFTP. |
| [`bulkDownloadFiles.php`](bulkDownloadFiles.php) | `bulkDownloadFiles` | Παρουσιάζει τη μαζική λήψη αρχείων από τον απομακρυσμένο διακομιστή. |
| [`bulkUploadFiles.php`](bulkUploadFiles.php) | `bulkUploadFiles` | Παρουσιάζει τη μαζική μεταφόρτωση αρχείων στον απομακρυσμένο διακομιστή. |
| [`cacheFileList.php`](cacheFileList.php) | `cacheFileList` | Παρουσιάζει την αποθήκευση λίστας καταλόγου σε cache. |
| [`changeDirectory.php`](changeDirectory.php) | `changeDirectory` | Παρουσιάζει την αλλαγή του τρέχοντος καταλόγου στον απομακρυσμένο διακομιστή. |
| [`compressFile.php`](compressFile.php) | `compressFile` | Παρουσιάζει τη συμπίεση αρχείου πριν τη μεταφορά. |
| [`connect.php`](connect.php) | `connect` | Παρουσιάζει τη δημιουργία σύνδεσης FTP ή SFTP. |
| [`createDirectory.php`](createDirectory.php) | `createDirectory` | Παρουσιάζει τη δημιουργία καταλόγου στον απομακρυσμένο διακομιστή. |
| [`decompressFile.php`](decompressFile.php) | `decompressFile` | Παρουσιάζει την αποσυμπίεση αρχείου μετά τη μεταφορά. |
| [`deleteDirectory.php`](deleteDirectory.php) | `deleteDirectory` | Παρουσιάζει τη διαγραφή καταλόγου στον απομακρυσμένο διακομιστή. |
| [`deleteFile.php`](deleteFile.php) | `deleteFile` | Παρουσιάζει τη διαγραφή αρχείου στον απομακρυσμένο διακομιστή. |
| [`disconnect.php`](disconnect.php) | `disconnect` | Παρουσιάζει την αποσύνδεση από τον διακομιστή. |
| [`downloadFile.php`](downloadFile.php) | `downloadFile` | Παρουσιάζει τη λήψη αρχείου από τον απομακρυσμένο διακομιστή. |
| [`enablePassiveMode.php`](enablePassiveMode.php) | `enablePassiveMode` | Παρουσιάζει την ενεργοποίηση ή απενεργοποίηση passive mode για FTP. |
| [`generateCsrfToken.php`](generateCsrfToken.php) | `generateCsrfToken` | Παρουσιάζει τη δημιουργία CSRF token για ασφάλεια web εφαρμογών. |
| [`getFilePermissions.php`](getFilePermissions.php) | `getFilePermissions` | Παρουσιάζει την ανάκτηση δικαιωμάτων αρχείου ή καταλόγου. |
| [`getCurrentDirectory.php`](getCurrentDirectory.php) | `getCurrentDirectory` | Παρουσιάζει την ανάκτηση του τρέχοντος καταλόγου. |
| [`getTransferStats.php`](getTransferStats.php) | `getTransferStats` | Παρουσιάζει την ανάκτηση στατιστικών μεταφοράς αρχείων. |
| [`listDirectory.php`](listDirectory.php) | `listDirectory` | Παρουσιάζει τη λίστα περιεχομένων απομακρυσμένου καταλόγου. |
| [`logActivity.php`](logActivity.php) | `logActivity` | Παρουσιάζει την καταγραφή δραστηριοτήτων FTP/SFTP. |
| [`login.php`](login.php) | `login` | Παρουσιάζει τη σύνδεση στον διακομιστή με όνομα χρήστη και κωδικό. |
| [`monitorTransferProgress.php`](monitorTransferProgress.php) | `monitorTransferProgress` | Παρουσιάζει την παρακολούθηση προόδου μεταφοράς αρχείων. |
| [`reconnect.php`](reconnect.php) | `reconnect` | Παρουσιάζει την επανασύνδεση στον διακομιστή. |
| [`restoreFileListFromCache.php`](restoreFileListFromCache.php) | `restoreFileListFromCache` | Παρουσιάζει την επαναφορά λίστας καταλόγου από cache. |
| [`restoreSession.php`](restoreSession.php) | `restoreSession` | Παρουσιάζει την επαναφορά συνεδρίας για web εφαρμογές. |
| [`saveSession.php`](saveSession.php) | `saveSession` | Παρουσιάζει την αποθήκευση συνεδρίας για web εφαρμογές. |
| [`setFilePermissions.php`](setFilePermissions.php) | `setFilePermissions` | Παρουσιάζει τον ορισμό δικαιωμάτων για αρχείο ή κατάλογο. |
| [`uploadFile.php`](uploadFile.php) | `uploadFile` | Παρουσιάζει τη μεταφόρτωση αρχείου στον απομακρυσμένο διακομιστή. |
| [`validateCsrfToken.php`](validateCsrfToken.php) | `validateCsrfToken` | Παρουσιάζει την επικύρωση CSRF token για ασφάλεια web εφαρμογών. |

## Ξεκινώντας
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κύριο αποθετήριο](https://github.com/ascoos/os)). Εάν χρησιμοποιείτε την σουίτα ανάπτυξης [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), τότε δεν χρειάζεται να εγκαταστήσετε το `Ascoos OS` καθώς είναι ρυθμισμένο να προφορτώνεται.
2. Πλοηγηθείτε στα αρχεία παραδειγμάτων στο `/examples/kernel/net/TFTPHandler/`.
3. Εκτελέστε τα PHP αρχεία (π.χ., `https://localhost/aos/examples/kernel/net/TFTPHandler/connect.php`) για να δείτε το αποτέλεσμα.

## Παράδειγμα Χρήσης
```php
use ASCOOS\OS\Kernel\Net\TFTPHandler;

$ftpHandler = new TFTPHandler([
    'ftp' => [
        'protocol' => 'sftp',
        'host' => 'example.com',
        'port' => 22,
        'username' => 'user',
        'password' => 'pass'
    ],
    'logs' => ['useLogger' => true, 'dir' => $AOS_LOGS_PATH],
    'cache' => ['cacheType' => 'file', 'cachePath' => $AOS_CACHE_PATH]
]);
if ($ftpHandler->connect('example.com', 22, 'user', 'pass', false)) {
    echo "Σύνδεση επιτυχής\n";
}
$ftpHandler->Free($ftpHandler);
```

## Πόροι
- [Τεκμηρίωση TFTPHandler](/docs/kernel/net/TFTPHandler/)
- [Τεκμηρίωση Ascoos OS](/docs/)
- [Αποθετήριο GitHub](https://github.com/ascoos/os)
- [Ascoos OS στο LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS στο X](https://www.x.com/ascoos)

## Συνεισφορά
Θέλετε να προσθέσετε περισσότερα παραδείγματα; Κάντε fork το αποθετήριο, δημιουργήστε ένα νέο αρχείο παραδείγματος και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Τα παραδείγματα αυτά υπόκεινται στην Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
