<?php

return [
    'database' => [
        'name' => 'dexstroll_db',
        'username' => 'root',
        'password' => 'root',
        'connection' => 'mysql:host=db',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];