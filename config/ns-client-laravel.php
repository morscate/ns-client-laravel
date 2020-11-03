<?php

return [

    /*
    |--------------------------------------------------------------------------
    | NS API key
    |--------------------------------------------------------------------------
    |
    | The API key to authorize the requests.
    |
    */

    'api_key' => env('NS_API_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | NS base uri
    |--------------------------------------------------------------------------
    |
    | The base uri to make the requests to.
    |
    */

    'base_uri' => env('NS_BASE_URI', 'https://gateway.apiportal.ns.nl/reisinformatie-api/api/'),
];
