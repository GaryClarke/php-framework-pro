<?php

namespace GaryClarke\Framework\Authentication;

interface AuthRepositoryInterface
{
    public function findByUsername(string $username): ?AuthUserInterface;
}