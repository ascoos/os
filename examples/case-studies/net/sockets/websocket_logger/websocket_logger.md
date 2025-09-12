# WebSocket Server with Logging & Event Triggering

This case study demonstrates how **Ascoos OS** can implement a WebSocket server that logs incoming messages and triggers semantic events using the built-in event system.

## Purpose
- Accept multiple WebSocket client connections
- Decode incoming messages
- Trigger semantic events (e.g., message received, client connected/disconnected)
- Log all activity to a file
- Echo messages back to clients

## Main Classes from Ascoos OS
- **TWebSocketHandler**  
  WebSocket server creation, socket binding, frame handling, client management  
- **TEventHandler**  
  Event registration, triggering, and logging  

## File Structure
The logic is implemented in a single PHP file:
- [`websocket_logger.php`](websocket_logger.php)

It includes all steps: socket setup, event registration, message handling, and logging.

## Requirements
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Define logging configuration.
2. Initialize `TWebSocketHandler` and `TEventHandler`.
3. Register events for message and connection handling.
4. Enable WebSocket mode and bind to port.
5. Listen for incoming connections.
6. Handle multiple clients and decode messages.
7. Trigger events and log activity.
8. Echo messages back to clients.

## Example Code
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

## Expected Output
Log file: `websocket_activity.log`

```text
Client connected: 192.168.255.255
Message received: Hello Server
Client disconnected: 192.168.255.255
```

## Resources
- [Ascoos OS Documentation](/docs/)  
- [AWES Platform](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can extend the logic to support authentication, message routing, or persistent sessions. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md).
