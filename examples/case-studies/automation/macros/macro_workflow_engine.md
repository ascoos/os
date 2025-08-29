# Macro-Based Workflow Engine

This case study demonstrates how **Ascoos OS** executes macro-based workflows using FIFO logic, with support for delay, priority, logging, and serial execution. It is ideal for automation pipelines and DevOps orchestration.

## Purpose
This example uses the following Ascoos OS classes:
- **TMacroHandler**: Manages macros in a queue with delay and priority.
- **TLoggerHandler**: Logs macro execution results.

## Structure
The case study is implemented in a single PHP file:
- [`macro_workflow_engine.php`](./macro_workflow_engine.php): Adds macros to a queue and executes them in order.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Ensure write permissions for `$AOS_LOGS_PATH`.
3. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Add macros using `addMacro()`.
2. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/automation/macros/macro_workflow_engine.php
   ```

## Example Usage
```php
$macroHandler->addMacro(function () {
    echo "Step 1: Initialization<br>";
    return 'Init complete';
}, [], delay: 1, priority: 1);

foreach ($macroHandler->runAll() as $result) {
    echo "Result: $result<br>";
}
```

## Expected Output
The script executes macros in order of priority and delay. Example output:
```
Step 1: Initialization
Result: Init complete
Step 2: Processing
Result: Processing done
Step 3: Finalization
Result: Final step complete
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `macro_workflow_engine.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
