<?php

define('PHPCONSOLE_DEBUG', true);

if (PHPCONSOLE_DEBUG) {
    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);
}

require_once 'vendor/autoload.php';

$config = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
$container = \Wladweb\ServiceLocator\Container::getContainer($config);
$application = null;

try {
    $application = $container->get('phpconsole');
} catch (\Wladweb\ServiceLocator\Exceptions\NotFoundException $e) {
    \Wladweb\Phpconsole\Logger::writeBad('Application class not found. Check config.');
}

if ($application) {
    try {
        $application->run();
    } catch (\Wladweb\Phpconsole\Exceptions\LogException | \Wladweb\Phpconsole\Exceptions\RunTimeException $e) {
        \Wladweb\Phpconsole\Logger::handle($e);
    }
}