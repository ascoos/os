<?php
/**
 * @ASCOOS-NAME         : Ascoos OS
 * @ASCOOS-VERSION      : 1.0.0
 * @ASCOOS-SUPPORT      : support@ascoos.com
 * @ASCOOS-BUGS         : https://issues.ascoos.com
 *
 * @CLASS-METHOD-STUDY  : TArtificialIntelligenceHandler::binaryCrossEntropy()
 * @file                : binaryCrossEntropy-testhandler.php
 * @test                : Binary Cross-Entropy Visual Test
 *
 * @desc <English> Visual validation of Binary Cross-Entropy loss using TTestHandler.
 * @desc <Greek> Οπτική επαλήθευση απώλειας Binary Cross-Entropy με χρήση TTestHandler.
 *
 * @since PHP 8.4.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Tests\TTestHandler;
use ASCOOS\OS\Kernel\AI\TArtificialIntelligenceHandler;

$ai = new TArtificialIntelligenceHandler([], []);

$y_true = [1, 0, 1];
$y_pred = [0.9, 0.1, 0.8];

$expected = 0.14462152754329;
$actual   = $ai->binaryCrossEntropy($y_true, $y_pred);

$test = new TTestHandler([
    'titleTest' => 'Binary Cross-Entropy Loss Test',
    'subtitle'  => '1D Error Validation',
    'desc'      => 'Visual test of Binary Cross-Entropy loss'
]);

$test->runTest(
    name: 'Binary Cross-Entropy 1D',
    condition : $test->assertFloatEquals($expected, $actual, 1e-12),
    expected: $expected,
    actual: $actual,
    description: 'Binary Cross-Entropy computed correctly for 1D arrays'
);

$test->extractHTML(false);
$test->Free();
?>
