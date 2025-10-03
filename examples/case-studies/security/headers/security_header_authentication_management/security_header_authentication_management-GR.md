# Προηγμένη Διαχείριση Headers Ασφαλείας με Αυθεντικοποίηση

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS**, ένα Full Modular PHP Web5 Kernel, διαχειρίζεται **Content Security Policy (CSP)**, **Cross-Origin Resource Sharing (CORS)**, **headers ασφαλείας** και **αυθεντικοποίηση χρηστών** χρησιμοποιώντας τις modular κλάσεις του. Επιδεικνύει τη ρύθμιση headers, την επικύρωση SSL/TLS, τη διαχείριση γεγονότων και την καταγραφή.

## Σκοπός
- Ρύθμιση και εφαρμογή CSP, CORS και headers ασφαλείας μέσω πολλαπλών μεθόδων (HTTP headers, `.htaccess`).
- Αυθεντικοποίηση χρηστών πριν την εφαρμογή headers.
- Επικύρωση πιστοποιητικών SSL/TLS και δυναμική προσαρμογή κανόνων CSP.
- Καταγραφή γεγονότων ασφαλείας και απόπειρων αυθεντικοποίησης με `TLoggerHandler`.
- Εκπομπή γεγονότων για αυθεντικοποίηση και εφαρμογή headers με `TEventHandler`.
- Δημιουργία αναφορών JSON για ανάλυση.

## Κύριες Κλάσεις του Ascoos OS
- **TCSPHandler**: Διαχειρίζεται κανόνες Content Security Policy (CSP).
- **TCORSHeaderHandler**: Ρυθμίζει headers CORS για cross-origin επικοινωνία.
- **TSecurityHeaderHandler**: Εφαρμόζει headers ασφαλείας (π.χ. HSTS, X-Frame-Options).
- **TCustomHeaderHandler**: Διαχειρίζεται προσαρμοσμένα headers.
- **THTTPHeaderHandler**: Κεντρική διαχείριση όλων των headers.
- **TApacheHandler**: Ελέγχει πιστοποιητικά SSL/TLS και διαχειρίζεται διαμορφώσεις Apache.
- **THTAccessHandler**: Διαχειρίζεται αρχεία `.htaccess` για server-level ρυθμίσεις.
- **TLoggerHandler**: Καταγράφει γεγονότα και απόπειρες αυθεντικοποίησης.
- **TFilesHandler**: Δημιουργεί και αποθηκεύει αναφορές JSON.
- **TEventHandler**: Διαχειρίζεται εγγραφή και εκπομπή γεγονότων.
- **TAuthenticationHandler**: Διαχειρίζεται την αυθεντικοποίηση χρηστών.

## Δομή Αρχείων
Η υλοποίηση περιέχεται σε ένα αρχείο PHP:
- [`security_header_authentication_management.php`](./security_header_authentication_management.php)

## Προαπαιτούμενα
1. PHP ≥ 8.2
2. Εγκατεστημένο **Ascoos OS** ή [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Ορισμός κανόνων CSP, CORS, security και custom headers.
2. Αρχικοποίηση handlers (`TCSPHandler`, `TCORSHeaderHandler`, κ.λπ.) με συγκεκριμένες μεθόδους αποστολής.
3. Εγγραφή γεγονότων αυθεντικοποίησης και ασφαλείας με `TEventHandler`.
4. Αυθεντικοποίηση χρηστών με `TAuthenticationHandler`, εκπομπή γεγονότων `auth.success` ή `auth.failed`.
5. Έλεγχος εγκυρότητας πιστοποιητικού SSL/TLS με `TApacheHandler` και προσαρμογή CSP αν χρειάζεται.
6. Εφαρμογή CSP και CORS στο `.htaccess` με `THTAccessHandler`.
7. Αποστολή headers μέσω HTTP με `THTTPHeaderHandler` και εκπομπή γεγονότος `security.header_applied`.
8. Καταγραφή γεγονότων και εφαρμογής headers με `TLoggerHandler`.
9. Δημιουργία και αποθήκευση αναφοράς JSON με `TFilesHandler`.
10. Απελευθέρωση πόρων.

## Παράδειγμα Κώδικα
```php
$cspRules = [
    'default-src' => "'self'",
    'script-src' => "'self' https://test.loc",
    'report-uri' => 'https://report.test.loc/csp-report'
];
$corsRules = ['Access-Control-Allow-Origin' => 'https://trusted.domain.com'];
$securityRules = ['Strict-Transport-Security' => 'max-age=31536000'];

$cspHandler = new TCSPHandler($cspRules, ['sendMethod' => TCSPHandler::CSP_SEND_METHOD_HEADER]);
$httpHeaderHandler = new THTTPHeaderHandler();
$httpHeaderHandler->addHandler('CSP', $cspHandler);

$eventHandler = new TEventHandler();
$eventHandler->register('auth', 'auth.success', fn($credentials) => error_log("Login succeeded"));
$authHandler = new TAuthenticationHandler();
$authHandler->setEventHandler($eventHandler);

if ($authHandler->authenticate(['username' => 'admin', 'password' => 'pass'])) {
    $eventHandler->trigger('auth', 'auth.success', ['username' => 'admin']);
    $httpHeaderHandler->sendHeaders();
}
```

## Αναμενόμενο Αποτέλεσμα
- **HTTP Headers**:
  ```
  Content-Security-Policy: default-src 'self'; script-src 'self' https://test.loc; report-uri https://report.test.loc/csp-report
  Access-Control-Allow-Origin: https://trusted.domain.com
  Strict-Transport-Security: max-age=31536000
  ```
- **Αναφορά JSON** (`security_report_20251003_1828.json`):
  ```json
  {
      "ssl_status": { "is_expired": false },
      "csp_rules": { "default-src": "'self'", ... },
      "cors_rules": { "Access-Control-Allow-Origin": "https://trusted.domain.com", ... },
      "security_rules": { "Strict-Transport-Security": "max-age=31536000" },
      "auth_status": { "user": "admin", "success": true, "errors": [] }
  }
  ```
- **Αρχείο Log** (`security_headers.log`):
  ```
  [2025-10-03 18:28:00] INFO: Authentication succeeded for user: {"username":"admin"}
  [2025-10-03 18:28:00] INFO: Headers sent: {...}
  [2025-10-03 18:28:00] INFO: Security report saved to ./reports/security_report_20251003_1828.json
  ```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Βελτιώστε το case study προσθέτοντας δυναμικούς κανόνες CSP, ενσωματώνοντας εξωτερικά APIs ή νέες μεθόδους αυθεντικοποίησης. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια Χρήσης
Καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
