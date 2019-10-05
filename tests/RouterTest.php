<?php

namespace Wladweb\Phpconsole\Tests;

use PHPUnit\Framework\TestCase;
use Wladweb\Phpconsole\Router;
use Wladweb\Phpconsole\Exceptions\RunTimeException;

/**
 * Description of RouterTest
 */
class RouterTest extends TestCase
{
    private $router;
    
    public function setUp(): void
    {
        $this->router = new Router;
    }
    
    public function testExceptionControllerNotExtendsAbstractController()
    {
        $arguments = [
            'script', //script name
            'non_extends_controller', //controller exists but not extends Abstract controller
            'non_exists_action', //not exists action
            'par1', //paramter1
            'par2', //paramter2
        ];
        
        $this->expectException(RunTimeException::class);
        $this->router->run($arguments);
    }
    
    public function testExceptionActionNotExists()
    {
        $arguments = [
            'script', //script name
            'index', //exists controller
            'non_exists_action', //not exists action
            'par1', //paramter1
            'par2', //paramter2
        ];
        
        $this->expectException(RunTimeException::class);
        $this->router->run($arguments);
    }
    
    public function testExceptionTooFewArguments()
    {
        $arguments = [
            'script', //script name
            'second', //exists controller
            'params', //exists action has 2 parameters
            '12', //paramter1 numeric
        ];
        
        $this->expectException(RunTimeException::class);
        $this->router->run($arguments);
    }
    
    public function testExceptionWrongParameterType()
    {
        $arguments = [
            'script', //script name
            'second', //exists controller
            'params', //exists action
            'test', //paramter1 must be numeric
            'test', //paramter2 string
        ];
        
        $this->expectException(RunTimeException::class);
        $this->router->run($arguments);
    }
}
