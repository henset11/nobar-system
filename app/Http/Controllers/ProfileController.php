<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(
        ProfileService $profileService
    ) {
        $this->profileService = $profileService;
    }

    public function index()
    {
        return view('pages.profile.index');
    }

    public function edit()
    {
        return view('pages.profile.edit');
    }

    public function update(Request $request)
    {
        $this->profileService->updateProfile($request);

        return back()->with('success', 'Profile berhasil di update');
    }

    public function security()
    {
        return view('pages.profile.security');
    }

    public function changePassword()
    {
        return view('pages.profile.change-password');
    }

    public function theme()
    {
        return view('pages.profile.theme');
    }

    public function help()
    {
        return view('pages.profile.help');
    }

    public function validatePassword(Request $request)
    {
        $valid = Hash::check($request->password, auth()->user()->password);
        return response()->json(['valid' => $valid]);
    }
}
