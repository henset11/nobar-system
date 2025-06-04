@extends('layouts.master')

@section('title', 'Delete Akun | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('profile.security') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Delete Akun</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col px-6 mt-4 gap-4">
        <p class="text-[#e7000b] dark:text-[#ff637e]">
            Menghapus akun Anda akan menghilangkan semua data yang terkait dengan akun ini secara permanen. Tindakan ini
            tidak dapat dibatalkan.
        </p>

        <form action="{{ route('profile.delete.confirm') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-[#1e2939] dark:text-[#ffffff]">Konfirmasi
                    Password</label>
                <input type="password" id="password" name="password"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282]"
                    placeholder="Masukkan password Anda" required>
                @error('password')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="px-5 py-3 bg-[#e7000b] text-white rounded-full hover:bg-[#c10007] focus:outline-none focus:ring focus:ring-[#ffa2a2]">
                Hapus Akun
            </button>
        </form>
    </div>

    <x-footer />
@endsection
