<?php

namespace App\Contracts\Auth;

use App\DTOs\Auth\RegisterUserDTO;

interface RegisterUserContract
{
    public function __invoke(RegisterUserDTO $data): void;
}