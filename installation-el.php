<?php
$aos_version = "1.0+";
$php_version = "8.4+";
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ascoos OS API – Εγκατάσταση</title>
    <meta name="description" content="Οδηγίες εγκατάστασης του Ascoos OS API: Απαιτήσεις, βήματα ρύθμισης και troubleshooting για προγραμματιστές.">
    <meta name="keywords" content="Ascoos OS API, Εγκατάσταση, PHP, Server Requirements, Setup">
    <meta name="author" content="Ομάδα Ascoos">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Ascoos OS API – Εγκατάσταση">
    <meta property="og:description" content="Βήμα-βήμα οδηγός εγκατάστασης του Ascoos OS API για γρήγορη έναρξη ανάπτυξης.">
    <meta property="og:image" content="https://www.ascoos.com/images/ascoos/ascoos_icon_256.png">
    <meta property="og:url" content="installation-el.php">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="el_GR">

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
        <h1 class="blib-h-heading-frame-bottom-inset font48">Ascoos OS API – Εγκατάσταση</h1>
        <button type="button" class="toc-toggle-btn" id="tocToggle" onclick="toggleTOC()">📑 TOC</button>
    </header>

        <nav class="sticky-toc" id="tocNav">
            <h2 class="font26">📑 Περιεχόμενα</h2>
            <ul class="blib-h-ul-style-spaced-medium blib-h-li-e-ani-zoom-in">
                <li class="blib-h-li-icon-before-book"><a href="#απαιτήσεις" class="blib-h-a-line-slide">Απαιτήσεις Συστήματος</a></li>
                <li class="blib-h-li-icon-before-book"><a href="#βήματα" class="blib-h-a-line-slide">Βήματα Εγκατάστασης</a></li>
                <li class="blib-h-li-icon-before-book"><a href="#ρύθμιση" class="blib-h-a-line-slide">Ρύθμιση και Δοκιμή</a></li>
                <li class="blib-h-li-icon-before-book"><a href="#troubleshooting" class="blib-h-a-line-slide">Troubleshooting</a></li>
            </ul>
        </nav>

    <div class="container">
        <div class="blib-flex blib-flex-row blib-flex-space-between font20">
            <span><i class="bfi-cubes blib-c-red-heart"></i> <?php echo "AOS $aos_version, PHP $php_version"; ?></span>
            <span><a href="installation.php" class="blib-txt-decor-none font24"><img class="flags" src="https://cdn.ascoos.com/images/flags/gb.webp" alt="English"></a></span>
        </div><br><br>

        <h2 id="απαιτήσεις" class="blib-h-heading-layout-inline-pill-final">Απαιτήσεις Συστήματος</h2>
        <ul class="blib-h-ul-style-spaced-medium">
            <li class="blib-h-li-icon-before-check">PHP 8.2+ με extensions: IonCube loaders, JSON, cURL.</li>
            <li class="blib-h-li-icon-before-check">MariaDB 11.4+ ή MongoDB 8.0+ ή JSQLDB 1.0+.</li>
            <li class="blib-h-li-icon-before-check">Web Server: Apache 2.4+.</li>
            <li class="blib-h-li-icon-before-check">Προτεινόμενη Μνήμη: 512MB+ RAM.</li>
        </ul>

        <hr class="blib-h-hr-glow"><br>

        <h2 id="βήματα" class="blib-h-heading-layout-inline-pill-final">Βήματα Εγκατάστασης</h2>
        <ol class="number">
            <li>Κατεβάστε το εμπορικό πακέτο, βάσει της άδειας χρήσης που διαθέτετε, από την επίσημη ιστοσελίδα για κατέβασμα</li>
            <li>Εξαγάγετε σε οποιονδήποτε φάκελο επιθυμείτε μέσα στο root σας</li>
            <li>Για την διαμόρφωση έχετε τρεις επιλογές:
                <ol class="lalpha">
                    <li>
                        <p><code><i class="bfi-heart blib-c-red-heart font36"></i> <strong>Prepend Autoload</strong></code>: Εάν έχετε πρόσβαση στο php.ini διαμορφώστε την οδηγία <strong>auto_prepend_file</strong>
                    με τον κατάλληλο φάκελο ώστε να φορτώνει αυτόματα το <strong>ascoos OS</strong> σε κάθε αίτημά σας.
                        </p>
                        <div class="code-block" data-type="php" data-title="Prepend Autoload File">
                            <pre><code>auto_prepend_file ="/root/.../aos/autoload.php"</code></pre>
                        </div><br>
                    </li>
                    <li>
                        <p><code><i class="bfi-ok blib-c-green font20"></i> <strong>spl_autoload</strong></code>: Μπορείτε να φορτώσετε δυναμικά το <strong>Ascoos OS</strong> με χρήση της βιβλιοθήκης SPL.</p>
                        <div class="code-block" data-type="php" data-title="SPL Autoload">
                            <pre><code>spl_autoload_extensions('autoload.php');
spl_autoload_register();</code></pre>
                        </div><br>
                    </li>
                    <li>
                        <p><code><i class="bfi-ok blib-c-green font20"></i> <strong>require_once</strong></code>: Μπορείτε να φορτώσετε το <strong>Ascoos OS</strong> μέσα στο αρχείο σας php χρησιμοποιώντας την php function "require_once".</p>
                        <div class="code-block" data-type="php" data-title="Require Once">
                            <pre><code>require_once "root/.../aos/autoload.php";</code></pre>
                        </div>
                    </li>
                </ol>
            </li>
        </ol>

        <hr class="blib-h-hr-glow"><br>

        <h2 id="ρύθμιση" class="blib-h-heading-layout-inline-pill-final">Ρύθμιση και Δοκιμή</h2>
        <ul class="blib-h-ul-style-icon-arrow">
            <li class="blib-h-li-padding-small">Εάν δεν έχετε επιλέξει την πρώτη επιλογή εγκατάστασης, ρυθμίστε σε κάθε σας project το configuration, ώστε να δείχνει στην σωστή διαδρομή που βρίσκεται το <strong>Ascoos OS</strong> ώστε να λειτουργήσει σωστά το OTA, αλλιώς αγνοήστε αυτό το βήμα. Η εγγενής πολυνηματική υποστήριξη θα υποστηρίξει παράλληλες διεργασίες από κάθε ιστοσελίδα σας</li>
            <li class="blib-h-li-padding-small">Αντιγράψτε τα περιεχόμενα του φακέλου <code><strong>home</strong></code> σε ένα domain/subdomain ώστε να μπορείτε να εργαστείτε με το desktop-like περιβάλλον του <code>Ascoos OS</code>.</li>
            <li class="blib-h-li-padding-small">Συνδεθείτε με το default <code>root:root</code> και διαμορφώστε οπτικά και γρήγορα όλες τις παραμέτρους του <code>Ascoos OS.</code></li>
        </ul>

        <hr class="blib-h-hr-glow"><br>

        <h2 id="troubleshooting" class="blib-h-heading-layout-inline-pill-final">Αντιμετώπιση προβλημάτων</h2>
        <ul class="blib-h-ul-style-icon-arrow">
            <li class="blib-h-li-padding-small">Φυσιολογικά δεν θα πρέπει να υπάρχει κανένα σφάλμα. Εάν σας παρουσιαστούν, ελέγξτε τα logs και τις ρυθμίσεις σας στο php.ini</li>
            <li class="blib-h-li-padding-small">Σφάλματα 403-404: Ρυθμίστε .htaccess.</li>
        </ul>
    </div><br><br>

    <script src="https://docs.ascoos.com/assets/js/ascoos.os.api.min.js"></script>
</body>
</html>