<?php

return [
    'register_make_command' => app()->environment('local'),
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
    'service' => [
        'default_namespace' => '\Services',
    ],
    'enum' => [
        'default_namespace' => '\Enums',
    ],
];