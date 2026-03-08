<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Тут ми повертаємо стандартні налаштування. Для чистого Blade-проєкту
    | CORS взагалі не грає ролі, оскільки запити йдуть з того самого домену.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // Повертаємо порожній масив або видаляємо localhost:4200
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // ВАЖЛИВО: Ставимо false для звичайного веб-інтерфейсу
    'supports_credentials' => false,

];
