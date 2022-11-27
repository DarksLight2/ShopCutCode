<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use JetBrains\PhpStorm\NoReturn;


class ForgotPasswordController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        return view('auth.forgot-password');
    }

    public function handle(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => __($status)]);
    }

    #[NoReturn] public function sent()
    {
        dd('Successfully sent');
    }
}