@extends('layouts.master')

@section('title', 'Reset Password | Nonton Bareng')

@section('content')
    <div class="flex flex-col px-5 py-5 mx-8 my-auto rounded-xl items-center justify-center bg-[#f3f4f6] dark:bg-[#1e2939]">
        <form action="{{ route('password.update') }}" method="POST" class="w-full">
            @csrf
            <h3 class="mb-3 text-2xl font-bold text-center text-[#1e2939] dark:text-[#e5e7eb]">Reset Password</h3>
            <p class="mb-4 text-center text-sm text-[#364153] dark:text-[#99a1af]">Masukkan password baru untuk akunmu.</p>

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="mb-5">
                <label for="email" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Email</label>
                <input type="email" name="email" id="email"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] cursor-not-allowed @error('email') border border-[#e7000b] dark:border-[#ff637e] @enderror"
                    value="{{ request()->email }}" readonly>
                @error('email')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('password') border border-[#e7000b] dark:border-[#ff637e] @enderror">
                @error('password')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Konfirmasi
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Masukkan Ulang Password"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('password_confirmation') border border-[#e7000b] dark:border-[#ff637e] @enderror">
                @error('password_confirmation')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <button
                class="w-full mt-5 px-3 py-4 text-sm font-bold leading-none bg-[#00598a] dark:bg-[#024a70] rounded-xl text-white hover:bg-[#024a70] dark:hover:bg-[#00598a]">Reset
                Password</button>
        </form>
    </div>

    <x-footer />
@endsection
