<?php

namespace App\Http\Controllers;

use App\Interfaces\GoogleAuthRepositoryInterface;
use App\Models\User;
use DutchCodingCompany\FilamentSocialite\Models\SocialiteUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    private GoogleAuthRepositoryInterface $googleAuthRepository;

    public function __construct(
        GoogleAuthRepositoryInterface $googleAuthRepository,
    ) {
        $this->googleAuthRepository = $googleAuthRepository;
    }

    public function googleRedirect()
    {
        $config = $this->googleAuthRepository->dynamicGoogleConfig();

        return Socialite::driver('google')->setConfig($config)->stateless()->redirect();
    }

    public function googleCallBack()
    {
        $config = $this->googleAuthRepository->dynamicGoogleConfig();
        $googleUser = Socialite::driver('google')->setConfig($config)->stateless()->user();

        $user = $this->googleAuthRepository->handleGoogleUser($googleUser);

        Auth::login($user);

        return redirect()->intended('/');
    }
}
