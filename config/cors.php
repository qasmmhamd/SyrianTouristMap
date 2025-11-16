<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods'   => ['*'],
    'allowed_origins'   => [
        'http://127.0.0.1:3000',
        'http://localhost:3000',

    ],
    'allowed_origins_patterns' => [
        '/^https?:\/\/([a-z0-9-]+\.)?annaponsprojects\.com$/',
    ],
    'allowed_headers'   => ['*'],
    'exposed_headers'   => [],
    'max_age'           => 3600,
    'supports_credentials' => true,
];

// return [


   
//     'paths' => ['api/*','*'],

//     'allowed_methods' => ['*'],

//     'allowed_origins' => [
//         'http://localhost:3000',
//         'http://127.0.0.1:3000',
//     ],

//     'allowed_origins_patterns' => [],

//     'allowed_headers' => ['*'],

//     'exposed_headers' => [],

//     'max_age' => 0,

//     'supports_credentials' => true,

// ];