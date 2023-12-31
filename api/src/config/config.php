<?php

return [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => '3308',
    'database' => 'landlords', // database name
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
    'options' => [ // PDO constructor options
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
    'secretKey' => 'fGHJSIUoewikdejocjqncklnqwolecwkjnclihwbiucwq' // secret key for JWT
];
