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

/**
 * Write log, show color messages in bash console
 *
 * @author wladweb
 */
class Logger
{
    public static function handle()
    {}
    
    private static function handleLogException(LogException $e){}
    
    private static function handleRunTimeException(RunTimeException $e){}
    
    public static function writeLog(string $text){}
    
    /**
     * 
     * @param string $text Text
     * @param string $color Text color
     * @param string $background Backgound color
     */
    private static function write(string $text, string $color = '', string $background = ''){}

    public static function writeGood($text){}
    public static function writeBad($text){}
    public static function writeInfo($text){}
}
