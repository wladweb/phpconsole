<?php

namespace Wladweb\Phpconsole;

use Wladweb\ServiceLocator\Container;
use Wladweb\ServiceLocator\Exceptions\NotFoundException;
use Wladweb\Phpconsole\Logger;
use Wladweb\Phpconsole\Exceptions\RunTimeException;

/**
 * Application class
 */
class Application
{
    private const CONFIG_FILE = 'config.php';

    private static $app_opts = [];
    private static $router;
    private static $log_file_size = 0;
    public static $app_dir;
    public static $container;

    public static function run($arguments): void
    {
        self::$app_dir = \realpath('.');
        self::$container = Container::getContainer(self::$app_dir . DIRECTORY_SEPARATOR . self::CONFIG_FILE);
        self::$router = self::get('router');
        self::$app_opts = self::get('application');
        
        self::$log_file_size = Logger::getLogFileSize();
        
        if (self::$app_opts['show_header']) {
            self::drawHeader();
        }
        
        $time = self::$router->run($arguments);
        
        self::drawFooter($time);
    }

    public static function get(string $name, array $definition = [])
    {
        try {
            $service = self::$container->get($name, []);
        } catch (NotFoundException $e){
            throw new RunTimeException("Service $name not found. Check config file");
        }
        return $service;
    }
    
    /**
     * Return application options
     * @return array
     */
    public static function getOptions(): array
    {
        return self::$app_opts;
    }

    private static function drawHeader(): void
    {
        Logger::drawLine();
        
        Logger::writeSimpleLine(self::$app_opts['name'], 'white', 'green');
        Logger::writeSimpleLine('Version: ' . self::$app_opts['version']);
        Logger::writeSimpleLine('Log file size: ' . Logger::getLogFileSize() . ' bytes.');
        
        Logger::drawLine();
    }

    private static function drawFooter($time)
    {
        Logger::drawLine();
        Logger::write("Completed in ");
        Logger::write($time, 'black', 'magenta');
        Logger::write(" seconds.");
        
        if (self::$log_file_size < Logger::getLogFileSize()){
            Logger::write(' Log file has ');
            Logger::write('new records', 'black', 'cyan');
        }
        
        echo PHP_EOL;
    }
}
