<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileService;

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

    public function deleteAccount()
    {
        return view('pages.profile.delete-account');
    }

    public function confirmDelete(Request $request)
    {
        $valid = $this->profileService->validatePassword($request);
        $response = $this->profileService->responseDelete($valid);

        if (!$response['success']) {
            return back()->withErrors(['password' => $response['message']]);
        }

        return redirect()->route('login')->with('success', $response['message']);
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
        $valid = $this->profileService->validatePassword($request);

        return response()->json(['valid' => $valid]);
    }
}
