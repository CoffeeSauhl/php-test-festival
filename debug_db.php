<?php

$config =json_decode(
    file_get_contents(__DIR__ . '/src/config/prod/database.json')
);

$connection = new PDO (
    $config->dsn,
    $config->user,
    $config->password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

var_dump($connection);