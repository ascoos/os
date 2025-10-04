# Laravel Integration in Ascoos OS

This case study demonstrates how **Ascoos OS**, a Full Modular PHP Web5 Kernel, integrates the **Laravel Framework** via the `LibIn` upload system, leveraging its ecosystem (macros, events, etc.) without dependency on Composer. It showcases the loading of Laravel, initialization with macros and events, and connection to the global scope.

## Purpose
- Load and initialize Laravel via the `LibIn` upload system.
- Integrate Laravel with `TMacroHandler` for macro execution.
- Log initialization events with `TEventHandler`.
- Provide global access to `$laravel_app` for mixed usage.
- Enable extensibility for Laravel developers.

## Main Ascoos OS Classes
- **TMacroHandler**: Manages macro execution for Laravel.
- **TEventHandler**: Logs and triggers events, such as `laravel_init`.
- **TLoggerHandler**: Used for logging Laravel activities.

## File Structure
The implementation is contained in a PHP file:
- [`laravel_autoload.php`](./laravel_autoload.php)

## Prerequisites
1. PHP ≥ 8.2
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)
3. An Ascoos `.az` archive of Laravel (including `vendor` and `bootstrap` directories).

## Execution Flow
1. Define `LARAVEL_BASE_PATH` using `$AOS_LIBS_PATH`.
2. Check for the existence of `vendor/autoload.php` and throw an exception if it does not exist.
3. Load `vendor/autoload.php` and initialize `bootstrap/app.php`.
4. Initialize `$laravel_app` and bind it to `$GLOBALS['laravel_app']`.
5. Execute a macro for logging initialization with `TMacroHandler`.
6. Log the `laravel_init` event with a timestamp via `TEventHandler`.
7. Release resources with `Free()`.

## Example Code
```php
// Access the Laravel application globally
$laravel_app = $GLOBALS['laravel_app'];
$laravel_app->make('log')->info('Custom message');

// Execute a macro
$macroHandler = TMacroHandler::getInstance();
$macroHandler->addMacro(fn() => $laravel_app->make('log')->info('Custom macro executed'));
$macroHandler->runNext();
```

## Expected Outcome
- **Log Message** (`laravel_loads.log`):
  ```
  [2025-10-04 19:27:00] INFO: Laravel initialized with Ascoos OS
  ```
- **Event Log** (via `TEventHandler`):
  ```
  [2025-10-04 19:27:00] INFO: Laravel integration successful at 2025-10-04 19:27:00
  ```
- **Global Access**: The `$GLOBALS['laravel_app']` variable is available for further use.

## Resources
- [Ascoos OS Documentation](https://os.ascoos.com/docs/)
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
Enhance this case study by adding support for other frameworks (e.g., Symfony), integrating more macros, or creating an `AscoosServiceProvider`. See [CONTRIBUTING.md](/CONTRIBUTING.md) for instructions.

## License
Covered under the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md).
