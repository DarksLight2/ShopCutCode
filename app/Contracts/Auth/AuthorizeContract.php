<?php

namespace App\Contracts\Auth;

use App\DTOs\Auth\AuthorizeUserDTO;

interface AuthorizeContract
{
    public function __invoke(AuthorizeUserDTO $data): bool;
}