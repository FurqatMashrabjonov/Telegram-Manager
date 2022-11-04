<?php

return [
    'commands' => [
        'start' => \App\Telegram\Commands\Start::class
    ],

    'languages' => [
        '🇺🇿O\'zbek tili' => 'uz',
        '🇬🇧English' => 'en',
        '🇷🇺Русский' => 'ru'
    ],

    'menus' => require_once app_path('Telegram/Resources/menu/index.php'),
    'uz' => require_once app_path('Telegram/Resources/lang/uz.php'),
    'ru' => require_once app_path('Telegram/Resources/lang/ru.php'),
    'en' => require_once app_path('Telegram/Resources/lang/en.php'),

];
