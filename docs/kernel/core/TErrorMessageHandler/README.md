# Class TErrorMessageHandler

**Multilingual error message handler for PHP applications. Integrates with logging and debugging systems. Part of the Ascoos OS Kernel.**

> #### Extends `TArrayHandler`

---

## Features

- 🌐 Multilingual error messages
- 🪵 Integrated logging via `TLoggerHandler`
- 🐞 Exception-based debug information extraction
- 📄 Supports multiple output formats: HTML, JSON, XML, YAML
- 🧩 Inherits from `TArrayHandler` for flexible configuration

## Installation

As part of the deep core of **`Ascoos OS`**, this class does not require manual installation. It is automatically loaded during the OS boot process.

## Usage

### Basic Initialization

```php
use ASCOOS\OS\Kernel\Core\Errors\Messages\TErrorMessageHandler;

$handler = new TErrorMessageHandler('en', $logger);
```

### Render HTML Error Dashboard

```php
echo $handler->render(404);
```

### Log an Error

```php
$handler->logError(500, new Exception("Internal Server Error"));
```

### Retrieve Message in Various Formats

```php
echo $handler->getMessage(403);              // Plain text
echo $handler->getMessageAsJSON(403);        // JSON
echo $handler->getMessageAsXML(403);         // XML
echo $handler->getMessageAsYAML(403);        // YAML
```

## Method Reference

| Method                  | Description                                         |
|------------------------|-----------------------------------------------------|
| `__construct()`         | Initializes the handler with language and logger    |
| `getMessage()`          | Returns error message for a given code              |
| `getDebugInfo()`        | Returns detailed debug information                  |
| `logError()`            | Logs the error                                      |
| `render()`              | Renders HTML dashboard                              |
| `getMessageAsJSON()`    | Returns message in JSON format                      |
| `getMessageAsXML()`     | Returns message in XML format                       |
| `getMessageAsYAML()`    | Returns message in YAML format                      |

## Detailed Documentation

For full parameter descriptions, types, and examples, visit the [Official Documentation Site](https://docs.ascoos.com) (under construction).

---

## 🔍 Usage Examples

### 1. Render Error Dashboard with Exception

```php
try {
    throw new RuntimeException("Database connection failed");
} catch (Throwable $e) {
    echo $handler->render(1001, $e);
}
```

### 2. Log Error Without Exception

```php
$handler->logError(1002);
```

### 3. Export Message to YAML for DevOps

```php
file_put_contents('error.yaml', $handler->getMessageAsYAML(1003));
```

---

<details>
<summary>🟠 INHERITANCE</summary>

Inherits methods and properties from `TArrayHandler` and `TObject`.
</details>

---

## License

[Ascoos General License](http://docs.ascoos.com/lics/ascoos/AGL.html) © Ascoos OS

---

## Links
- [Core Classes](/docs/kernel/CLASS.md)
- [Issue Tracker](https://issues.ascoos.com)
```
