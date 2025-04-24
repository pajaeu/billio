<?php

declare(strict_types=1);

namespace App\Http\Controllers\SocialAuth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class GoogleController
{
    private const DRIVER = 'google';

    public function redirect(): RedirectResponse
    {
        return Socialite::driver(self::DRIVER)->redirect();
    }

    public function callback(): RedirectResponse
    {
        $socialiteUser = Socialite::driver(self::DRIVER)->user();

        $user = User::query()->updateOrCreate([
            'google_id' => $socialiteUser->getId(),
        ], [
            'name' => $socialiteUser->getName(),
            'password' => Str::password(),
            'email' => $socialiteUser->getEmail(),
            // @phpstan-ignore-next-line
            'google_access_token' => $socialiteUser->token,
            // @phpstan-ignore-next-line
            'google_refresh_token' => $socialiteUser->refreshToken,
        ]);

        Auth::login($user);

        return to_route('invoices.index');
    }
}
