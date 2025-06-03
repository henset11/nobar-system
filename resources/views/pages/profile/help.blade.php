@extends('layouts.master')

@section('title', 'Pusat Bantuan | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('profile.index') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Pusat Bantuan</p>
            </div>
        </div>
    </div>

    <x-footer />
@endsection
