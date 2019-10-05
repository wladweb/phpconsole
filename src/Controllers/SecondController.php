<?php

namespace Wladweb\Phpconsole\Controllers;

use Wladweb\Phpconsole\Controllers\AbstractController;
use Wladweb\Phpconsole\Exceptions\LogException;

/**
 * Description of SecondController
 */
class SecondController extends AbstractController
{
    public function indexAction()
    {
        echo "It's indexAction from SecondController", PHP_EOL;
    }
    
    public function paramsAction(int $param1, string $param2)
    {
        echo "It's paramsAction from SecondController", PHP_EOL;
        echo $param1, PHP_EOL;
        echo $param2, PHP_EOL;
    }
    
    public function logAction()
    {
        echo "It's logAction from SecondController", PHP_EOL;
        throw new LogException('Test Message droped by LogException');
    }
}
