<?php

namespace Wladweb\Phpconsole;

use Wladweb\Phpconsole\Application as App;
use Wladweb\Phpconsole\Exceptions\RunTimeException;
use Wladweb\Phpconsole\Exceptions\LogException;
use Wladweb\Phpconsole\Controllers\AbstractController;

/**
 * Router
 */
class Router
{
    /**
     * Resolve gotten arguments on controller, action, parameters
     * @param array $arguments
     * @return string working time
     */
    public function run(array $arguments): string
    {
        array_shift($arguments); //remove script name
        $controller_index = array_shift($arguments); //get controller
        $action_index = array_shift($arguments); //get action

        if (!is_null($controller_index)) {
            $controller = 'controller_' . $controller_index;

            if (!is_null($action_index)) {
                $action = $action_index . 'Action';
            } else {
                $action = 'indexAction';
            }
        } else {
            $controller = 'controller_index';
            $action = 'indexAction';
        }

        return $this->process($controller, $action, $arguments);
    }

    /**
     * 
     * @param string $controller_index array_index for get controller from container
     * @param string $action action name
     * @param array $params params for action method
     * @return string working time
     * 
     * 1. If controller doesn't extend AbstractController
     * 2. If action method doesn't exists
     * 3. If parameters count less than expected
     * 4. If parameters type is wrong
     * @throws RunTimeException
     */
    private function process(string $controller_index, string $action, array $params): string
    {
        $controller = App::get($controller_index);

        if (!($controller instanceof AbstractController)){
            throw new RunTimeException('All controllers must extend AbstractController');
        }
        
        $reflection_controller = new \ReflectionObject($controller);

        if (!$reflection_controller->hasMethod($action)) {
            throw new RunTimeException("Method $action doesn't exists");
        }

        $time_start = microtime(true);

        try {
            call_user_func_array([$controller, $action], $params);
        } catch (\ArgumentCountError $e) {
            throw new RunTimeException($e->getMessage());
        } catch (\TypeError $error) {
            throw new RunTimeException($error->getMessage());
        } catch (LogException $le){
            Logger::handle($le);
        }

        $time_end = microtime(true);
        $time = $time_end - $time_start;
        
        return \number_format($time, 10, '.', '');
    }
}
