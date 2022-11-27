<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\AuthorizeContract;
use App\DTOs\Auth\AuthorizeUserDTO;

class AuthorizeAction implements AuthorizeContract
{

    public function __invoke(AuthorizeUserDTO $data): bool
    {
        if (!auth()->attempt((array)$data)) {
            return false;
        }

        request()->session()->regenerate();

        return true;
    }
}