<?php

namespace App\Services;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function updateProfile($request)
    {
        $input = $request->all();
        if ($request->hasFile('avatar')) {
            $input['avatar'] = $request->file('avatar');
        }

        $updater = new UpdateUserProfileInformation();
        $updater->update(Auth::user(), $input);
    }
}
