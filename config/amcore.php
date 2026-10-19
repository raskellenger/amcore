<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Public contact details
    |--------------------------------------------------------------------------
    |
    | [PLACEHOLDER] Real values not supplied yet. While these are unset the
    | site shows a visible placeholder and hides the click-to-call button.
    | Set AMCORE_PHONE (digits, e.g. 8645550100) and AMCORE_EMAIL in .env.
    |
    */

    'phone' => env('AMCORE_PHONE'),
    'email' => env('AMCORE_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Shared whiteboard
    |--------------------------------------------------------------------------
    |
    | The internal /whiteboard page reads and writes this markdown file.
    | Claude and Grok read the same file. It is not a public page.
    |
    */

    'whiteboard_path' => env('AMCORE_WHITEBOARD_PATH', base_path('WHITEBOARD.md')),

];
