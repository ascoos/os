# Neural Workflow Composer: Macro Execution via Neural Prediction

This case study demonstrates how **Ascoos OS** can intelligently execute macros based on system history using neural networks. The system learns from past performance metrics and predicts optimal macro actions.

## Purpose
- Train a neural network with historical system data
- Predict whether a macro should be executed
- Execute macros based on prediction score

## Core Ascoos OS Classes
- **TNeuralNetworkHandler**  
  Neural network compilation, training, and prediction  
- **TMacroHandler**  
  Macro definition and execution logic  

## File Structure
The implementation resides in a single PHP file:
- [`neural_workflow_composer.php`](neural_workflow_composer.php)

It contains all logic: data preparation, model training, prediction, and macro execution.

## Requirements
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

## Execution Flow
1. Historical system data (CPU, RAM, Disk) is defined.
2. A neural network is compiled with two layers:
   - Input: 3 → Hidden: 4 (ReLU)
   - Hidden: 4 → Output: 1 (Sigmoid)
3. The model is trained with `fit()` using 1000 epochs and learning rate 0.01.
4. The current system state is evaluated.
5. If the prediction score > 0.5, a macro is executed.
6. Otherwise, macro execution is skipped.

## Code Example
```php
$composer = new TNeuralNetworkHandler();
$composer->compile([
    ['input' => 3, 'output' => 4, 'activation' => 'relu'],
    ['input' => 4, 'output' => 1, 'activation' => 'sigmoid']
]);
$composer->fit($systemData, $actions, epochs: 1000, lr: 0.01);

$score = $composer->predictNetwork([$currentState])[0];

if ($score > 0.5) {
    $macroHandler = new TMacroHandler();
    $macroHandler->addMacro(fn() => print("Executing optimized macro"), [], delay: 0, priority: 1);
    $macroHandler->runNext();
} else {
    print("Macro skipped based on neural prediction\n");
}
```

## Expected Output
If the prediction score is high:
```
Executing optimized macro
```
Otherwise:
```
Macro skipped based on neural prediction
```

## Resources
- [Ascoos OS Documentation](/docs/)  
- [ASCOOS](https://www.ascoos.com)
- [AWES](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can enhance the neural model, integrate additional system metrics, or extend macro logic. See [CONTRIBUTING.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE.md](https://github.com/ascoos/os/blob/main/LICENSE.md).
