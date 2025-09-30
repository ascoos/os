# User Credential Validation and Authentication with Event Logging

This case study demonstrates how **Ascoos OS** can validate user credentials before authentication and log corresponding events. The system utilizes modular handlers for validation, authentication, and event management.

## Purpose
- Validate user credentials using predefined rules
- Authenticate user based on validated data
- Log success or failure events

## Core Ascoos OS Classes
- **TValidationHandler**  
  Validates data against specified rules  
- **TAuthenticationHandler**  
  Authenticates user and generates token  
- **TEventHandler**  
  Logs and manages events  

## File Structure
The implementation resides in a single PHP file:
- [`validated_login_flow.php`](validated_login_flow.php)

It includes the full logic: validation, authentication, and event logging.

## Prerequisites
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Configuration is defined for logging to `validated_login.log`.
2. Handlers for validation, authentication, and events are initialized.
3. Handlers are linked to the event manager.
4. Events are registered:
   - `validation.failed`: validation failure
   - `auth.success`: successful authentication
   - `auth.failed`: failed authentication
5. User credentials and validation rules are defined.
6. If validation fails, the error is logged and a JSON response with errors is returned.
7. If authentication succeeds, a token is generated and success is logged.
8. If authentication fails, failure is logged.
9. A JSON response with the result is returned.

## Code Example
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

## Expected Output
If validation fails:
```json
{
  "status": "validation_error",
  "errors": {
    "password": "The password field must be at least 8 characters long."
  }
}
```

If authentication succeeds:
```json
{
  "user": "admin",
  "authenticated": true,
  "token": "..."
}
```

If authentication fails:
```json
{
  "user": "admin",
  "authenticated": false,
  "token": null
}
```

## Resources
- [Ascoos OS Documentation](/docs/)  
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can extend the logic by adding more events, supporting multiple users, or integrating alternative authentication mechanisms. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md).
