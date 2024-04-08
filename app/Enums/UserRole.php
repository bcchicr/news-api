<?php

namespace App\Enums;

use App\Enums\Traits\Arrayable;

enum UserRole: string
{
    use Arrayable;

    case ADMIN = "admin";
    case USER = "user";
}
