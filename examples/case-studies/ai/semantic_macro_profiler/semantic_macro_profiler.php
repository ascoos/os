<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @CASE-STUDY         : semantic_macro_profiler.php
 * @fileNo             : ASCOOS-OS-CASESTUDY-SEC02235
 * 
 * @desc <English> Creates a semantic macro profiler using DSL, NLP, and AI. 
 *                 Analyzes editorial content, predicts macro execution, 
 *                 visualizes semantic scores, and stores results.
 * @desc <Greek> Δημιουργεί semantic macro profiler με χρήση DSL, NLP και AI. 
 *               Αναλύει συντακτικό περιεχόμενο, προβλέπει εκτέλεση macro, 
 *               οπτικοποιεί semantic scores και αποθηκεύει αποτελέσματα.
 * 
 * @since PHP 8.2.0+
 */
declare(strict_types=1);

// -----------------------------------------------------------------------------
// <English> Import required Ascoos OS classes
// <Greek> Εισαγωγή απαιτούμενων κλάσεων του Ascoos OS
// -----------------------------------------------------------------------------
use ASCOOS\OS\Kernel\{
    Parsers\DSL\AbstractDslAstBuilder,
    Parsers\DSL\AstMacroTranslator,
    AI\NLP\TLanguageProcessingAIHandler,
    AI\NeuralNet\TNeuralNetworkHandler,
    Arrays\Events\TEventHandler,
    Graphs\Charts\TChartsHandler,
    Core\Errors\Messages\TErrorMessageHandler,
    Files\TFilesHandler
};

global $AOS_TMP_DATA_PATH, $AOS_FONTS_PATH, $AOS_LOGS_PATH;

// -----------------------------------------------------------------------------
// <English> Define configuration properties
// <Greek> Ορισμός ρυθμίσεων για αποθήκευση και γραφήματα
// -----------------------------------------------------------------------------
$properties = [
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/semantic_macro_profiler',
        'quotaSize' => 1000000000 // ~1GB quota
    ],
    'LineChart' => [
        'width' => 900,
        'height' => 500,
        'fontPath' => $AOS_FONTS_PATH . '/Murecho/Murecho-Regular.ttf',
        'backgroundColorIndex' => 1,
        'lineColorIndex' => 4,
        'axisColorIndex' => 0
    ],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH .'/',
        'file' => 'semantic_macro_profiler.log'
    ]
];

// -----------------------------------------------------------------------------
// <English> Initialize handlers
// <Greek> Αρχικοποίηση χειριστών NLP, AI, αρχείων, γραφημάτων, συμβάντων, σφαλμάτων
// -----------------------------------------------------------------------------
$nlp    = new TLanguageProcessingAIHandler();
$ai     = new TNeuralNetworkHandler();
$files  = new TFilesHandler([], $properties['file']);
$chart  = new TChartsHandler([], $properties['LineChart']);
$event  = new TEventHandler([], $properties);
$error  = new TErrorMessageHandler('el-GR', $properties);

// -----------------------------------------------------------------------------
// <English> Define DSL macro script
// <Greek> Ορισμός macro script σε DSL
// -----------------------------------------------------------------------------
$dsl = <<<DSL
WHEN sentiment = negative AND topic = "security" THEN
    TAG "risk"
    NOTIFY "admin"
    EXECUTE "audit_macro"
DSL;

// -----------------------------------------------------------------------------
// <English> NLP analysis
// <Greek> Ανάλυση περιεχομένου με NLP για συναίσθημα και θεματική
// -----------------------------------------------------------------------------
$text      = "The system shows vulnerabilities in authentication and encryption. Immediate review is required.";
$sentiment = $nlp->naiveBayesSentiment($text);
$concepts  = $nlp->conceptActivationVector(['security', 'vulnerabilities', 'authentication'], [$text]);

// -----------------------------------------------------------------------------
// <English> AI prediction
// <Greek> Εκπαίδευση νευρωνικού δικτύου και πρόβλεψη εκτέλεσης macro
// -----------------------------------------------------------------------------
$ai->compile([
    ['input' => 3, 'output' => 4, 'activation' => 'relu'],
    ['input' => 4, 'output' => 1, 'activation' => 'sigmoid']
]);
$ai->fit([[0.9, 0.2, 0.8], [0.3, 0.7, 0.4]], [1, 0], epochs: 500, lr: 0.01);
$score = $ai->predictNetwork([[0.8, 0.3, 0.9]])[0];

// -----------------------------------------------------------------------------
// <English> DSL → AST → Macro
// <Greek> Μετάφραση DSL σε AST και δημιουργία macro container
// -----------------------------------------------------------------------------
$astBuilder = new class extends AbstractDslAstBuilder {};
$ast        = $astBuilder->buildAst($dsl);

$translator = new class([
    'TAG'      => fn(string $tag) => print("Tagged: $tag\n"),
    'NOTIFY'   => fn(string $who) => print("Notification sent to: $who\n"),
    'EXECUTE'  => fn(string $macro) => print("Executing macro: $macro\n"),
    'sentiment'=> fn() => $sentiment,
    'topic'    => fn() => in_array('security', $concepts) ? 'security' : 'other'
]) extends AstMacroTranslator {};

$macroContainer = $translator->translateAst($ast);

// -----------------------------------------------------------------------------
// <English> Semantic profiling
// <Greek> Δημιουργία semantic profile με NLP και AI δεδομένα
// -----------------------------------------------------------------------------
$profile = [
    'sentiment' => $sentiment,
    'topic'     => $concepts,
    'ai_score'  => $score,
    'triggered' => $score > 0.5
];

// -----------------------------------------------------------------------------
// <English> Save semantic profile
// <Greek> Αποθήκευση semantic profile σε JSON αρχείο
// -----------------------------------------------------------------------------
$folder = $properties['file']['baseDir'];
$files->createFolder($folder);
$files->writeToFileWithCheck(
    json_encode($profile, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    $folder . '/semantic_profile.json'
);

// -----------------------------------------------------------------------------
// <English> Generate semantic graph
// <Greek> Δημιουργία γραφήματος για AI score και συναίσθημα
// -----------------------------------------------------------------------------
$chart->setArray([$score, ($sentiment === 'negative') ? 1 : 0], ['charts']);
$chart->LineChart($folder . '/semantic_profile.png');

// -----------------------------------------------------------------------------
// <English> Execute macro if AI score passes threshold
// <Greek> Εκτέλεση macro αν η πρόβλεψη AI είναι θετική
// -----------------------------------------------------------------------------
if ($score > 0.5) {
    $macroContainer->executeIfTrue();
    $event->register('macro_triggered', 'semantic_profiler', fn() =>
        $event->logger?->log('Macro triggered based on semantic profile', $event::DEBUG_LEVEL_INFO)
    );
    $event->trigger('macro_triggered', 'semantic_profiler');
} else {
    print("Macro skipped due to low AI score\n");
}


// -----------------------------------------------------------------------------
// <English> Free resources
// <Greek> Απελευθέρωση πόρων και χειριστών
// -----------------------------------------------------------------------------
$error->Free();
$chart->Free();
$event->Free();
$ai->Free();
$nlp->Free();
?>
