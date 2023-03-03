<?php

namespace GaryClarke\Framework\Dbal;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class ConnectionFactory
{
    public function __construct(private string $databaseUrl)
    {
    }

    public function create(): Connection
    {
        return DriverManager::getConnection(['url' => $this->databaseUrl]);
    }
}