<?php

namespace App\DTO\User;

readonly final class LoginUserDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }
}
