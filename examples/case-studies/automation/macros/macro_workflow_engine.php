<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Executes macro-based workflows with delay and priority using FIFO logic.
 * @desc <Greek> Εκτελεί αλυσίδες ενεργειών με καθυστέρηση και προτεραιότητα χρησιμοποιώντας λογική FIFO.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Arrays\Macros\TMacroHandler,
    Logger\TLoggerHandler
};

global $AOS_LOGS_PATH;

// 🔧 Configuration
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'macro_engine.log'
    ]
];

// 🚀 Initialize macro handler and logger
$macroHandler = new TMacroHandler([], $properties);
$logger = TLoggerHandler::getInstance($properties);
$macroHandler->setLogger($logger);

// 🧩 Add macros to queue
$macroHandler->addMacro(function () {
    echo "Step 1: Initialization<br>";
    return 'Init complete';
}, [], delay: 1, priority: 1);

$macroHandler->addMacro(function () {
    echo "Step 2: Processing<br>";
    return 'Processing done';
}, [], delay: 2, priority: 2);

$macroHandler->addMacro(function () {
    echo "Step 3: Finalization<br>";
    return 'Final step complete';
}, [], delay: 0, priority: 3);

// 🔁 Execute all macros in order
foreach ($macroHandler->runAll() as $result) {
    echo "Result: $result<br>";
}

// 🧹 Free resources
$macroHandler->Free($macroHandler);
$logger->Free($logger);
