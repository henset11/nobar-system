@extends('layouts.master')

@section('title', 'Genres | Nonton Bareng')

@section('content')
    <div id="Background" class="absolute top-0 w-full h-[280px] rounded-bl-[75px] bg-[#b8e6fe] dark:bg-[#00598a]">
    </div>
    {{-- Top Navigation --}}
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <div class="flex flex-col gap-1">
            <p>Choose your Genre,</p>
            <h1 class="font-bold text-xl leading-[30px]">All Genre</h1>
        </div>
        <a href="#"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white dark:bg-[#052f4a]">
            <x-heroicon-o-bell-alert class="w-[28px] h-[28px]" />
        </a>
    </div>

    {{-- Popular Genres Section --}}
    <div class="flex flex-col mt-[30px] gap-4">
        <div class="flex items-center justify-between px-5 z-10">
            <h2 class="font-bold">Popular Genre</h2>
        </div>
        <div id="Genres" class="swiper w-full overflow-x-hidden">
            <div class="swiper-wrapper">
                @foreach ($populars as $popular)
                    <x-popular-genres :genre="$popular" />
                @endforeach
            </div>
        </div>
    </div>

    {{-- All Genre Section --}}
    <section id="Studios" class="flex flex-col p-5 gap-4">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">Browse Genres</h2>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($genres as $genre)
                <a href="{{ route('genres.film', $genre->id) }}" class="card">
                    <div
                        class="flex items-center rounded-[22px] p-[10px] gap-3 bg-[#f3f4f6] dark:bg-[#1e2939] border border-white dark:border-[#101828] overflow-hidden hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
                        <div
                            class="w-[55px] h-[55px] flex shrink-0 rounded-full border-4 border-white dark:border-[#101828] ring-1 ring-[#F1F2F6] dark:ring-[#242424] overflow-hidden">
                            <img src="{{ $genre->getFirstMediaUrl('genre') }}" class="w-full h-full object-cover"
                                alt="{{ $genre->name }}">
                        </div>
                        <div class="flex flex-col gap-[2px]">
                            <h3 class="font-semibold">{{ $genre->name }}</h3>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $genres->links('vendor.pagination.custom') }}
        </div>
    </section>

    <x-footer />
@endsection
