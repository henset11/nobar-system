@extends('layouts.master')

@section('title', 'Keamanan Akun | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('profile.index') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Keamanan Akun</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col px-6 mt-4 gap-4">
        <a href="{{ route('profile.change.password') }}"
            class="px-5 py-5 bg-[#d1d5dc70] dark:bg-[#36415370] hover:bg-[#d1d5dc] dark:hover:bg-[#364153] rounded-lg flex justify-between items-center">
            <div class="items-center flex gap-3">
                <x-heroicon-o-key class="w-5 h-5" />
                <p>Ganti Password</p>
            </div>
            <x-heroicon-o-chevron-right class="w-5 h-5" />
        </a>
        <a href="#"
            class="px-5 py-5 bg-[#d1d5dc70] dark:bg-[#36415370] hover:bg-[#d1d5dc] dark:hover:bg-[#364153] rounded-lg flex justify-between items-center">
            <div class="items-center flex gap-3">
                <x-heroicon-o-trash class="w-5 h-5" />
                <p>Hapus Akun</p>
            </div>
            <x-heroicon-o-chevron-right class="w-5 h-5" />
        </a>
    </div>

    <x-footer />
@endsection
