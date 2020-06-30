<?php

$config = [
    'host' => 'localhost',
    'db'   => 'test',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4',
    'opt' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
];
