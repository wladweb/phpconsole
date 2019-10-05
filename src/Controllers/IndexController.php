<?php

namespace Wladweb\Phpconsole\Controllers;

use Wladweb\Phpconsole\Controllers\AbstractController;
use Wladweb\Phpconsole\Logger;

/**
 * Description of IndexController
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        //by echo
        echo "It's indexAction from IndexController.", PHP_EOL;
        
        //or by Logger
        Logger::writeLine("It's indexAction from IndexController. Regular");
        
        //or custom colors @see Wladweb\Phpconsole\Utils\Colors
        Logger::writeLine("It's indexAction from IndexController. Custom", 'blue', 'black');
        
        //or predefined error
        Logger::writeBad("It's indexAction from IndexController. Error");
        
        //or predefined warning
        Logger::writeWarning("It's indexAction from IndexController. Warning");
        
        //or predefined good
        Logger::writeGood("It's indexAction from IndexController. Good");
        
        //or predefined info
        Logger::writeInfo("It's indexAction from IndexController. Info");
        
        //test Action running time.     ~0.12s
        for ($i = 0; $i < 1000000; $i++){
            //
        }
    }
}
