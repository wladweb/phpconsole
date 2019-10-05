<?php

namespace Wladweb\Phpconsole\Controllers;

/**
 * AbstractController
 */
abstract class AbstractController
{
    //common stuff for all controllers
    //all controllers must extends this class
    
    abstract public function indexAction();
}
