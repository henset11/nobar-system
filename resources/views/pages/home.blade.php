@extends('layouts.master')

@section('title', 'Dunia Prestrasi | Nonton Bareng')

@section('content')
    <div id="Background" class="absolute top-0 w-full h-[280px] rounded-bl-[75px] bg-[#b8e6fe] dark:bg-[#00598a]">
    </div>
    {{-- Top Navigation --}}
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <div class="flex flex-col gap-1">
            <p>Halo {{ auth()->user() ? auth()->user()->name : 'Adik' }},</p>
            <h1 class="font-bold text-xl leading-[30px]">Yuk! Nobar Seru di Dupres</h1>
        </div>
        <a href="#"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white dark:bg-[#052f4a]">
            <x-heroicon-o-bell-alert class="w-[28px] h-[28px]" />
        </a>
    </div>

    {{-- Genres Section --}}
    <div id="Genres" class="swiper w-full overflow-x-hidden mt-[30px]">
        <div class="swiper-wrapper">
            @foreach ($genres as $genre)
                <x-popular-genres :genre="$genre" />
            @endforeach
        </div>
    </div>

    {{-- Now Playing Section --}}
    <section id="NowPlaying" class="flex flex-col gap-4">
        <div class="flex items-center justify-between px-5">
            <h2 class="font-bold">Now Playing</h2>
            <a href="{{ route('films.index') }}">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <x-heroicon-s-arrow-right-circle class="w-5 h-5 text-[#6a7282] dark:text-[#e5e7eb]" />
                </div>
            </a>
        </div>
        <div class="swiper w-full overflow-x-hidden">
            <div class="swiper-wrapper">
                @if ($filmPlaying->isEmpty())
                    <div class="w-full flex flex-col items-center justify-center py-10 gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-[#f3f4f6] dark:bg-[#6b728033] flex items-center justify-center p-1">
                            <x-heroicon-c-x-mark class="text-[#6a7282] dark:text-[#99a1af] p-[5px]" />
                        </div>
                        <h3 class="text-[#030712] dark:text-[#fff]">No Movie Playing</h3>
                    </div>
                @endif

                @foreach ($filmPlaying as $playing)
                    <x-now-playing :playing="$playing" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Studio Section --}}
    <section id="Studios" class="flex flex-col p-5 gap-4 bg-[#F5F6F8] dark:bg-[#1e2939] mt-[30px]">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">Browse Studios</h2>
            <a href="{{ route('studios.index') }}">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <x-heroicon-s-arrow-right-circle class="w-5 h-5 text-[#6a7282] dark:text-[#e5e7eb]" />
                </div>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($studios->take(4) as $studio)
                <a href="{{ route('studios.show', $studio->id) }}" class="card">
                    <div
                        class="flex items-center rounded-[22px] p-[10px] gap-3 bg-white dark:bg-[#101828] border border-white dark:border-[#101828] overflow-hidden hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
                        <div
                            class="w-[55px] h-[55px] flex shrink-0 rounded-full border-4 border-white dark:border-[#101828] ring-1 ring-[#F1F2F6] dark:ring-[#242424] overflow-hidden">
                            <img src="{{ $studio->getFirstMediaUrl('studio') }}" class="w-full h-full object-cover"
                                alt="{{ $studio->name }}">
                        </div>
                        <div class="flex flex-col gap-[2px]">
                            <h3 class="font-semibold">{{ $studio->name }}</h3>
                            <div class="flex gap-[6px]">
                                <x-heroicon-o-users class="w-5 h-5 flex shrink-0 text-ngekos-grey dark:text-[#99a1af]" />
                                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">{{ $studio->capacity }} seat</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- All Film Section --}}
    <section id="Best" class="flex flex-col gap-4 px-5 mt-[30px]">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">All Great Movie</h2>
            <a href="{{ route('films.index') }}">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <x-heroicon-s-arrow-right-circle class="w-5 h-5 text-[#6a7282] dark:text-[#e5e7eb]" />
                </div>
            </a>
        </div>
        <div class="flex flex-col gap-4">
            @foreach ($films->take(4) as $film)
                <x-films-card :film="$film" />
            @endforeach
        </div>
    </section>

    <x-footer />
@endsection
