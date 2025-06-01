@extends('layouts.master')

@section('title', 'Profile | Nonton Bareng')

@section('content')
    <div class="flex flex-col justify-center items-center gap-2 px-6 py-6">
        <img src="{{ auth()->user()->avatar_url ? asset('storage/' . auth()->user()->avatar_url) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
            alt="{{ auth()->user()->name }}" class="rounded-full object-cover w-[100px] h-[100px]">
        <h2 class="font-bold text-lg">{{ auth()->user()->name }}</h2>
    </div>

    <div class="flex flex-col mt-4 px-6 gap-2">
        <h3 class="font-light">Pengaturan</h3>
        <a href="" class="flex gap-3 items-center mb-3 hover:text-[#0084d1]">
            <div class="flex rounded-full bg-[#d1d5dc] dark:bg-[#1e2939] items-center justify-center w-11 h-11">
                <x-heroicon-o-user class="w-5 h-5" />
            </div>
            <p class="font-semibold">Edit Profile</p>
        </a>
        <a href="" class="flex gap-3 items-center mb-3 hover:text-[#0084d1]">
            <div class="flex rounded-full bg-[#d1d5dc] dark:bg-[#1e2939] items-center justify-center w-11 h-11">
                <x-heroicon-o-key class="w-5 h-5" />
            </div>
            <p class="font-semibold">Keamanan Akun</p>
        </a>
        <a href="" class="flex gap-3 items-center mb-3 hover:text-[#0084d1]">
            <div class="flex rounded-full bg-[#d1d5dc] dark:bg-[#1e2939] items-center justify-center w-11 h-11">
                <x-heroicon-o-moon class="w-5 h-5" />
            </div>
            <p class="font-semibold">Tema</p>
        </a>

        <h3 class="font-light">Lainnya</h3>
        <a href="" class="flex gap-3 items-center mb-3 hover:text-[#0084d1]">
            <div class="flex rounded-full bg-[#d1d5dc] dark:bg-[#1e2939] items-center justify-center w-11 h-11">
                <x-heroicon-o-question-mark-circle class="w-5 h-5" />
            </div>
            <p class="font-semibold">Pusat Bantuan</p>
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4 px-6">
        @csrf
        <button type="submit"
            class="flex gap-2 py-2 rounded-full border border-[#ec003f] hover:bg-[#ec003f] hover:text-[#ffffff] w-full items-center justify-center"><x-heroicon-o-arrow-right-start-on-rectangle
                class="w-5 h-5" />
            Keluar</button>
    </form>


    <x-footer />
@endsection
