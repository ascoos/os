# Threaded Notification Dispatcher

This case study demonstrates how **Ascoos OS** can be used to send notifications to multiple recipients concurrently using threads and the Telegram API. It leverages asynchronous execution, observer-based event tracking, and dynamic notification dispatch.

## Purpose
This example uses the following Ascoos OS classes:
- **TThreadHandler**: Executes multiple tasks concurrently using threads.
- **TTelegramAPIHandler**: Sends messages via the Telegram Bot API.
- **TObserverHandler**: Tracks and logs notification events using observers.

## Structure
The case study is implemented in a single PHP file:
- [`threaded_notification_dispatcher.php`](./threaded_notification_dispatcher.php): Includes threaded dispatch logic, Telegram integration, and observer notification.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Set up a Telegram bot and obtain the `bot_token`.
3. Ensure write permissions for `$AOS_LOGS_PATH`.
4. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Replace `your_bot_token` and `your_chat_id` with actual values.
2. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/system/communication/threaded_notification_dispatcher.php
   ```

## Example Usage
```php
$observerHandler = TObserverHandler::getInstance([$properties['logs']]);
$observerHandler->attach(new SystemObserver(), 10);

$threadHandler->startThread('task_chat_id'.$chat_id, function () use (...) {
    $telegram = new TTelegramAPIHandler(...);
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $message]);
    $observerHandler->notify(['event' => 'telegram.sent', 'data' => ['chat_id' => $chat_id]]);
});
```

## Expected Output
The script sends a message to each recipient and logs success or failure. Example log entries:
```
System event observed: {"event":"telegram.sent","data":{"chat_id":"123456789"}}
System event observed: {"event":"telegram.failed","data":{"chat_id":"987654321"}}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `threaded_notification_dispatcher.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
