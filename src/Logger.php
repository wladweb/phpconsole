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

use Wladweb\Phpconsole\Exceptions\LogException;
use Wladweb\Phpconsole\Exceptions\RunTimeException;
use Wladweb\Phpconsole\Utils\Colors;
use Wladweb\Phpconsole\Application as App;

/**
 * Write log, show color messages in bash console
 *
 * @author wladweb
 */
class Logger
{
    private const LOG_FILE_INDEX = 'log_file_path';

    /**
     * Recieve & handle exceptions
     * @param \Exception $e
     * @return void
     */
    public static function handle(\Exception $e): void
    {
        if ($e instanceof LogException) {
            self::handleLogException($e);
        } elseif ($e instanceof RunTimeException) {
            self::handleRunTimeException($e);
        } else {
            echo $e->getMessage();
        }
    }

    /**
     * Formatting exception & write into log
     * @param LogException $e
     * @return void
     */
    private static function handleLogException(LogException $e): void
    {
        self::writeLog(' EXCEPTION: ' . $e->getCode() . ' -- ' . $e->getMessage());
    }

    /**
     * Print colored exception message into console
     * @param RunTimeException $e
     * @return void
     */
    private static function handleRunTimeException(RunTimeException $e): void
    {
        self::write(' EXCEPTION: ', 'white', 'red');
        self::write($e->getMessage(), 'red', 'white');
        echo PHP_EOL;
    }

    /**
     * Return log file object
     * @return \SplFileObject
     * @throws RunTimeException Can't open file
     */
    private static function getLogFileObject(): \SplFileObject
    {
        $log_file_path = App::get(self::LOG_FILE_INDEX);

        try {
            $log_file = new \SplFileObject($log_file_path, 'a');
        } catch (\RuntimeException $e) {
            throw new RunTimeException("Сan not open the log file $log_file_path");
        }
        return $log_file;
    }

    /**
     * Add time string & write any text into log file
     * @param string $text
     * @return int
     * @throws RunTimeException can't write into log file
     */
    public static function writeLog(string $text): int
    {
        $text = self::getTime() . ' ' . $text;
        $logfile_object = self::getLogFileObject();
        $bytes = $logfile_object->fwrite($text);

        if ($bytes === 0) {
            throw new RunTimeException("Сan not write into log file");
        }

        return $bytes;
    }

    /**
     * Return log file size
     * @return string bytes
     */
    public static function getLogFileSize(): string
    {
        $logfile_object = self::getLogFileObject();
        $stat = $logfile_object->fstat();
        $size_string = (string) $stat['size'] . ' bytes';
        return $size_string;
    }

    /**
     * Print any colored text into console
     * @param string $text Text
     * @param string $color Text color
     * @param string $background Backgound color
     * @return void
     */
    public static function write(string $text, string $color = '', string $background = ''): void
    {
        $palette = Colors::getPalette($color, $background);
        $message = $palette . $text . Colors::LINE_END;

        echo $message;
    }

    /**
     * Print text & add time string & switch line
     * @param string $text Text
     * @param string $color Text color
     * @param string $background Backgound color
     * @return void
     */
    public static function writeLine(string $text, string $color = '', string $background = '')
    {
        echo self::getTime() . ' -- ';
        self::writeSimpleLine($text, $color, $background);
    }
    
    /**
     * Print line without time string
     * @param string $text
     * @param string $color
     * @param string $background
     */
    public static function writeSimpleLine(string $text, string $color = '', string $background = '')
    {
        self::write($text, $color, $background);
        echo PHP_EOL;
    }

    /**
     * Return formatted date string
     * @return string
     */
    private static function getTime(): string
    {
        return \date('d.m.y H:i:s', \time());
    }

    /**
     * 
     * @param string $type Line symbol
     * @param int $count Line length
     * @param string $color Line color
     * @return void
     */
    public static function drawLine(string $type = '~', int $count = 90, string $color = 'default'): void
    {
        for ($i = 1; $i <= $count; $i++) {
            self::write($type, $color);
        }
        echo PHP_EOL;
    }

    public static function writeGood($text)
    {
        self::writeLine($text, 'white', 'green');
    }

    public static function writeBad($text)
    {
        self::writeLine($text, 'white', 'red');
    }

    public static function writeWarning($text)
    {
        self::writeLine($text, 'white', 'yellow');
    }

    public static function writeInfo($text)
    {
        self::writeLine($text, 'black', 'cyan');
    }

}
