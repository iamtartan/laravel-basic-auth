<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP Basic Auth Credentials
    |--------------------------------------------------------------------------
    |
    | The user credentials which are used when logging in with HTTP basic
    | authentication.
    |
    */

    'users' => [
        'main' => [
            env('SEPAR_USER'),
            env('SEPAR_PASSWORD'),
        ],
    ],

];
