<?php

namespace App\DTO\User;

readonly final class RegisterUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {
    }
}
