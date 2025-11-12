# Macro Engine with AI Predictions

This case study shows how **Ascoos OS** can execute macros based on AI predictions, combining logistic regression with a DSL (Domain-Specific Language). It uses the classes `TArtificialIntelligenceHandler`, `AbstractDslAstBuilder` and `AstMacroTranslator` to train a model, parse rules into an AST, translate them into macros and execute them dynamically.

## Purpose

- Train a model using `trainLogisticRegression()`  
- Build an AST from DSL with `AbstractDslAstBuilder`  
- Translate the AST into executable macros with `AstMacroTranslator`  
- Execute macros when predictions meet a condition  

## Core Ascoos OS Classes

- **TArtificialIntelligenceHandler**  
  Train and predict logistic regression models  

- **AbstractDslAstBuilder**  
  Parse DSL statements into an Abstract Syntax Tree  

- **AstMacroTranslator**  
  Convert AST nodes into a container of callbacks for each macro  

## File Structure

This case study is implemented in a single PHP script:  
- [`macro_decision_engine.php`](https://github.com/ascoos/os/blob/main/examples/case-studies/ai/macro_decision_engine/macro_decision_engine.php)  
  Contains data loading, model training, DSL parsing, translation and macro execution.

## Prerequisites

1. PHP ≥ 8.2  
2. Ascoos OS installed. If you’re using [**ASCOOS Web Extended Studio (AWES) 26**](https://awes.ascoos.com), it’s pre-installed.  

## Getting Started

1. Adjust your training data (`$X`, `$y`) as needed.  
2. Run the script via your web server:
   ```
   https://localhost/aos/examples/case-studies/ai/macro_decision_engine/macro_decision_engine.php
   ```

## DSL Example

```dsl
WHEN predict(user.features) > 0.5 THEN
    LOG "User is eligible"
    ENABLE MODULE "AdvancedAnalytics"
```

## Execution Flow

1. `TArtificialIntelligenceHandler` trains a logistic regression model with `$X` and `$y`.  
2. `AbstractDslAstBuilder` transforms the DSL script into AST nodes.  
3. `AstMacroTranslator` maps each node to a callback:
   - `LOG` → print a message  
   - `ENABLE MODULE` → enable a specific module  
   - `predict` → call `predictLogisticRegression()`  
4. `TMacroHandler` executes commands only if the prediction exceeds the threshold (`> 0.5`).  

## Code Example

```php
// Train the model
$ai    = new TArtificialIntelligenceHandler();
$model = $ai->trainLogisticRegression($X, $y);

// Define the DSL
$dsl = <<<DSL
WHEN predict(user.features) > 0.5 THEN
    LOG "User is eligible"
    ENABLE MODULE "AdvancedAnalytics"
DSL;

// Build AST & translate
$astBuilder     = new class extends AbstractDslAstBuilder {};
$ast            = $astBuilder->buildAst($dsl);
$translator     = new class([...]) extends AstMacroTranslator {};
$macroContainer = $translator->translateAst($ast);

// Execute based on user features
$user = ['features' => [1, 1, 0]];
$macroContainer->executeIfTrue($user);
```

## Expected Output

If the prediction `predict([1,1,0])` > 0.5:

```
User is eligible
Module enabled: AdvancedAnalytics
```

## Resources

- [Ascoos OS Documentation](https://docs.ascoos.com/os)  
- [GitHub Repository](https://github.com/ascoos/os)  
- [AWES](https://awes.ascoos.com)  
- [BootLib](https://bootlib.ascoos.com)  
- [phpBCL8](https://github.com/ascoos/phpbcl8)  

## Contribution

Want to contribute to this case study? Fork the repo, add new macros or DSL enhancements in `macro_decision_engine.php` and submit a pull request. See [CONTRIBUTING.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING.md) for guidelines.

## License

This case study is covered by the Ascoos General License (AGL). See [LICENSE](https://github.com/ascoos/os/blob/main/LICENSE.md).
