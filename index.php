<?php

define('PHPCONSOLE_DEBUG', true);

if (PHPCONSOLE_DEBUG) {
    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);
}

require_once 'vendor/autoload.php';

//$config = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
try {
    \Wladweb\Phpconsole\Application::run();
} catch (\Wladweb\Phpconsole\Exceptions\LogException | \Wladweb\Phpconsole\Exceptions\RunTimeException $e) {
    \Wladweb\Phpconsole\Logger::handle($e);
}