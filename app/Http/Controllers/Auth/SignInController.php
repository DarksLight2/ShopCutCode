<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthorizeContract;
use App\DTOs\Auth\AuthorizeUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SignInController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        return view('auth.sign-in');
    }

    public function handle(SignInRequest $request, AuthorizeContract $action): RedirectResponse
    {
        $result = $action(AuthorizeUserDTO::fromRequest($request));

        if ($result) {
            return redirect()->route('home');
        } else {
            return back()
                ->withErrors(['email' => 'No credentials found'])
                ->onlyInput('email');
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('auth.sign-in');
    }
}