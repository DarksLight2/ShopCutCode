<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\RegisterUserContract;
use App\DTOs\Auth\RegisterUserDTO;
use App\Events\RegisterUserEvent;
use App\Models\User;

class RegisterUserAction implements RegisterUserContract
{
    public function __invoke(RegisterUserDTO $data): bool
    {
        if (!User::query()->where('email', '=', $data->email)->first()) {
            $user = User::query()->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
            ]);

            auth()->login($user);

            event(new RegisterUserEvent($user));

            return true;
        }

        return false;
    }
}