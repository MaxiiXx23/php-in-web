<?php

namespace Max\CafeSerenata\Infra\Database;

use PDO;

require_once 'vendor/autoload.php';

class ConnectionBD
{
    // Pattern Static Create Method
    public static function execute(): \PDO
    {

        // exemplo com MYSQL
        $pdo = new PDO(
            dsn: 'mysql:host=localhost;dbname=serenatto',
            username: 'maxdev',
            password: '2323'
        );

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
