# Κλάση `TFTPHandler`

***Βελτιωμένος χειριστής FTP/SFTP με υποστήριξη για ασύγχρονες μεταφορές, πιστοποίηση με δημόσιο κλειδί, συμπίεση αρχείων, προστασία CSRF και ενσωμάτωση με WebFTPClient.***

> #### Κληρονομεί `TSocketHandler`

## Χρήση
```php
use ASCOOS\OS\Kernel\Net\TFTPHandler;

// Αρχικοποίηση με διαμόρφωση
$ftpConfig = [
    'ftp' => [
        'protocol' => 'sftp',
        'host' => 'example.com',
        'port' => 22,
        'username' => 'user',
        'password' => 'pass',
        'useAsync' => true
    ],
    'logs' => ['useLogger' => true],
    'cache' => ['cacheType' => 'file']
];
$ftpHandler = new TFTPHandler($ftpConfig);

// Σύνδεση στον διακομιστή
$ftpHandler->connect('example.com', 22, 'user', 'pass', false);
```

[Δείτε παραδείγματα χρήσης](/examples/kernel/net/TFTPHandler/README-GR.md).

## Λεπτομερής Τεκμηρίωση
Για πλήρεις λεπτομέρειες (παραμέτρους, τύπους, παραδείγματα), επισκεφθείτε το [Επίσημο Documentation Site](https://docs.ascoos.com) (υπό κατασκευή).

---

## Ιδιότητες
| Ιδιότητα | Τύπος | Περιγραφή |
|----------|-------|-----------|
| `ftpConnection` | `mixed` | Ο πόρος σύνδεσης FTP/SFTP (`FTP\Connection` για FTP, `resource` για SFTP). |
| `protocol` | `string` | Το πρωτόκολλο που χρησιμοποιείται ('ftp' ή 'sftp'). |
| `connectionConfig` | `array` | Διαμόρφωση για τη σύνδεση FTP/SFTP (host, port, username, password, κλπ.). |
| `logger` | `?TLoggerHandler` | Αντικείμενο καταγραφής για δραστηριότητες FTP/SFTP (κληρονομείται). |
| `debugger` | `?TDebugHandler` | Αντικείμενο αποσφαλμάτωσης για λεπτομερή αποσφαλμάτωση (κληρονομείται). |
| `phpHandler` | `?TPHPHandler` | Διαχειριστής περιβάλλοντος PHP (κληρονομείται). |
| `cache` | `?TCacheHandler` | Διαχειριστής cache για αποθήκευση μεταδεδομένων σύνδεσης και αρχείων (κληρονομείται). |
| `files` | `?TFilesHandler` | Διαχειριστής αρχείων για τοπικές λειτουργίες αρχείων. |
| `transferStats` | `array` | Στατιστικά για μεταφορές αρχείων (bytes που στάλθηκαν/λήφθηκαν, χρόνος, κλπ.). |
| `useAsync` | `bool` | Αν θα χρησιμοποιηθούν ασύγχρονες μεταφορές. |
| `publicKey` | `?string` | Διαδρομή προς το δημόσιο κλειδί για πιστοποίηση SFTP. |
| `privateKey` | `?string` | Διαδρομή προς το ιδιωτικό κλειδί για πιστοποίηση SFTP. |
| `sessionId` | `?string` | Αναγνωριστικό συνεδρίας για διατήρηση κατάστασης σύνδεσης σε εφαρμογές web. |

### Κλειδιά του `connectionConfig`
| Κλειδί | Τύπος | Περιγραφή |
|--------|-------|-----------|
| `host` | `string` | Το όνομα κεντρικού υπολογιστή ή διεύθυνση IP (προεπιλογή: 'localhost'). |
| `port` | `int` | Η θύρα του διακομιστή (προεπιλογή: 21 για FTP, 22 για SFTP). |
| `username` | `string` | Το όνομα χρήστη για πιστοποίηση (προεπιλογή: ''). |
| `password` | `string` | Ο κωδικός πρόσβασης για πιστοποίηση (προεπιλογή: ''). |
| `useSSL` | `bool` | Αν θα χρησιμοποιηθεί SSL/TLS για τη σύνδεση (προεπιλογή: false). |
| `passive` | `bool` | Αν θα χρησιμοποιηθεί η λειτουργία passive του FTP (προεπιλογή: true). |
| `timeout` | `int` | Χρόνος λήξης σύνδεσης σε δευτερόλεπτα (προεπιλογή: 30). |
| `useAsync` | `bool` | Αν θα χρησιμοποιηθούν ασύγχρονες μεταφορές (προεπιλογή: false). |
| `publicKey` | `?string` | Διαδρομή προς το δημόσιο κλειδί για πιστοποίηση SFTP (προεπιλογή: null). |
| `privateKey` | `?string` | Διαδρομή προς το ιδιωτικό κλειδί για πιστοποίηση SFTP (προεπιλογή: null). |

## Μέθοδοι
| Μέθοδος | Επιστροφή | Περιγραφή |
|---------|-----------|-----------|
| `__construct(array $properties = [])` | `void` | Αρχικοποιεί τον χειριστή FTP/SFTP με ιδιότητες διαμόρφωσης. |
| `asyncDownloadFile(string $remoteFile, string $localFile, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Κατεβάζει ασύγχρονα ένα αρχείο από τον απομακρυσμένο διακομιστή. |
| `asyncUploadFile(string $localFile, string $remoteFile, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Ανεβάζει ασύγχρονα ένα αρχείο στον απομακρυσμένο διακομιστή. |
| `authenticateWithKey(string $username, string $publicKey, string $privateKey, string $passphrase = '')` | `bool` | Πιστοποιείται στον διακομιστή SFTP με δημόσιο/ιδιωτικό κλειδί. |
| `bulkDownloadFiles(array $files, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Κατεβάζει πολλαπλά αρχεία από τον απομακρυσμένο διακομιστή. |
| `bulkUploadFiles(array $files, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Ανεβάζει πολλαπλά αρχεία στον απομακρυσμένο διακομιστή. |
| `cacheFileList(string $remoteDir, string $cacheKey)` | `bool` | Αποθηκεύει τη λίστα καταλόγου σε cache για ταχύτερη πρόσβαση. |
| `changeDirectory(string $remoteDir)` | `bool` | Αλλάζει τον τρέχοντα κατάλογο στον απομακρυσμένο διακομιστή. |
| `compressFile(string $source, string $destination, string $format = 'zip')` | `bool` | Συμπιέζει ένα αρχείο πριν τη μεταφορά. |
| `connect(string $host, int $port = 21, string $username = '', string $password = '', bool $useSSL = false)` | `bool` | Δημιουργεί σύνδεση FTP ή SFTP. |
| `createDirectory(string $remoteDir)` | `bool` | Δημιουργεί έναν κατάλογο στον απομακρυσμένο διακομιστή. |
| `decompressFile(string $source, string $destination, string $format = 'zip')` | `bool` | Αποσυμπιέζει ένα αρχείο μετά τη μεταφορά. |
| `deleteDirectory(string $remoteDir)` | `bool` | Διαγράφει έναν κατάλογο στον απομακρυσμένο διακομιστή. |
| `deleteFile(string $remoteFile)` | `bool` | Διαγράφει ένα αρχείο στον απομακρυσμένο διακομιστή. |
| `disconnect()` | `bool` | Κλείνει τη σύνδεση FTP/SFTP. |
| `downloadFile(string $remoteFile, string $localFile, int $mode = FTP_BINARY)` | `bool` | Κατεβάζει ένα αρχείο από τον απομακρυσμένο διακομιστή. |
| `enablePassiveMode(bool $enable = true)` | `bool` | Ενεργοποιεί ή απενεργοποιεί τη λειτουργία passive του FTP. |
| `generateCsrfToken(string $sessionId)` | `string` | Δημιουργεί ένα CSRF token για ασφάλεια εφαρμογών web. |
| `getFilePermissions(string $remoteFile)` | `int` | Ανακτά τα δικαιώματα για αρχείο ή κατάλογο στον απομακρυσμένο διακομιστή. |
| `getCurrentDirectory()` | `string` | Ανακτά τον τρέχοντα κατάλογο στον απομακρυσμένο διακομιστή. |
| `getTransferStats()` | `array` | Ανακτά στατιστικά μεταφοράς αρχείων. |
| `listDirectory(string $remoteDir = '.')` | `array` | Καταγράφει τα περιεχόμενα ενός απομακρυσμένου καταλόγου. |
| `logActivity(string $activity, string $level = 'info')` | `bool` | Καταγράφει δραστηριότητες FTP/SFTP χρησιμοποιώντας TLoggerHandler (κληρονομείται). |
| `login(string $username, string $password)` | `bool` | Συνδέεται στον διακομιστή FTP/SFTP. |
| `monitorTransferProgress(callable $callback, int $interval = 1)` | `bool` | Παρακολουθεί την πρόοδο μεταφοράς αρχείων με callback. |
| `reconnect()` | `bool` | Επανασυνδέεται στον διακομιστή χρησιμοποιώντας αποθηκευμένη διαμόρφωση. |
| `restoreFileListFromCache(string $cacheKey)` | `array` | Επαναφέρει τη λίστα καταλόγου από το cache. |
| `restoreSession(string $sessionId)` | `bool` | Επαναφέρει την κατάσταση σύνδεσης για εφαρμογές web. |
| `saveSession(string $sessionId)` | `bool` | Αποθηκεύει την κατάσταση σύνδεσης για εφαρμογές web. |
| `setFilePermissions(string $remoteFile, int $permissions)` | `bool` | Ορίζει δικαιώματα για αρχείο ή κατάλογο στον απομακρυσμένο διακομιστή. |
| `uploadFile(string $localFile, string $remoteFile, int $mode = FTP_BINARY)` | `bool` | Ανεβάζει ένα αρχείο στον απομακρυσμένο διακομιστή. |
| `validateCsrfToken(string $sessionId, string $token)` | `bool` | Επικυρώνει ένα CSRF token για ασφάλεια εφαρμογών web. |

---

<details>
<summary>🟠 ΚΛΗΡΟΝΟΜΙΕΣ</summary>

Κληρονομεί από την `TSocketHandler`, παρέχοντας λειτουργίες βασισμένες σε sockets και δυνατότητες καταγραφής.

</details>

---

## Σύνδεσμοι
- [Κλάσεις Πυρήνα](/docs/kernel/CLASS-GR.md)
- [Αναφορά Προβλημάτων](https://issues.ascoos.com)
