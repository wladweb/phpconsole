<?php

namespace Wladweb\Phpconsole\Tests;

use PHPUnit\Framework\TestCase;
use Wladweb\Phpconsole\Logger;
use Wladweb\Phpconsole\Utils\Colors;

/**
 * Description of LoggerTest
 */
class LoggerTest extends TestCase
{
    public function testSimpleOutput()
    {
        $text = 'test_output';
        
        $palette = Colors::getPalette();
        $message = $palette . $text . Colors::LINE_END;
        
        $this->expectOutputString($message);
        
        Logger::write($text);
    }
    
    public function testColorOutput()
    {
        $text = 'test_output';
        
        $palette = Colors::getPalette('red', 'white');
        $message = $palette . $text . Colors::LINE_END;
        
        $this->expectOutputString($message);
        
        Logger::write($text, 'red', 'white');
    }
}
