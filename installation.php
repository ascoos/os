<?php
$aos_version = "1.0+";
$php_version = "8.4+";
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ascoos OS API – Installation</title>
    <meta name="description" content="Installation guide for Ascoos OS API: Requirements, setup steps, and troubleshooting for developers.">
    <meta name="keywords" content="Ascoos OS API, Installation, PHP, Server Requirements, Setup">
    <meta name="author" content="Ascoos Team">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Ascoos OS API – Installation">
    <meta property="og:description" content="Step-by-step installation guide for Ascoos OS API for fast development startup.">
    <meta property="og:image" content="https://www.ascoos.com/images/ascoos/ascoos_icon_256.png">
    <meta property="og:url" content="installation.php">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="en_US">

    <!-- Language Alternates -->
    <link rel="canonical" hreflang="en" href="installation.php">
    <link rel="alternate" hreflang="el" href="installation-el.php">

    <!-- BootLib & Custom Styles -->
    <link rel="stylesheet" href="https://cdn.ascoos.com/bootlib/css/bootlib.min.css">
    <link rel="stylesheet" href="https://cdn.ascoos.com/bootlib/css/bootlib.ext.min.css">
    <link rel="stylesheet" href="https://docs.ascoos.com/themes/docs/api/os25/theme.css">
    <style>
        img.flags {
            width: 24px;
            height: 18px;
        }
    </style>

    <!-- Javascripts -->
    <script src="https://docs.ascoos.com/vendors/js/jquery.min.js"></script>
    <script src="https://docs.ascoos.com/assets/bootlib/js/plugins/html/preCodeManager.js"></script>
</head>
<body>
    <header>
        <h1 class="blib-h-heading-frame-bottom-inset font48">Ascoos OS API – Installation</h1>
        <button type="button" class="toc-toggle-btn" id="tocToggle" onclick="toggleTOC()">📑 TOC</button>
    </header>

    <nav class="sticky-toc" id="tocNav">
        <h2 class="font26">📑 Contents</h2>
        <ul class="blib-h-ul-style-spaced-medium blib-h-li-e-ani-zoom-in">
            <li class="blib-h-li-icon-before-book"><a href="#requirements" class="blib-h-a-line-slide">System Requirements</a></li>
            <li class="blib-h-li-icon-before-book"><a href="#steps" class="blib-h-a-line-slide">Installation Steps</a></li>
            <li class="blib-h-li-icon-before-book"><a href="#setup" class="blib-h-a-line-slide">Setup &amp; Testing</a></li>
            <li class="blib-h-li-icon-before-book"><a href="#troubleshooting" class="blib-h-a-line-slide">Troubleshooting</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="blib-flex blib-flex-row blib-flex-space-between font20">
            <span><i class="bfi-cubes blib-c-red-heart"></i> <?php echo "AOS $aos_version, PHP $php_version"; ?></span>
            <span><a href="installation-el.php" class="blib-txt-decor-none font24"><img class="flags" src="https://cdn.ascoos.com/images/flags/gr.webp" alt="Greek"></a></span>
        </div><br><br>

        <h2 id="requirements" class="blib-h-heading-layout-inline-pill-final">System Requirements</h2>
        <ul class="blib-h-ul-style-spaced-medium">
            <li class="blib-h-li-icon-before-check">PHP 8.2+ with extensions: IonCube loaders, JSON, cURL.</li>
            <li class="blib-h-li-icon-before-check">MariaDB 11.4+ or MongoDB 8.0+ or JSQLDB 1.0+.</li>
            <li class="blib-h-li-icon-before-check">Web Server: Apache 2.4+.</li>
            <li class="blib-h-li-icon-before-check">Recommended Memory: 512MB+ RAM.</li>
        </ul>

        <hr class="blib-h-hr-glow"><br>

        <h2 id="steps" class="blib-h-heading-layout-inline-pill-final">Installation Steps</h2>
        <ol class="number">
            <li>Download the commercial package, based on your license, from the official download website.</li>
            <li>Extract it into any folder you want inside your root directory.</li>
            <li>For configuration you have three options:
                <ol class="lalpha">
                    <li>
                        <p><code><i class="bfi-heart blib-c-red-heart font36"></i> <strong>Prepend Autoload</strong></code>: If you have access to php.ini, configure the <strong>auto_prepend_file</strong> directive with the appropriate folder so that <strong>Ascoos OS</strong> loads automatically on every request.</p>
                        <div class="code-block" data-type="php" data-title="Prepend Autoload File">
                            <pre><code>auto_prepend_file ="/root/.../aos/autoload.php"</code></pre>
                        </div><br>
                    </li>
                    <li>
                        <p><code><i class="bfi-ok blib-c-green font20"></i> <strong>spl_autoload</strong></code>: You can dynamically load <strong>Ascoos OS</strong> using the SPL library.</p>
                        <div class="code-block" data-type="php" data-title="SPL Autoload">
                            <pre><code>spl_autoload_extensions('autoload.php');
spl_autoload_register();</code></pre>
                        </div><br>
                    </li>
                    <li>
                        <p><code><i class="bfi-ok blib-c-green font20"></i> <strong>require_once</strong></code>: You can load <strong>Ascoos OS</strong> inside your PHP file using the PHP function "require_once".</p>
                        <div class="code-block" data-type="php" data-title="Require Once">
                            <pre><code>require_once "root/.../aos/autoload.php";</code></pre>
                        </div>
                    </li>
                </ol>
            </li>
        </ol>

        <hr class="blib-h-hr-glow"><br>

        <h2 id="setup" class="blib-h-heading-layout-inline-pill-final">Setup &amp; Testing</h2>
        <ul class="blib-h-ul-style-icon-arrow">
            <li class="blib-h-li-padding-small">If you did not choose the first installation option, configure each of your projects so that the configuration points to the correct path where <strong>Ascoos OS</strong> is located, so that OTA works properly. Otherwise, ignore this step. The native multithreading support will handle parallel processes from each of your websites.</li>
            <li class="blib-h-li-padding-small">Copy the contents of the <code><strong>home</strong></code> folder into a domain/subdomain so you can work with the desktop-like environment of <code>Ascoos OS</code>.</li>
            <li class="blib-h-li-padding-small">Log in with the default <code>root:root</code> and visually configure all parameters of <code>Ascoos OS</code> quickly and easily.</li>
        </ul>

        <hr class="blib-h-hr-glow"><br>

        <h2 id="troubleshooting" class="blib-h-heading-layout-inline-pill-final">Troubleshooting</h2>
        <ul class="blib-h-ul-style-icon-arrow">
            <li class="blib-h-li-padding-small">Normally, there should be no errors. If any appear, check your logs and php.ini settings.</li>
            <li class="blib-h-li-padding-small">403–404 errors: Configure your .htaccess.</li>
        </ul>
    </div><br><br>

    <script src="https://docs.ascoos.com/assets/js/ascoos.os.api.min.js"></script>
</body>
</html>