# WebSocket Server με Καταγραφή και Ενεργοποίηση Γεγονότων

Αυτή η μελέτη περίπτωσης παρουσιάζει έναν WebSocket server βασισμένο στο **Ascoos OS**, ο οποίος καταγράφει εισερχόμενα μηνύματα και ενεργοποιεί σημασιολογικά γεγονότα μέσω του ενσωματωμένου συστήματος γεγονότων.

## Σκοπός
- Αποδοχή πολλαπλών συνδέσεων WebSocket πελατών
- Αποκωδικοποίηση εισερχόμενων μηνυμάτων
- Ενεργοποίηση γεγονότων (π.χ. μήνυμα, σύνδεση, αποσύνδεση)
- Καταγραφή δραστηριότητας σε αρχείο
- Επιστροφή μηνυμάτων στους πελάτες (echo)

## Κύριες Κλάσεις του Ascoos OS
- **TWebSocketHandler**  
  Δημιουργία WebSocket server, σύνδεση socket, χειρισμός frames, διαχείριση πελατών  
- **TEventHandler**  
  Καταχώριση, ενεργοποίηση και καταγραφή γεγονότων  

## Δομή Αρχείων
Η λογική υλοποιείται σε ένα αρχείο PHP:
- [`websocket_logger.php`](websocket_logger.php)

Περιλαμβάνει όλα τα βήματα: ρύθμιση socket, καταχώριση γεγονότων, χειρισμό μηνυμάτων και καταγραφή.

## Απαιτήσεις
1. PHP ≥ 8.2  
2. Εγκατεστημένο **Ascoos OS** ή [`AWES 26`](https://awes.ascoos.com)

## Ροή Εκτέλεσης
1. Ορισμός ρυθμίσεων καταγραφής.
2. Αρχικοποίηση `TWebSocketHandler` και `TEventHandler`.
3. Καταχώριση γεγονότων για μηνύματα και συνδέσεις.
4. Ενεργοποίηση λειτουργίας WebSocket και σύνδεση σε port.
5. Αναμονή για εισερχόμενες συνδέσεις.
6. Χειρισμός πολλαπλών πελατών και αποκωδικοποίηση μηνυμάτων.
7. Ενεργοποίηση γεγονότων και καταγραφή δραστηριότητας.
8. Επιστροφή μηνυμάτων στους πελάτες.

## Παράδειγμα Κώδικα
```php
$ws = new TWebSocketHandler($properties);
$events = new TEventHandler([], $properties);

$events->register('ws', 'message.received', fn($msg) => $events->logger->log("Message received: $msg"));
$events->register('ws', 'client.connected', fn($client) => $events->logger->log("Client connected: $client"));
$events->register('ws', 'client.disconnected', fn($client) => $events->logger->log("Client disconnected: $client"));

$ws->enableWebSocket();
$ws->createSocket();
$ws->bindSocket('0.0.0.0', 8080);
$ws->listenSocket(5);

$ws->handleMultipleClients(function ($client, $data) use ($ws, $events) {
    $message = $ws->receiveWebSocketFrame();
    $events->trigger('ws', 'message.received', $message);
    $ws->sendWebSocketFrame("Echo: $message");
}, timeout: 30);
```

## Αναμενόμενο Αποτέλεσμα
Αρχείο καταγραφής: `websocket_activity.log`

```text
Client connected: 192.168.255.255
Message received: Hello Server
Client disconnected: 192.168.255.255
```

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)  
- [Πλατφόρμα AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Συνεισφορά
Μπορείτε να επεκτείνετε τη λογική για υποστήριξη αυθεντικοποίησης, δρομολόγησης μηνυμάτων ή επίμονων συνεδριών. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια
Αυτή η μελέτη περίπτωσης καλύπτεται από την Ascoos General License (AGL). Δείτε το [LICENSE.md](/LICENSE.md).
