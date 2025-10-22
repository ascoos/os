<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @CASE-STUDY          : welcome.php
 * @fileNo              : ASCOOS-OS-CASESTUDY-SEC000000
 * 
 * @desc <EN> Welcome to Ascoos OS
 * @desc <GR> Καλώς ορίσατε στο Ascoos OS
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '    <title>Welcome to Ascoos OS</title>';
echo '    <style>';
echo '        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }';
echo '        .container { max-width: 800px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }';
echo '        h1 { color: #2c3e50; }';
echo '        p { font-size: 18px; color: #555; }';
echo '        img { margin-bottom: 20px; }';
echo '        a.button { display: inline-block; margin-top: 20px; padding: 12px 24px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }';
echo '        a.button:hover { background-color: #2980b9; }';
echo '    </style>';
echo '</head>';
echo '<body>';
echo '    <div class="container">';
echo '        <img src="https://dl.ascoos.com/images/ascoos.png" height="120" alt="Ascoos OS Logo" />';
echo '        <h1>Welcome to Ascoos OS!</h1>';
echo '        <p>Ascoos OS is a PHP Web 5.0 Kernel designed for decentralized web and IoT applications.</p>';
echo '        <p>It includes JSQLDB, macro engine, AI support, and over 4500 encrypted classes for networking, hardware, and more.</p>';
echo '        <p>Perfect for developers building modern, secure, and scalable applications.</p>';
echo '        <a class="button" href="https://www.ascoos.com" target="_blank">Visit the official website of Ascoos</a>';
echo '    </div>';
echo '</body>';
echo '</html>';