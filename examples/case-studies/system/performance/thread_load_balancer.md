# Thread Load Balancer

This case study demonstrates how **Ascoos OS** can dynamically distribute tasks across threads based on current CPU and memory load. It ensures optimal performance by skipping thread execution when system resources are under pressure.

## Purpose
This example uses the following Ascoos OS classes:
- **TThreadHandler**: Manages and executes concurrent threads.
- **TCoreSystemHandler**: Monitors system resources such as CPU and memory.

## Structure
The case study is implemented in a single PHP file:
- [`thread_load_balancer.php`](./thread_load_balancer.php): Includes dynamic thread allocation logic based on system load.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Ensure write permissions for `$AOS_LOGS_PATH`.
3. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Define your task pool and thresholds.
2. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/system/performance/thread_load_balancer.php
   ```

## Example Usage
```php
$cpuLoad = $systemHandler->get_cpu_load();
$memoryLoad = $systemHandler->get_memory_stats()['percent'];

if ($cpuLoad < 80 && $memoryLoad < 85) {
    $threadHandler->startThread("task_$index", $task);
}
```

## Expected Output
The script starts threads only when system load is acceptable. Example log:
```
Thread task_0 started (CPU: 42%, Memory: 61%)
Thread task_3 skipped due to high load (CPU: 87%, Memory: 90%)
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `thread_load_balancer.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
