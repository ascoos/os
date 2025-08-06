# 📦 TTorrentFileHandler – Usage Examples

This package contains usage examples of the `TTorrentFileHandler` class from the ASCOOS Framework for managing `.torrent` files.

---

## 🧩 Class: `TTorrentFileHandler`

The class extends `TArrayHandler` and provides methods for:

- Reading
- Updating
- Re-encoding
- Uploading
- Downloading
- Validation
- Creation
- Comparison

---

## 🛠️ Methods

| Method | Description |
|--------|-------------|
| `readTorrentFile()` | Reads and decodes a torrent file |
| `displayTorrentInfo()` | Displays torrent metadata |
| `updateAndEncode()` | Updates and re-encodes data |
| `uploadPieces()` | Uploads pieces to peers |
| `downloadPieces()` | Downloads pieces from peers |
| `validateUrl()` | Validates tracker URL |
| `createTorrentFile()` | Creates a new torrent file |
| `compareTorrents()` | Compares two torrent files |
| `checkIntegrity()` | Checks piece integrity |
| `setAnnounceUrl()` / `getAnnounceUrl()` | Set / Get the announce URL |
| `setComment()` / `getComment()` | Set / Get the comment |
| `setFiles()` / `getFiles()` | Set / Get the file list |
| `setName()` / `getName()` | Set / Get the torrent name |
| `setCreatedDate()` / `getCreatedDate()` | Set / Get the created date |
| `getAnnounceList()` / `addAnnounceToList()` | Get / Add to the announce list |
| `isTorrentFile()` | Checks if a file is a valid torrent file |

---

## 📂 Examples

| File | Description |
|------|-------------|
| `announceUrl.php` | Add or update the announce URL |
| `checkIntegrity.php` | Check piece integrity |
| `compareTorrents.php` | Compare torrent files |
| `create.php` | Create a torrent file |
| `displayInfo.php` | Display torrent info |
| `download.php` | Download pieces from peers |
| `readTorrentFile.php` | Read and decode torrent file |
| `updateAndEncode.php` | Update and re-encode data |
| `upload.php` | Upload pieces to peers |
| `validateUrl.php` | Validate tracker URL |

---

## 🚀 Usage

1. Set the `$AFW_EXTRAS_PATH` variable to point to the ASCOOS extras folder:

   ```php
   global $AFW_EXTRAS_PATH;
   ```

2. Run the examples via CLI:

   ```bash
   php readTorrentFile.php
   php updateAndEncode.php
   php upload.php
   php validateUrl.php
   ```

---

## 📌 Note

This class is actively used in the **Web Torrent Client** app, which runs as a native application inside the Ascoos CMS.

---

## 📄 License

This project is part of the ASCOOS Framework and follows its licensing terms.

