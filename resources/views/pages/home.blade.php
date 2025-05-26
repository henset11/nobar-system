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
            {{-- <img src="{{ asset('assets/images/icons/notification.svg') }}" class="w-[28px] h-[28px]" alt="icon"> --}}
        </a>
    </div>

    {{-- Genres Section --}}
    <div id="Genres" class="swiper w-full overflow-x-hidden mt-[30px]">
        <div class="swiper-wrapper">
            @foreach ($genres as $genre)
                <div class="swiper-slide !w-fit pb-[30px]">
                    <a href="" class="card">
                        <div
                            class="flex flex-col items-center w-[120px] shrink-0 rounded-[40px] p-4 pb-5 gap-3 bg-white border border-white dark:bg-[#052f4a] dark:border-[#052f4a] shadow-[0px_12px_30px_0px_#0000000D] text-center hover:border-[#00598a] dark:hover:border-[#00bcff]">
                            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                                <img src="{{ $genre->getFirstMediaUrl('genre') }}" class="w-full h-full object-cover"
                                    alt="{{ $genre->name }}">
                            </div>
                            <div class="flex flex-col gap-[2px]">
                                <h3 class="font-semibold">{{ $genre->name }}</h3>
                                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">{{ $genre->films->count() }} films
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Now Playing Section --}}
    <section id="NowPlaying" class="flex flex-col gap-4">
        <div class="flex items-center justify-between px-5">
            <h2 class="font-bold">Now Playing</h2>
            <a href="#">
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
                        <h3 class="text-[#030712] dark:text-[#fff]">No Films Playing</h3>
                    </div>
                @endif

                @foreach ($filmPlaying as $playing)
                    <div class="swiper-slide !w-fit">
                        <a href="" class="card">
                            <div
                                class="flex flex-col w-[250px] shrink-0 rounded-[30px] border border-[#F1F2F6] p-4 pb-5 gap-[10px] hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
                                <div class="flex w-full h-full shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ $playing->getFirstMediaUrl('film') }}" class="w-full h-full object-cover"
                                        alt="{{ $playing->name }}">
                                </div>
                                <div class="flex flex-col gap-3">
                                    <h3 class="font-semibold text-lg text-center leading-[40px] line-clamp-2 min-h-[40px]">
                                        {{ $playing->name }} ({{ $playing->release_year }})</h3>
                                    <hr class="border-[#F1F2F6]">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($playing->genres->take(2) as $genre)
                                            <a href=""
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-[#DCFCE7] text-[#166534] hover:bg-[#BBF7D0] transition-colors">{{ $genre->name }}</a>
                                        @endforeach
                                        @if ($playing->genres->count() > 2)
                                            <button
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-[#f3f4f6] text-[#4b5563] hover:bg-[#e5e7eb] transition-colors"
                                                title="{{ $playing->genres->skip(2)->pluck('name')->join(', ') }}">
                                                +{{ $playing->genres->count() - 2 }}
                                            </button>
                                        @endif
                                    </div>
                                    <hr class="border-[#F1F2F6]">
                                    <div class="flex items-center gap-[6px]">
                                        <x-heroicon-o-clock
                                            class="w-5 h-5 flex shrink-0 text-ngekos-grey dark:text-[#99a1af]" />
                                        <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Duration:
                                            {{ $playing->duration }} minutes</p>
                                    </div>
                                    <div class="flex items-center gap-[6px]">
                                        <x-heroicon-o-users
                                            class="w-5 h-5 flex shrink-0 text-ngekos-grey dark:text-[#99a1af]" />
                                        <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Producer:
                                            {{ $playing->producer }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Studio Section --}}
    <section id="Studios" class="flex flex-col p-5 gap-4 bg-[#F5F6F8] dark:bg-[#1e2939] mt-[30px]">
        <div class="flex items-center justify-between">
            <h2 class="font-bold">Browse Studios</h2>
            <a href="#">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <x-heroicon-s-arrow-right-circle class="w-5 h-5 text-[#6a7282] dark:text-[#e5e7eb]" />
                </div>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($studios as $studio)
                <a href="" class="card">
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
            <h2 class="font-bold">All Great Film</h2>
            <a href="#">
                <div class="flex items-center gap-2">
                    <span>See all</span>
                    <x-heroicon-s-arrow-right-circle class="w-5 h-5 text-[#6a7282] dark:text-[#e5e7eb]" />
                </div>
            </a>
        </div>
        <div class="flex flex-col gap-4">
            @foreach ($films->take(4) as $film)
                <x-films-card :film="$film" />
                {{-- <a href="" class="card">
                    <div
                        class="flex rounded-[30px] border border-[#F1F2F6] p-4 gap-4 bg-white dark:bg-[#1e2939] hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
                        <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                            <img src="{{ $film->getFirstMediaUrl('film') }}" class="w-full h-full object-cover"
                                alt="{{ $film->name }}">
                        </div>
                        <div class="flex flex-col gap-3 w-full">
                            <h3 class="font-semibold text-lg leading-[40px] line-clamp-2 min-h-[40px]">{{ $film->name }}
                                ({{ $film->release_year }})</h3>
                            <hr class="border-[#F1F2F6]">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($film->genres as $genre)
                                    <a href=""
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-[#DCFCE7] text-[#166534] hover:bg-[#BBF7D0] transition-colors">{{ $genre->name }}</a>
                                @endforeach
                            </div>
                            <hr class="border-[#F1F2F6]">
                            <div class="flex items-center gap-[6px]">
                                <x-heroicon-o-clock class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Duration: {{ $film->duration }}
                                    minutes</p>
                            </div>
                            <div class="flex items-center gap-[6px]">
                                <x-heroicon-o-users class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Producer: {{ $film->producer }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a> --}}
            @endforeach
        </div>
    </section>

    <x-footer />
@endsection
