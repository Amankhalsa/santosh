<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
     'google' => [
    'client_id' => '318454822539-j3aahhk52bbc0ap0n46t5iend4oec7a8.apps.googleusercontent.com',
    'client_secret' => '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',
    'redirect' => 'https://luxuryeyewear.in/callback/google',
  ], 
  'facebook' => [
     'client_id' => '313257030709571',
     'client_secret' => 'eb7229e0e28bc848b1a04b44b6ca0c5a',
     'redirect' => 'https://luxuryeyewear.in/callback/facebook',
   ], 

];
