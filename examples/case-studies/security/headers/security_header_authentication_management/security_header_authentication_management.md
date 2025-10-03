# Advanced Security Header Management with Authentication

This case study demonstrates how **Ascoos OS**, a Full Modular PHP Web5 Kernel, manages **Content Security Policy (CSP)**, **Cross-Origin Resource Sharing (CORS)**, **Security Headers**, and **user authentication** using its modular classes. It showcases secure header configuration, SSL/TLS validation, event handling, and logging.

## Purpose
- Configure and apply CSP, CORS, and security headers across multiple methods (HTTP headers, `.htaccess`).
- Authenticate users before applying security headers.
- Validate SSL/TLS certificates and adapt CSP rules dynamically.
- Log security events and authentication attempts using `TLoggerHandler`.
- Emit events for authentication and header application using `TEventHandler`.
- Generate JSON reports for analysis.

## Core Ascoos OS Classes
- **TCSPHandler**: Manages Content Security Policy (CSP) rules and delivery.
- **TCORSHeaderHandler**: Configures CORS headers for cross-origin communication.
- **TSecurityHeaderHandler**: Applies security headers (e.g., HSTS, X-Frame-Options).
- **TCustomHeaderHandler**: Handles custom headers for specific needs.
- **THTTPHeaderHandler**: Centralizes header management and delivery.
- **TApacheHandler**: Validates SSL/TLS certificates and manages Apache configurations.
- **THTAccessHandler**: Manages `.htaccess` files for server-level configurations.
- **TLoggerHandler**: Logs security events and authentication attempts.
- **TFilesHandler**: Generates and saves JSON reports.
- **TEventHandler**: Manages event registration and triggering for authentication and security.
- **TAuthenticationHandler**: Handles user authentication and emits events.

## File Structure
The implementation is contained in a single PHP file:
- [`security_header_authentication_management.php`](./security_header_authentication_management.php)

## Prerequisites
1. PHP ≥ 8.2
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Define CSP, CORS, security, and custom header rules.
2. Initialize handlers (`TCSPHandler`, `TCORSHeaderHandler`, etc.) with specific send methods.
3. Register authentication and security events using `TEventHandler`.
4. Authenticate users with `TAuthenticationHandler`, triggering `auth.success` or `auth.failed` events.
5. Check SSL/TLS certificate validity with `TApacheHandler` and adapt CSP rules if needed.
6. Apply CSP and CORS to `.htaccess` using `THTAccessHandler`.
7. Send headers via HTTP using `THTTPHeaderHandler` and trigger `security.header_applied` event.
8. Log events and header applications with `TLoggerHandler`.
9. Generate and save a JSON report with `TFilesHandler`.
10. Free resources to optimize memory usage.

## Example Code
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

## Expected Output
- **HTTP Headers**:
  ```
  Content-Security-Policy: default-src 'self'; script-src 'self' https://test.loc; report-uri https://report.test.loc/csp-report
  Access-Control-Allow-Origin: https://trusted.domain.com
  Strict-Transport-Security: max-age=31536000
  ```
- **JSON Report** (`security_report_20251003_1828.json`):
  ```json
  {
      "ssl_status": { "is_expired": false },
      "csp_rules": { "default-src": "'self'", ... },
      "cors_rules": { "Access-Control-Allow-Origin": "https://trusted.domain.com", ... },
      "security_rules": { "Strict-Transport-Security": "max-age=31536000" },
      "auth_status": { "user": "admin", "success": true, "errors": [] }
  }
  ```
- **Log File** (`security_headers.log`):
  ```
  [2025-10-03 18:28:00] INFO: Authentication succeeded for user: {"username":"admin"}
  [2025-10-03 18:28:00] INFO: Headers sent: {...}
  [2025-10-03 18:28:00] INFO: Security report saved to ./reports/security_report_20251003_1828.json
  ```

## Resources
- [Ascoos OS Documentation](/docs/)
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
Enhance the case study by adding dynamic CSP rules, integrating external APIs, or implementing additional authentication methods. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
Covered by the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md).
