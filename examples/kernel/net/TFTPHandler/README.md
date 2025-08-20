# TFTPHandler Examples

This directory contains examples demonstrating the usage of the `TFTPHandler` class, an advanced component of **Ascoos OS** for managing FTP and SFTP connections.

The `TFTPHandler` class provides functionalities for asynchronous transfers, key-based authentication, file compression/decompression, CSRF protection, and integration with WebFTPClient.

## Purpose
These examples illustrate how to use the `TFTPHandler` methods in real-world scenarios, such as:
- Establishing and managing FTP/SFTP connections.
- Performing asynchronous and bulk file transfers.
- Managing directories and file permissions.
- Logging activities and utilizing caching.

## Structure
The examples are organized under the namespace `ASCOOS\OS\Kernel\Net\TFTPHandler` for consistency with the `Ascoos OS` architecture:
- Each example is a standalone PHP file, named after the method it demonstrates (e.g., `connect.php`).
- The `TFTPHandler` class documentation is available at [`/docs/kernel/net/TFTPHandler/README.md`](/docs/kernel/net/TFTPHandler/README.md).

## Available Examples
| Example File | Method | Description |
|--------------|--------|-------------|
| [`asyncDownloadFile.php`](asyncDownloadFile.php) | `asyncDownloadFile` | Demonstrates asynchronous file download from the remote server. |
| [`asyncUploadFile.php`](asyncUploadFile.php) | `asyncUploadFile` | Demonstrates asynchronous file upload to the remote server. |
| [`authenticateWithKey.php`](authenticateWithKey.php) | `authenticateWithKey` | Demonstrates authentication using public/private key for SFTP. |
| [`bulkDownloadFiles.php`](bulkDownloadFiles.php) | `bulkDownloadFiles` | Demonstrates bulk downloading of files from the remote server. |
| [`bulkUploadFiles.php`](bulkUploadFiles.php) | `bulkUploadFiles` | Demonstrates bulk uploading of files to the remote server. |
| [`cacheFileList.php`](cacheFileList.php) | `cacheFileList` | Demonstrates caching a directory listing. |
| [`changeDirectory.php`](changeDirectory.php) | `changeDirectory` | Demonstrates changing the current directory on the remote server. |
| [`compressFile.php`](compressFile.php) | `compressFile` | Demonstrates compressing a file before transfer. |
| [`connect.php`](connect.php) | `connect` | Demonstrates establishing an FTP or SFTP connection. |
| [`createDirectory.php`](createDirectory.php) | `createDirectory` | Demonstrates creating a directory on the remote server. |
| [`decompressFile.php`](decompressFile.php) | `decompressFile` | Demonstrates decompressing a file after transfer. |
| [`deleteDirectory.php`](deleteDirectory.php) | `deleteDirectory` | Demonstrates deleting a directory on the remote server. |
| [`deleteFile.php`](deleteFile.php) | `deleteFile` | Demonstrates deleting a file on the remote server. |
| [`disconnect.php`](disconnect.php) | `disconnect` | Demonstrates closing the connection to the server. |
| [`downloadFile.php`](downloadFile.php) | `downloadFile` | Demonstrates downloading a file from the remote server. |
| [`enablePassiveMode.php`](enablePassiveMode.php) | `enablePassiveMode` | Demonstrates enabling or disabling passive mode for FTP. |
| [`generateCsrfToken.php`](generateCsrfToken.php) | `generateCsrfToken` | Demonstrates generating a CSRF token for web application security. |
| [`getFilePermissions.php`](getFilePermissions.php) | `getFilePermissions` | Demonstrates retrieving file or directory permissions. |
| [`getCurrentDirectory.php`](getCurrentDirectory.php) | `getCurrentDirectory` | Demonstrates retrieving the current directory. |
| [`getTransferStats.php`](getTransferStats.php) | `getTransferStats` | Demonstrates retrieving file transfer statistics. |
| [`listDirectory.php`](listDirectory.php) | `listDirectory` | Demonstrates listing the contents of a remote directory. |
| [`logActivity.php`](logActivity.php) | `logActivity` | Demonstrates logging FTP/SFTP activities. |
| [`login.php`](login.php) | `login` | Demonstrates logging into the server with username and password. |
| [`monitorTransferProgress.php`](monitorTransferProgress.php) | `monitorTransferProgress` | Demonstrates monitoring file transfer progress. |
| [`reconnect.php`](reconnect.php) | `reconnect` | Demonstrates reconnecting to the server. |
| [`restoreFileListFromCache.php`](restoreFileListFromCache.php) | `restoreFileListFromCache` | Demonstrates restoring a directory listing from cache. |
| [`restoreSession.php`](restoreSession.php) | `restoreSession` | Demonstrates restoring a session for web applications. |
| [`saveSession.php`](saveSession.php) | `saveSession` | Demonstrates saving a session for web applications. |
| [`setFilePermissions.php`](setFilePermissions.php) | `setFilePermissions` | Demonstrates setting permissions for a file or directory. |
| [`uploadFile.php`](uploadFile.php) | `uploadFile` | Demonstrates uploading a file to the remote server. |
| [`validateCsrfToken.php`](validateCsrfToken.php) | `validateCsrfToken` | Demonstrates validating a CSRF token for web application security. |

## Getting Started
1. Ensure that Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If you are using the [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com) development suite, Ascoos OS is preloaded, so no additional installation is required.
2. Navigate to the example files in `/examples/kernel/net/TFTPHandler/`.
3. Execute the PHP files (e.g., `https://localhost/aos/examples/kernel/net/TFTPHandler/connect.php`) to see the results.

## Example Usage
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
    echo "Connection successful\n";
}
$ftpHandler->Free($ftpHandler);
```

## Resources
- [TFTPHandler Documentation](/docs/kernel/net/TFTPHandler/)
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS on LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS on X](https://www.x.com/ascoos)

## Contributing
Want to add more examples? Fork the repository, create a new example file, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
These examples are licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
