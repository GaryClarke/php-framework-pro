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

    public function hasValidationErrors(): bool
    {
        return count($this->getValidationErrors()) > 0;
    }

    public function getValidationErrors(): array
    {
        $errors = [];

        // username length
        if (strlen($this->username) < 5 || strlen($this->username) > 20) {
            $errors[] = 'Username must be between 5 and 20 characters';
        }

        // username char type
        if (!preg_match('/^\w+$/', $this->username)) {
            $errors[] = 'Username can only consist of word characters without spaces';
        }

        // password length
        if (strlen($this->password) < 8) {
            $errors[] = 'Password must be at least 8 characters';
        }

        return $errors;
    }
}