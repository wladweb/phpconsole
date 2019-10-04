<?php

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
    ]
];

