<?php


namespace App\Manager;


use App\Service\PDOFactory;

abstract class Manager
{
    /**
     * @var PDOFactory
     */
    public $pdo;

    /**
     * Manager constructor.
     * @param PDOFactory $pdo
     */
    public function __construct(PDOFactory $pdo)
    {

        $this->pdo = $pdo->pdo;
    }
}