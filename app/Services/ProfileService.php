<?php

namespace App\Services;

use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function validatePassword($request)
    {
        $valid = Hash::check($request->password, auth()->user()->password);
        return $valid;
    }

    public function responseDelete($valid)
    {
        if (!$valid) {
            return [
                'success' => false,
                'message' => 'Password yang Anda masukkan salah.'
            ];
        }

        $user = auth()->user();
        $user->delete();

        auth()->logout();
        return [
            'success' => true,
            'message' => 'Akun Anda berhasil dihapus.'
        ];
    }
}
