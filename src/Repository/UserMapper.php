<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\DBAL\Connection;

class UserMapper
{
    public function __construct(private Connection $connection)
    {
    }

    public function save(User $user): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO users (username, password, created_at)
            VALUES (:username, :password, :created_at)        
        ");

        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':created_at', $user->getCreatedAt()->format('Y-m-d H:i:s'));

        $stmt->executeStatement();

        $id = $this->connection->lastInsertId();

        $user->setId($id);
    }
}