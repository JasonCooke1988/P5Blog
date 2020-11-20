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
        $db = new PDO('mysql:host='.$config['db.host'].';dbname=' .$config['db.name']. '', $config['db.user'], $config['db.pass']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo = $db;
    }

}