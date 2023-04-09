<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\DBAL\Connection;
use GaryClarke\Framework\Authentication\AuthRepositoryInterface;
use GaryClarke\Framework\Authentication\AuthUserInterface;

class UserRepository implements AuthRepositoryInterface
{
    public function __construct(private Connection $connection)
    {
    }

    public function findByUsername(string $username): ?AuthUserInterface
    {
        // Create a query builder
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->select('id', 'username', 'password', 'created_at')
            ->from('users')
            ->where('username = :username')
            ->setParameter('username', $username);

        $result = $queryBuilder->executeQuery();

        $row = $result->fetchAssociative();

        if (!$row) {
            return null;
        }

        $user = new User(
            id: $row['id'],
            username: $row['username'],
            password: $row['password'],
            createdAt: new \DateTimeImmutable($row['created_at'])
        );

        return $user;
    }
}