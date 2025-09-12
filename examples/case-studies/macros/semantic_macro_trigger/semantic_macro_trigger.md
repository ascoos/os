# Semantic Macro Triggering Based on NLP Analysis of Editorial Content

This case study demonstrates how **Ascoos OS** can execute macros based on semantic analysis of editorial content. It uses NLP techniques to detect sentiment and topic relevance, then triggers macros using a DSL script parsed into an AST structure.

## Objective
- Analyze editorial text using `TLanguageProcessingAIHandler`
- Detect sentiment and activated concepts
- Define macro logic using DSL
- Translate DSL into executable macros
- Execute macros when semantic conditions are met

## Core Ascoos OS Classes
- **TLanguageProcessingAIHandler**  
  Performs sentiment analysis and concept activation  
- **AbstractDslAstBuilder**  
  Parses DSL into Abstract Syntax Tree nodes  
- **AstMacroTranslator**  
  Maps AST nodes into macro actions and conditions  

## File Structure
This case study is implemented in a single PHP file:
- [`semantic_macro_trigger.php`](semantic_macro_trigger.php)

## Requirements
1. PHP ≥ 8.2  
2. Installed **Ascoos OS** or [`AWES`](https://awes.ascoos.com)

## DSL Example
```dsl
WHEN sentiment = negative AND topic = "economy" THEN
    TAG "alert"
    NOTIFY "Editor"
    FLAG "Review"
```

## Execution Flow
1. `TLanguageProcessingAIHandler` analyzes the editorial text.
2. Sentiment is extracted using `naiveBayesSentiment()`.
3. Concept activation is performed using `conceptActivationVector()`.
4. DSL is parsed into AST using `AbstractDslAstBuilder`.
5. `AstMacroTranslator` maps DSL nodes to:
   - `TAG` → adds semantic tag  
   - `NOTIFY` → sends notification  
   - `FLAG` → flags article for review  
6. Macros execute only if sentiment is negative and topic is "economy".

## Sample Code
```php
$text = "...";
$nlp = new TLanguageProcessingAIHandler();
$sentiment = $nlp->naiveBayesSentiment($text);
$concepts  = $nlp->conceptActivationVector([...], [$text]);

$dsl = <<<DSL
WHEN sentiment = negative AND topic = "economy" THEN
    TAG "alert"
    NOTIFY "Editor"
    FLAG "Review"
DSL;

$astBuilder = new class extends AbstractDslAstBuilder {};
$ast        = $astBuilder->buildAst($dsl);

$translator = new class([...]) extends AstMacroTranslator {};
$macroContainer = $translator->translateAst($ast);
$macroContainer->executeIfTrue();
```

## Expected Output
If sentiment is negative and topic is "economy":
```
🏷️ Tagged: alert
📬 Notification sent to: Editor
🚩 Flagged for: Review
```

## Resources
- [Ascoos OS Documentation](/docs/)  
- [AWES Platform](https://awes.ascoos.com)  
- [GitHub Repository](https://github.com/ascoos/os)

## Contribution
You can extend this case study by adding new DSL commands, integrating additional NLP models, or customizing macro actions. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is covered under the Ascoos General License (AGL). See [LICENSE.md](/LICENSE.md) for details.
