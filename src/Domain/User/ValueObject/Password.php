<?php

namespace App\Domain\User\ValueObject;

class Password
{
    private string $password;

    public function __construct(string $password)
    {
        if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[^A-Za-z0-9]/", $password)) {
            throw new \InvalidArgumentException("Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.");
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getValue(): string
    {
        return $this->password;
    }
}

?>