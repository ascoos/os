# Semantic Macro Profiler

This case study demonstrates how **Ascoos OS** can orchestrate macro execution using semantic analysis, DSL scripting, NLP, and AI prediction. The system analyzes editorial content, detects sentiment and topic, translates DSL into macros, and executes them based on neural network scoring.

---

## Purpose
- Analyze editorial content using NLP
- Predict macro execution using AI
- Translate DSL into AST and execute macros
- Visualize semantic scores and store results

---

## Core Ascoos OS Classes
- **TLanguageProcessingAIHandler**  
  NLP sentiment and concept detection  
- **TNeuralNetworkHandler**  
  Neural network compilation, training, and prediction  
- **AbstractDslAstBuilder**  
  DSL parsing and AST generation  
- **AstMacroTranslator**  
  Macro translation and execution logic  
- **TChartsHandler**  
  Semantic graph generation  
- **TFilesHandler**  
  JSON report creation and file management  
- **TEventHandler**  
  Macro event logging  
- **TErrorMessageHandler**  
  Error handling and multilingual messaging  

---

## File Structure
The implementation resides in a single PHP file:
- [`semantic_macro_profiler.php`](https://github.com/ascoos/os/blob/main/examples/case-studies/ai/semantic_macro_profiler/semantic_macro_profiler.php)

It includes all logic: NLP analysis, AI prediction, DSL parsing, macro execution, and reporting.

---

## Requirements
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES 26`](https://awes.ascoos.com)

---

## Execution Flow
1. Define DSL macro script with semantic conditions.
2. Analyze editorial content using NLP:
   - Detect sentiment (positive, neutral, negative)
   - Extract activated concepts
3. Compile and train neural network:
   - Input: 3 → Hidden: 4 (ReLU)
   - Hidden: 4 → Output: 1 (Sigmoid)
4. Predict macro execution score.
5. If score > 0.5, execute macro.
6. Generate semantic graph and save JSON report.

---

## Code Example
```php
$sentiment = $nlp->naiveBayesSentiment($text);
$concepts  = $nlp->conceptActivationVector([...], [$text]);

$ai->compile([...]);
$ai->fit([...], [...], epochs: 500, lr: 0.01);
$score = $ai->predictNetwork([[...]])[0];

if ($score > 0.5) {
    $macroContainer->executeIfTrue();
}
```

---

## Expected Output
If prediction is high:
```
Executing macro: audit_macro
```
Otherwise:
```
Macro skipped due to low AI score
```

---

## Resources
- [Ascoos OS Documentation](https://docs.ascoos.com/os)  
- [Official Ascoos OS Website](https://os.ascoos.com)  
- [AWES Studio](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

---

## Contribution
You may extend the macro logic, integrate additional semantic triggers, or improve the AI model. See [CONTRIBUTING.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING.md) for guidelines.

---

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE.md](https://github.com/ascoos/os/blob/main/LICENSE.md).
