<?php

/*
 * The MIT License
 *
 * Copyright 2019 wladweb.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Wladweb\Phpconsole;

use Wladweb\ServiceLocator\Container;
use Wladweb\ServiceLocator\Exceptions\NotFoundException;
use Wladweb\Phpconsole\Logger;
use Wladweb\Phpconsole\Exceptions\RunTimeException;

/**
 * Application class
 *
 * @author wladweb
 */
class Application
{
    private const CONFIG_FILE = 'config.php';

    private static $app_opts = [];
    public static $app_dir;
    public static $container;

    public static function run(): void
    {
        self::$app_dir = \realpath('.');
        self::$container = Container::getContainer(self::$app_dir . DIRECTORY_SEPARATOR . self::CONFIG_FILE);
        self::$app_opts = self::get('application');

        if (self::$app_opts['show_header']) {
            self::drawHeader();
        }
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
        Logger::writeSimpleLine('Log file size: ' . Logger::getLogFileSize());
        
        Logger::drawLine();
    }

}
