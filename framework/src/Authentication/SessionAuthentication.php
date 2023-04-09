<?php

namespace GaryClarke\Framework\Authentication;

class SessionAuthentication implements SessionAuthInterface
{

    public function __construct(private AuthRepositoryInterface $authRepository)
    {
    }

    public function authenticate(string $username, string $password): bool
    {
        // query db for user using username
        $user = $this->authRepository->findByUsername($username);

        if (!$user) {
            return false;
        }

        // Does the hashed user pw match the hash of the attempted password
        if (password_verify($password, $user->getPassword())) {

            dd($user);

            // if yes, log the user in
            $this->login($user);

            // return true
            return true;
        }

        // return false
        return false;
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