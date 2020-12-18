<?php

namespace App\Service;

use PDO;

class PDOFactory
{
    /**
     * @var PDO
     */
    public PDO $pdo;

    public function __construct(array $config)
    {
        $database = new PDO('mysql:host='.$config['db.host'].';dbname=' .$config['db.name']. '', $config['db.user'], $config['db.pass']);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo = $database;
    }

}