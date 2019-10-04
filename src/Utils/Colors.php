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

namespace Wladweb\Phpconsole\Utils;

/**
 * Bash Colors
 *
 * @author wladweb
 */
class Colors
{
    private const COLOR_DEFAULT = 39;
    private const COLOR_BLACK = 30;
    private const COLOR_RED = 31;
    private const COLOR_GREEN = 32;
    private const COLOR_YELLOW = 33;
    private const COLOR_BLUE = 34;
    private const COLOR_MAGENTA = 35;
    private const COLOR_CYAN = 36;
    private const COLOR_WHITE = 97;
    private const BG_DEFAULT = 49;
    private const BG_BLACK = 40;
    private const BG_RED = 41;
    private const BG_GREEN = 42;
    private const BG_YELLOW = 43;
    private const BG_BLUE = 44;
    private const BG_MAGENTA = 45;
    private const BG_CYAN = 46;
    private const BG_WHITE = 107;

    private const LINE_START = "\e[";
    public const LINE_END = "\e[0m";
    
    /**
     * 
     * Text color
     * @param string $color 
     * 
     * Background color
     * @param string $bg 
     * 
     * First part of color string, like "\e[31;45m"
     * @return string 
     */
    public static function getPalette(string $color = 'default', string $bg = 'default'): string
    {
        $palette = self::LINE_START;
        
        $color_code = 'COLOR_' . strtoupper($color);
        $bg_code = 'BG_' . strtoupper($bg);
        
        if (defined("self::$color_code")){
            $palette .= constant("self::$color_code");
        } else {
            $palette .= self::COLOR_DEFAULT;
        }
        
        $palette .= ";";
        
        if (defined("self::$bg_code")){
            $palette .= constant("self::$bg_code");
        } else {
            $palette .= self::BG_DEFAULT;
        }
        
        $palette .= "m";
        
        return $palette;
    }
}
