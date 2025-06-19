<?php

return [

    'paths' => ['api/*', 'register', 'login', 'sanctum/csrf-cookie', 'workout-plans', 'workout-plans/*', 'trainers', 'trainers/*', 'exercises', 'exercises/*', 'clients', 'clients/*', 'client-profiles', 'client-profiles/*', 'edit_client_profile', 'edit_client_profile/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
