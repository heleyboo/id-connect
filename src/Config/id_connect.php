<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ID Root Url
    |--------------------------------------------------------------------------
    */
    'root_url' => env('ID_URL'),

    /*
    |--------------------------------------------------------------------------
    | API Key to access internal APIs
    |--------------------------------------------------------------------------
    */
    'api_key' => env('ID_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Custom models
    |--------------------------------------------------------------------------
    | Your models to which data should be returned.
    |
    | Your own models should extends the base models.
    |
    */
    'models' => [
        'user' => \SonLeu\IDConnect\Models\User::class,
        'position' => \SonLeu\IDConnect\Models\Position::class,
        'department' => \SonLeu\IDConnect\Models\Department::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'ttl' => env('ID_CACHE_TTL', 300),
    ],
];
