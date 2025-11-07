<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // Whitelist for application submission rate limiting (comma-separated IPs)
    'applications_whitelist' => env('RATE_LIMIT_WHITELIST', ''),

    // Telegram bot settings for application notifications
    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        // Можно указать один ID (TELEGRAM_CHAT_ID) или список через запятую (TELEGRAM_CHAT_IDS)
        'chat_id' => env('TELEGRAM_CHAT_ID'),
        'chat_ids' => env('TELEGRAM_CHAT_IDS'),
        'api_url' => env('TELEGRAM_API_URL', 'https://api.telegram.org'),
    ],

];
