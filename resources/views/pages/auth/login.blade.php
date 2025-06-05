@extends('layouts.master')

@section('title', 'Login | Nonton Bareng')

@section('content')
    <div class="flex flex-col px-5 py-5 mx-8 my-auto rounded-xl items-center justify-center bg-[#f3f4f6] dark:bg-[#1e2939]">
        <form action="{{ route('login.store') }}" method="POST" class="w-full">
            @csrf
            <h3 class="mb-3 text-2xl font-bold text-center text-[#1e2939] dark:text-[#e5e7eb]">Login</h3>
            <p class="mb-4 text-center text-sm text-[#364153] dark:text-[#99a1af]">Masukkan email dan password</p>

            <a href="{{ route('auth.google') }}"
                class="flex items-center justify-center w-full py-4 mb-6 text-sm font-medium transition duration-300 rounded-xl bg-[#d1d5dc] dark:bg-[#4a5565] hover:bg-[#99a1af] dark:hover:bg-[#6a7282] focus:ring-4 focus:ring-[#d1d5dc] dark:focus:ring-[#4a5565] gap-2">
                <img class="h-5 mr-2"
                    src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/logos/logo-google.png"
                    alt=""> Login dengan Google
            </a>

            <div class="flex items-center mb-3 gap-2">
                <hr class="h-0 border-b border-solid border-[#6a7282] grow">
                <p class="mx-4 text-[#4a5565]">atau</p>
                <hr class="h-0 border-b border-solid border-[#6a7282] grow">
            </div>

            <div class="mb-5">
                <label for="email" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Email / Username</label>
                <input type="text" name="email" id="email" placeholder="Masukkan Email / Username"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('email') border border-[#e7000b] dark:border-[#ff637e] @enderror"
                    value="{{ old('email') }}">
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

            @if (app(\App\Settings\GeneralSettings::class)->password_reset_enabled)
                <div class="flex mb-4 justify-end">
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-medium text-[#00598a] dark:text-[#0084d1] hover:text-[#024a70] dark:hover:text-[#00a6f4]">Lupa
                        password?</a>
                </div>
            @endif
            <button
                class="w-full mb-3 px-3 py-4 text-sm font-bold leading-none bg-[#00598a] dark:bg-[#024a70] rounded-xl text-white hover:bg-[#024a70] dark:hover:bg-[#00598a]">Login</button>
            @if (app(\App\Settings\GeneralSettings::class)->registration_enabled)
                <p class="text-center text-sm leading-relaxed text-[#101828] dark:text-[#e5e7eb]">Belum punya akun? <a
                        href="{{ route('register') }}" class="font-bold text-[#364153] dark:text-[#99a1af]">Buat akun</a>
                </p>
            @endif
        </form>
    </div>

    @if (session('success'))
        <x-toast-success :message="session('success')" />
    @endif

    <x-footer />
@endsection
