<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class LoginController
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! auth()->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Zadané přihlašovací údaje nesouhlasí.',
            ]);
        }

        session()->regenerate();

        return to_route('invoices.index');
    }
}
