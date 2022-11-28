<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\RegisterUserContract;
use App\DTOs\Auth\RegisterUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SignUpController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        return view('auth.sign-up');
    }

    public function handle(SignUpRequest $request, RegisterUserContract $action): RedirectResponse
    {
        if (!$action(RegisterUserDTO::fromRequest($request))) {
            return redirect()
                ->route('auth.sign-up')
                ->withErrors([
                    'email' => 'Current user already exists'
                ])
                ->onlyInput(['email', 'name']);
        }


        return redirect()->route('home');
    }
}