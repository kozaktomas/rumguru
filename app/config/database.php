<?php

require __DIR__ . "/../../vendor/autoload.php";

use Nette\Http\Url;


$databaseConfig = [];


if ($databaseUrl = getenv('RUMGURU_DATABASE_URL')) {
    $databaseUrl = new Url($databaseUrl);

    $schema = $databaseUrl->scheme;
    $host = $databaseUrl->host;
    $port = $databaseUrl->port;
    $user = $databaseUrl->user;
    $password = $databaseUrl->password;
    $database = trim($databaseUrl->path, '/\\');

    $databaseConfig = [
        'database' => [
            'dsn' => "{$schema}:host={$host};dbname={$database}",
            'user' => $user,
            'password' => $password,
        ],
    ];
}

return $databaseConfig;