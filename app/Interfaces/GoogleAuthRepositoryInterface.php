<?php

namespace App\Interfaces;

interface GoogleAuthRepositoryInterface
{
    public function dynamicGoogleConfig();

    public function getUser($email);

    public function getSocialiteUser($provider, $providerId);

    public function checkUser($googleUser);

    public function createNewUser($googleUser);

    public function createNewSocialiteUser($userId, $provider, $providerId);

    public function handleGoogleUser($googleUser);
}
