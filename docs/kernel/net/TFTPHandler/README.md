# Class `TFTPHandler`

***Enhanced FTP/SFTP handler with support for asynchronous transfers, public key authentication, file compression, CSRF protection, and WebFTPClient integration.***

> #### Extends `TSocketHandler`

## Usage
```php
use ASCOOS\OS\Kernel\Net\TFTPHandler;

// Initialize with configuration
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

// Connect to the server
$ftpHandler->connect('example.com', 22, 'user', 'pass', false);
```

[See usage examples](/examples/kernel/net/TFTPHandler/README.md).

## Detailed Documentation
For complete details (parameters, types, examples), visit the [Official Documentation Site](https://docs.ascoos.com) (under construction).

---

## Properties
| Property | Type | Description |
|----------|------|-------------|
| `ftpConnection` | `mixed` | The FTP/SFTP connection resource (`FTP\Connection` for FTP, `resource` for SFTP). |
| `protocol` | `string` | The protocol used ('ftp' or 'sftp'). |
| `connectionConfig` | `array` | Configuration for the FTP/SFTP connection (host, port, username, password, etc.). |
| `logger` | `?TLoggerHandler` | Logger instance for recording FTP/SFTP activities (inherited). |
| `debugger` | `?TDebugHandler` | Debugger instance for detailed debugging (inherited). |
| `phpHandler` | `?TPHPHandler` | PHP environment handler (inherited). |
| `cache` | `?TCacheHandler` | Cache handler for storing connection and file metadata (inherited). |
| `files` | `?TFilesHandler` | File handler for local file operations. |
| `transferStats` | `array` | Statistics for file transfers (bytes sent/received, time taken, etc.). |
| `useAsync` | `bool` | Whether to use asynchronous transfers. |
| `publicKey` | `?string` | Path to the public key for SFTP authentication. |
| `privateKey` | `?string` | Path to the private key for SFTP authentication. |
| `sessionId` | `?string` | Session ID for maintaining connection state in web applications. |

### Keys of `connectionConfig`
| Key | Type | Description |
|-----|------|-------------|
| `host` | `string` | The server hostname or IP address (default: 'localhost'). |
| `port` | `int` | The server port (default: 21 for FTP, 22 for SFTP). |
| `username` | `string` | The username for authentication (default: ''). |
| `password` | `string` | The password for authentication (default: ''). |
| `useSSL` | `bool` | Whether to use SSL/TLS for the connection (default: false). |
| `passive` | `bool` | Whether to use FTP passive mode (default: true). |
| `timeout` | `int` | Connection timeout in seconds (default: 30). |
| `useAsync` | `bool` | Whether to use asynchronous transfers (default: false). |
| `publicKey` | `?string` | Path to the public key for SFTP authentication (default: null). |
| `privateKey` | `?string` | Path to the private key for SFTP authentication (default: null). |

## Methods
| Method | Return | Description |
|--------|--------|-------------|
| `__construct(array $properties = [])` | `void` | Initializes the FTP/SFTP handler with configuration properties. |
| `asyncDownloadFile(string $remoteFile, string $localFile, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Asynchronously downloads a file from the remote server. |
| `asyncUploadFile(string $localFile, string $remoteFile, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Asynchronously uploads a file to the remote server. |
| `authenticateWithKey(string $username, string $publicKey, string $privateKey, string $passphrase = '')` | `bool` | Authenticates with SFTP server using public/private key. |
| `bulkDownloadFiles(array $files, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Downloads multiple files from the remote server. |
| `bulkUploadFiles(array $files, int $mode = FTP_BINARY, ?callable $progressCallback = null)` | `bool` | Uploads multiple files to the remote server. |
| `cacheFileList(string $remoteDir, string $cacheKey)` | `bool` | Caches the directory listing for faster access. |
| `changeDirectory(string $remoteDir)` | `bool` | Changes the current directory on the remote server. |
| `compressFile(string $source, string $destination, string $format = 'zip')` | `bool` | Compresses a file before transfer. |
| `connect(string $host, int $port = 21, string $username = '', string $password = '', bool $useSSL = false)` | `bool` | Establishes an FTP or SFTP connection. |
| `createDirectory(string $remoteDir)` | `bool` | Creates a directory on the remote server. |
| `decompressFile(string $source, string $destination, string $format = 'zip')` | `bool` | Decompresses a file after transfer. |
| `deleteDirectory(string $remoteDir)` | `bool` | Deletes a directory on the remote server. |
| `deleteFile(string $remoteFile)` | `bool` | Deletes a file on the remote server. |
| `disconnect()` | `bool` | Closes the FTP/SFTP connection. |
| `downloadFile(string $remoteFile, string $localFile, int $mode = FTP_BINARY)` | `bool` | Downloads a file from the remote server. |
| `enablePassiveMode(bool $enable = true)` | `bool` | Enables or disables FTP passive mode. |
| `generateCsrfToken(string $sessionId)` | `string` | Generates a CSRF token for web application security. |
| `getFilePermissions(string $remoteFile)` | `int` | Retrieves permissions for a file or directory on the remote server. |
| `getCurrentDirectory()` | `string` | Retrieves the current directory on the remote server. |
| `getTransferStats()` | `array` | Retrieves file transfer statistics. |
| `listDirectory(string $remoteDir = '.')` | `array` | Lists the contents of a remote directory. |
| `logActivity(string $activity, string $level = 'info')` | `bool` | Logs FTP/SFTP activities using TLoggerHandler (inherited). |
| `login(string $username, string $password)` | `bool` | Logs into the FTP/SFTP server. |
| `monitorTransferProgress(callable $callback, int $interval = 1)` | `bool` | Monitors file transfer progress with a callback. |
| `reconnect()` | `bool` | Reconnects to the server using stored configuration. |
| `restoreFileListFromCache(string $cacheKey)` | `array` | Restores a directory listing from cache. |
| `restoreSession(string $sessionId)` | `bool` | Restores the connection state for web applications. |
| `saveSession(string $sessionId)` | `bool` | Saves the connection state for web applications. |
| `setFilePermissions(string $remoteFile, int $permissions)` | `bool` | Sets permissions for a file or directory on the remote server. |
| `uploadFile(string $localFile, string $remoteFile, int $mode = FTP_BINARY)` | `bool` | Uploads a file to the remote server. |
| `validateCsrfToken(string $sessionId, string $token)` | `bool` | Validates a CSRF token for web application security. |

---

<details>
<summary>🟠 INHERITANCE</summary>

Inherits from `TSocketHandler`, providing socket-based functionality and logging capabilities.

</details>

---

## Links
- [Kernel Classes](/docs/kernel/CLASS.md)
- [Report Issues](https://issues.ascoos.com)
