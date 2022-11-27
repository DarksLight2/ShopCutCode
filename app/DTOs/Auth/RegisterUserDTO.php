<?php

namespace App\DTOs\Auth;

use App\Traits\DTOs\FromRequest;

class RegisterUserDTO
{
    use FromRequest;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
    
    protected static function getParams(): array
    {
        return [
            'name',
            'email',
            'password'
        ];
    }
}