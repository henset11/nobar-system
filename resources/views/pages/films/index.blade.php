@extends('layouts.master')

@section('title', 'Movies | Nonton Bareng')

@section('content')
    <div id="Background" class="absolute top-0 w-full h-[280px] rounded-bl-[75px] bg-[#b8e6fe] dark:bg-[#00598a]">
    </div>
    {{-- Top Navigation --}}
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <div class="flex flex-col gap-1">
            <p>Choose your Movie,</p>
            <h1 class="font-bold text-xl leading-[30px]">All Movies</h1>
        </div>
        <a href="#"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white dark:bg-[#052f4a]">
            <x-heroicon-o-bell-alert class="w-[28px] h-[28px]" />
        </a>
    </div>

    {{-- Now Playing Section --}}
    <div class="flex flex-col mt-[30px] gap-4">
        <div class="flex items-center justify-between px-5 z-10">
            <h2 class="font-bold">Now Playing</h2>
        </div>
        <div class="swiper w-full overflow-x-hidden">
            <div class="swiper-wrapper">
                @if ($filmPlaying->isEmpty())
                    <div
                        class="mx-5 rounded-[30px] border border-[#F1F2F6] dark:border-[#364153] dark:bg-[#1e2939] w-full flex flex-col items-center justify-center py-10 gap-4 bg-white">
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
    </div>

    {{-- All Movies Section --}}
    <section id="Best" class="flex flex-col gap-4 px-5 mt-10">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">All Great Movie</h2>
        </div>

        <div class="flex flex-col gap-4">
            @if ($films->isEmpty())
                <div class="w-full flex flex-col items-center justify-center py-10 gap-4">
                    <div class="w-[120px] h-[120px] bg-[#D9D9D9] rounded-full flex items-center justify-center">
                        <x-heroicon-o-film class="w-16 h-16 text-[#6a7282]" />
                    </div>
                    <p class="text-lg text-[#6a7282] dark:text-[#d1d5dc]">No movies available.</p>
                </div>
            @endif

            @foreach ($films as $film)
                <x-films-card :film="$film" />
            @endforeach
        </div>

        <div class="mt-5">
            {{ $films->links('vendor.pagination.custom') }}
        </div>
    </section>

    <x-footer />
@endsection
