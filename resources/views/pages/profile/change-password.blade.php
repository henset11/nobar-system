@extends('layouts.master')

@section('title', 'Ganti Password | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('profile.security') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Ubah Password</p>
            </div>
        </div>
    </div>

    @if (session('status') == 'password-updated')
        <div class="mt-4 mx-6 px-6 py-3 rounded-lg text-sm bg-[#00a63e] dark:bg-[#05df72]">
            Password berhasil di perbarui.
        </div>
    @endif

    <form action="{{ route('user-password.update') }}" method="post">
        @csrf
        @method('PUT')
        <div class="flex flex-col px-6 mt-4">
            <div class="mb-5">
                <label for="current_password" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Password Saat
                    Ini</label>
                <input type="password" name="current_password" id="current_password"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('current_password', 'updatePassword') border border-[#e7000b] dark:border-[#ff637e] @enderror">
                @error('current_password', 'updatePassword')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Password Baru</label>
                <input type="password" name="password" id="password"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('password', 'updatePassword') border border-[#e7000b] dark:border-[#ff637e] @enderror">
                @error('password', 'updatePassword')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Konfirmasi
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('password_confirmation', 'updatePassword') border border-[#e7000b] dark:border-[#ff637e] @enderror">
                @error('password_confirmation', 'updatePassword')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full mb-2 mt-4 px-3 py-4 text-sm font-bold leading-none bg-[#00598a] dark:bg-[#024a70] rounded-full text-white hover:bg-[#024a70] dark:hover:bg-[#00598a]">Ubah
                Password</button>
        </div>
    </form>

    <x-footer />
@endsection
