<?php

namespace GaryClarke\Framework\Authentication;

class SessionAuthentication implements SessionAuthInterface
{

    public function authenticate(string $username, string $password): bool
    {
        // TODO: Implement authenticate() method.
    }

    public function login(AuthUserInterface $user)
    {
        // TODO: Implement login() method.
    }

    public function logout()
    {
        // TODO: Implement logout() method.
    }

    public function getUser(): AuthUserInterface
    {
        // TODO: Implement getUser() method.
    }

}