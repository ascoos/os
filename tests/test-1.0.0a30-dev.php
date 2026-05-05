<?php
/**
 * ASCOOS OS Kernel Test — Version 1.0.0 Alpha 30
 * Build: 17716
 * Purpose: Validate new UTF‑8, Math, CoreTrait and TStringList features.
 * Date: 2026‑05‑05
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Core\TObject;
use ASCOOS\OS\Kernel\Strings\Lists\TStringList;
use ASCOOS\OS\Kernel\Science\Maths\TMathHandler;

global $utf8;

// ------------------------------------------------------------
// 2. Use some core classes
// ------------------------------------------------------------

// TStringList example
$list = new TStringList();
$list->add("Hello");
$list->add("Ascoos OS");
$list->add("Web 5.0 Kernel");

$text = $list->getText();

// UTF‑8 example
$slug = $utf8->slugify("Αυτό είναι ένα παράδειγμα τίτλου!");

// Math example (ODE RK4)
$math = new TMathHandler();
$rk4 = $math->rk4(
    fn(float $t, float $y) => -2 * $y,  // The function f(t, y) representing the derivative dy/dt.
    1.0,                                // t0 = 1 -- Initial value of the independent variable.
    0.3,                                // y0 = 0 -- Initial value of the dependent variable at t0.
    0.1,                                // The fixed step size for integration.
    1                                   // The total number of iterations to perform.
);

// CoreTrait example (server memory)
$core = new class extends TObject {};
$mem = $core->getServerMemoryUsage();

$list->Free();
$math->Free();
$core->Free();

// ------------------------------------------------------------
// 3. Output HTML
// ------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ascoos OS Kernel Demo</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        h1 { color: #444; }
        pre { background: #f5f5f5; padding: 15px; border-radius: 6px; }
    </style>
</head>
<body>

<h1>Ascoos OS Kernel Demo</h1>

<h2>TStringList Output</h2>
<pre><?php echo $text; ?></pre>

<h2>UTF‑8 Slugify</h2>
<pre><?php echo $slug; ?></pre>

<h2>RK4 Example (dy/dt = -2y)</h2>
<pre><?php print_r($rk4); ?></pre>

<h2>Server Memory Usage</h2>
<pre><?php print_r($mem); ?></pre>

</body>
</html>