<?php

namespace App\DTOs\Auth;

use App\Traits\DTOs\FromRequest;

class AuthorizeUserDTO
{

    use FromRequest;

    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    protected static function getParams(): array
    {
        return [
            'email',
            'password'
        ];
    }
}