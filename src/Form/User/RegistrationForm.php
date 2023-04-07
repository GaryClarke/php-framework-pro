<?php

namespace App\Form\User;

class RegistrationForm
{
    private string $username;
    private string $password;

    public function setFields(string $username, string $password): void
    {
        $this->username = $username;
        $this->password = $password;
    }
}