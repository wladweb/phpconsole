<?php

//this config file for wladweb/servicelocator
//read more https://github.com/wladweb/ServiceLocator

/*
  u can define here all classes of ur app, as object (new \A\B\Object)
  or as FQN string ("\A\B\Object")
  and also place here any other type values (int, string, array)
  then take it: $service = Application::get('index');
 */

return [
    //APPLICATION
    'application' => [
        'value' => [
            'name' => 'My Application',
            'version' => '1.0.0',
            'show_header' => true,
            'author' => '',
            //can add here more app info or settings, then handle it in app,
            //like Application::getOptions(): array
            'setting1' => false,
            'setting2' => false
        ],
        'alias' => 'app'
    ],
    
    //LOG FILE
    'log_file_path' => [
        'value' => __DIR__ . DIRECTORY_SEPARATOR . 'app.log',
        'alias' => 'logfile'
    ],
    
    //ROUTER
    'router' => [
        'value' => '\Wladweb\Phpconsole\Router'
    ],
    
    //CONTROLLERS
    /*
      controllers array index must begin from 'controller_',
      like 'controller_index', 'controller_beta' , etc...
      controller array must contain key 'value'
      with string like '\Fully\Qualified\Name\SomeController'
     */
    'controller_index' => [
        'value' => '\Wladweb\Phpconsole\Controllers\IndexController'
    ],
    'controller_second' => [
        'value' => '\Wladweb\Phpconsole\Controllers\SecondController'
    ],
];

