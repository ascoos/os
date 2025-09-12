<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Executes macros based on NLP analysis of editorial content using sentiment and topic detection.
 * @desc <Greek> Εκτελεί macros βάσει NLP ανάλυσης συντακτικού περιεχομένου με εντοπισμό συναισθήματος και θεματικής.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    AI\NLP\TLanguageProcessingAIHandler,
    Parsers\DSL\AbstractDslAstBuilder,
    Parsers\DSL\AstMacroTranslator
};

// <English> Sample editorial text.
// <Greek>   Δείγμα συντακτικού άρθρου.
$text = <<<TEXT
The economy continues to struggle under inflationary pressure. 
Unemployment is rising, and consumer confidence is falling.
TEXT;

// <English> Initialize NLP handler and extract sentiment and topic.
// <Greek>   Αρχικοποίηση NLP χειριστή και εξαγωγή συναισθήματος και θεματικής.
$nlp      = new TLanguageProcessingAIHandler();
$sentiment = $nlp->naiveBayesSentiment($text); // 'positive' or 'negative' or 'neutral'
$concepts  = $nlp->conceptActivationVector(['economy', 'inflation', 'jobs'], [$text]);

// <English> DSL script defining macro logic.
// <Greek>   DSL script που ορίζει τη λογική των macros.
$dsl = <<<DSL
WHEN sentiment = negative AND topic = "economy" THEN
    TAG "alert"
    NOTIFY "Editor"
    FLAG "Review"
DSL;

// <English> Build AST from DSL.
// <Greek>   Δημιουργία AST από DSL.
$astBuilder = new class extends AbstractDslAstBuilder {};
$ast        = $astBuilder->buildAst($dsl);

// <English> Translate AST into macro container.
// <Greek>   Μετάφραση AST σε container μακροεντολών.
$translator = new class([
    'TAG' => fn(string $tag) => print("🏷️ Tagged: $tag\n"),
    'NOTIFY' => fn(string $who) => print("📬 Notification sent to: $who\n"),
    'FLAG' => fn(string $flag) => print("🚩 Flagged for: $flag\n"),
    'sentiment' => fn() => $sentiment,
    'topic' => fn() => in_array('economy', $concepts) ? 'economy' : 'other'
]) extends AstMacroTranslator {};

$macroContainer = $translator->translateAst($ast);

// <English> Execute macros if NLP conditions are met.
// <Greek>   Εκτέλεση macros εάν πληρούνται οι NLP συνθήκες.
$macroContainer->executeIfTrue();
?>
