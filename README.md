# Laravel ID Connect Util

ID Integration with Laravel

## Table of Contents

1.  [Installation](#installation)
2.  [Configuration](#configuration)
3.  [Custom Models](#custom-models)
    
## Installation

Execute the following command to get the latest version of the package:

```terminal
composer require sonleu/id-connect
``` 

## Configuration

Add these inside of .env

```.env
ID_URL=<ID_BASE_API_URL>
ID_API_KEY=<ID_API_KEY>
```

Publish configs

```terminal
php artisan vendor:publish --tag=id_connect_config
```

## Custom models

By default, packages' models will be returned in api responses.

In case you want to customize the models, change the namespaces inside config.id_connect.models. For example:

```php
// config/id_connect.php

return [
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
        'user' => \App\User::class,
        'position' => \SonLeu\IDConnect\Models\Position::class,
        'department' => \SonLeu\IDConnect\Models\Department::class, 
    ]
];
```
