<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Custom password reset logic
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            // Generate token
            $token = app('auth.password.broker')->createToken($user);

            // Send custom notification
            $user->notify(new ResetPasswordNotification($token));

            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        }

        // If user not found, still show success message for security
        return back()->with('status', 'Jika email terdaftar dalam sistem, link reset password akan dikirim.');
    }
}
