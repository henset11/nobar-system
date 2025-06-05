<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use SocialiteProviders\Manager\Config;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\GoogleAuthRepositoryInterface;
use DutchCodingCompany\FilamentSocialite\Models\SocialiteUser;

class GoogleAuthRepository implements GoogleAuthRepositoryInterface
{
    public function dynamicGoogleConfig()
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');
        $redirectUrl = request()->getSchemeAndHttpHost() . '/oauth/google/callback';

        if (empty($clientId) || empty($clientSecret)) {
            throw new \InvalidArgumentException('Google OAuth configuration is incomplete.');
        }

        return new Config($clientId, $clientSecret, $redirectUrl);
    }

    public function getUser($email)
    {
        $user = User::where('email', $email)->first();

        return $user;
    }

    public function getSocialiteUser($provider, $providerId)
    {
        $socialiteUser = SocialiteUser::where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();

        return $socialiteUser;
    }

    public function checkUser($googleUser)
    {
        $user = $this->getUser($googleUser->email);
        $socialiteUser = $this->getSocialiteUser('google', $googleUser->id);

        if ($socialiteUser) {
            $this->handleExistingSocialiteUser($socialiteUser, $user, $googleUser->id);
        } elseif (!$socialiteUser && $user) {
            $this->createNewSocialiteUser($user->id, 'google', $googleUser->id);
        }

        return $user;
    }

    public function createNewUser($googleUser)
    {
        $avatarFileName = $this->storeAvatar($googleUser->avatar);
        $username = $this->generateUsername($googleUser->email);

        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => bcrypt($googleUser->id),
            'username' => $username,
            'avatar_url' => $avatarFileName,
            'email_verified_at' => now(),
        ]);

        $this->createNewSocialiteUser($user->id, 'google', $googleUser->id);

        return $user;
    }

    public function createNewSocialiteUser($userId, $provider, $providerId)
    {
        SocialiteUser::create([
            'user_id' => $userId,
            'provider' => $provider,
            'provider_id' => $providerId,
        ]);
    }

    public function handleGoogleUser($googleUser)
    {
        $this->validateGoogleUser($googleUser);

        $user = $this->checkUser($googleUser);

        if (!$user) {
            $user = $this->createNewUser($googleUser);
        }

        return $user;
    }

    private function storeAvatar(string $avatarUrl): string
    {
        try {
            $avatarContents = file_get_contents($avatarUrl);

            if ($avatarContents === false) {
                throw new \Exception('Failed to download avatar.');
            }

            $avatarFileName = 'profile_photos/' . uniqid() . '.jpg';
            Storage::disk('public')->put($avatarFileName, $avatarContents);

            return $avatarFileName;
        } catch (\Exception $e) {
            // Log error dan gunakan avatar default jika terjadi error
            Log::error('Error storing avatar: ' . $e->getMessage());
            return '';
        }
    }

    private function generateUsername(string $email): string
    {
        return explode('@', $email)[0];
    }

    private function validateGoogleUser($googleUser)
    {
        if (empty($googleUser->name) || empty($googleUser->email) || empty($googleUser->id)) {
            throw new \InvalidArgumentException('Invalid Google user data.');
        }
    }

    private function handleExistingSocialiteUser($socialiteUser, $user, $googleUserId)
    {
        if ($user && $user->id != $socialiteUser->user_id) {
            $socialiteUser->delete();
            $this->createNewSocialiteUser($user->id, 'google', $googleUserId);
        } elseif (!$user) {
            $socialiteUser->delete();
        }
    }
}
