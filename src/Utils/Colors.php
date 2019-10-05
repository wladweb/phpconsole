<?php

namespace Wladweb\Phpconsole\Utils;

/**
 * Bash Colors
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
