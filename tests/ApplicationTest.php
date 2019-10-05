<?php

namespace Wladweb\Phpconsole\Tests;

use Wladweb\Phpconsole\Application;
use PHPUnit\Framework\TestCase;
use Wladweb\Phpconsole\Exceptions\RunTimeException;
use Wladweb\Phpconsole\Controllers\AbstractController;

/**
 * Description of ApplicationTest
 */
class ApplicationTest extends TestCase
{
    public function setUp(): void
    {
        Application::run([]);
        $this->setOutputCallback(function() {});
    }
    
    public function testGetValueFromContainer()
    {
        Application::run([]);
        $key = 'test_key';
        $value = 'test_valye';
        
        Application::$container->set($key, [
            'value' => $value
        ]);
        
        $expected = Application::get($key);
        
        $this->assertEquals($expected, $value);
    }
    
    public function testExceptionWhenServiceNotFound()
    {
        $key = 'non_existing_key';
        
        $this->expectException(RunTimeException::class);
        Application::get($key);
    }
    
    public function testGetController()
    {
        $controller = Application::get('controller_second');
        
        $this->assertInstanceOf(AbstractController::class, $controller);
    }
}
