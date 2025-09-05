# API Batch Orchestrator

This case study demonstrates how **Ascoos OS** can be used to orchestrate multiple API requests with caching and event-driven logic. The system executes batch GET requests, caches responses, emits success/failure events, and logs activity.

## Purpose
This example uses the following Ascoos OS classes:
- **TAPIHandler**: Executes API requests with support for caching and events.
- **TEventHandler**: Emits and logs events for success and failure.
- **TCacheHandler**: Stores and retrieves cached responses.
- **selectCache()**: Chooses the appropriate cache type (e.g. file, memcached).

## Structure
The case study is implemented in a single PHP file:
- [`api_batch_orchestrator.php`](./api_batch_orchestrator.php): Includes batch execution, caching, event handling, and logging.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Ensure write permissions for `/tmp/ascoos_cache/` and `$AOS_LOGS_PATH/`.
3. Internet access is required to reach the JSONPlaceholder API.
4. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Verify that `/tmp/ascoos_cache/` exists and is writable.
2. Run the script via web server:
   ```
   https://localhost/aos/examples/case-studies/api/api_batch_orchestrator.php
   ```

## Example Usage
```php
$response = $api->sendGetRequest('posts', ['userId' => 1]);
$cacheHandler->saveCache($cacheKey, $response);
$eventHandler->emit('api.batch.success', ['responses' => $responses]);
```

## Expected Output
The script returns a structured array of API responses, logs success or failure events, and stores results in cache. Example output:
```json
{
    "posts": [...],
    "comments": [...],
    "users": [...]
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `api_batch_orchestrator.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
