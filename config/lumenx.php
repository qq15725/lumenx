<?php

return [
    'register_make_command' => app()->environment('local'),
    'service' => [
        'default_namespace' => '\Services',
    ],
    'model' => [
        'default_namespace' => '\Models',
    ],
    'request' => [
        'default_namespace' => '\Http\Requests',
    ],
    'controller' => [
        'default_namespace' => '\Http\Controllers',
    ],
    'resource' => [
        'default_namespace' => '\Http\Resources',
        'open_include' => false,
    ],
];