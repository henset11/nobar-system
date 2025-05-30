@extends('layouts.master')

@section('title', $film->name . ' | Nonton Bareng')

@push('head-scripts')
    <script defer src="{{ asset('assets/js/alpine.min.js') }}"></script>
@endpush

@section('content')
    {{-- Top Navigation --}}
    <div id="ForegroundFade"
        class="absolute top-0 w-full h-[143px] bg-[linear-gradient(180deg,#070707_0%,rgba(7,7,7,0)_100%)] z-10">
    </div>
    <div id="TopNavAbsolute" class="absolute top-[60px] flex items-center justify-between w-full px-5 z-10">
        <a href="{{ route('home') }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
            <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#ffffff25]" />
        </a>
        <p class="font-semibold text-white">Film Details</p>
        <div
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
            <x-heroicon-m-hand-thumb-up class="w-6 h-6 text-[#ffffff25]" />
        </div>
    </div>
    <div class="[&_[x-cloak]]:hidden" x-data="{
        modalOpen: false,
        youtubeId: '{{ $film->trailer }}',
        get youtubeUrl() {
            return this.modalOpen ?
                `https://www.youtube.com/embed/${this.youtubeId}?autoplay=1&rel=0` :
                '';
        }
    }">
        <button class="relative w-full overflow-hidden -mb-[38px] flex shrink-0 h-[430px] justify-center items-center"
            @click="modalOpen = true" aria-controls="modal" aria-label="Watch trailer">
            <img src="{{ $film->getFirstMediaUrl('film') }}" class="w-full h-full object-cover blur-lg"
                alt="{{ $film->name }}">
            <!-- Play icon -->
            <svg class="absolute pointer-events-none group-hover:scale-110 transition-transform duration-300 ease-in-out"
                xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                <circle class="fill-white" cx="36" cy="36" r="36" fill-opacity=".6" />
                <path class="fill-sky-900 drop-shadow-2xl"
                    d="M44 36a.999.999 0 0 0-.427-.82l-10-7A1 1 0 0 0 32 29V43a.999.999 0 0 0 1.573.82l10-7A.995.995 0 0 0 44 36V36c0 .001 0 .001 0 0Z" />
            </svg>
        </button>

        <!-- Modal backdrop -->
        <div class="fixed inset-0 z-[99999] bg-[#000] bg-opacity-50 transition-opacity" x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>
        <!-- End: Modal backdrop -->

        <!-- Modal dialog -->
        <div id="modal" class="fixed inset-0 z-[99999] flex px-6 py-6" role="dialog" aria-modal="true"
            x-show="modalOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75" x-cloak>
            <div class="max-w-[640px] mx-auto h-full flex items-center">
                <div class="w-full max-h-full rounded-3xl shadow-2xl aspect-video bg-[#000] overflow-hidden"
                    @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                    <iframe width="100%" height="100%" :src="youtubeUrl" title="{{ $film->name }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
        <!-- End: Modal dialog -->
    </div>

    <main id="Details"
        class="relative flex flex-col rounded-t-[40px] py-5 pb-[10px] gap-4 bg-white dark:bg-[#101828] z-10">
        <div class="flex w-full items-start gap-4 text-white p-4 rounded-xl">
            <img src="{{ $film->getFirstMediaUrl('film') }}" alt="{{ $film->name }}"
                class="w-[8rem] h-auto rounded-lg shadow-md -mt-[5rem]">
            <div class="flex w-full flex-col justify-center -mt-[1rem]">
                <div class="flex justify-between">
                    <h1 class="font-bold text-2xl leading-[33px]">{{ $film->name }}</h1>
                    <div
                        class="flex flex-col items-center text-center shrink-0 rounded-[22px] border border-[#f0b100] p-[10px] gap-2 bg-white dark:bg-[#101828]">
                        <x-heroicon-m-star class="w-6 h-6 text-[#f0b100]" />
                    </div>
                </div>
                <p class="text-[#99a1af] mb-[0.75rem]">{{ $film->genres->pluck('name')->implode(', ') }}</p>
                <div class="flex gap-2">
                    <span class="bg-[#1e2939] px-3 py-1 rounded-lg text-sm">{{ $film->release_year }}</span>
                    <span class="bg-[#1e2939] px-3 py-1 rounded-lg text-sm">{{ $film->duration }} m</span>
                </div>
            </div>
        </div>
        <hr class="border-[#F1F2F6] mx-5">
        <div id="Tabs" class="flex w-full overflow-x-hidden mx-5 gap-2">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300 !bg-ngekos-black !text-white"
                data-target-tab="#Schedule-Tab">Schedule</button>
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Details-Tab">Details</button>
        </div>
        <div id="TabsContent" class="px-5">
            <div id="Schedule-Tab" class="tab-content flex flex-col gap-4">
                <div class="swiper w-full overflow-x-hidden grid grid-cols-7 mb-5">
                    <div class="swiper-wrapper">
                        @foreach ($dates as $date)
                            <a href="{{ route('films.show', ['id' => $film->id, 'date' => $date]) }}"
                                class="swiper-slide !w-fit {{ $date === $dateMovie ? 'pointer-events-none cursor-default' : '' }}">
                                <div
                                    class="w-16 h-16 rounded-[1rem] flex flex-col items-center justify-center border dark:text-[#e5e7eb]
                                    @if ($date === $dateMovie) bg-[#0069a8] dark:bg-[#052f4a] border-[#0069a8] dark:border-[#052f4a] text-[#d1d5dc] font-bold
                                    @else bg-[#d1d5dc] dark:bg-[#1e2939] border-white dark:border-[#1e2939] hover:border-[#00598a] dark:hover:border-[#00bcff] text-[#101828] font-semibold @endif">
                                    <p>
                                        {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('MMM') }}</p>
                                    <p>
                                        {{ \Carbon\Carbon::parse($date)->isoFormat('DD') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @foreach ($schedules as $studios)
                    @foreach ($studios as $schedule)
                        @if ($loop->first)
                            <div class="mx-auto px-4 w-full">
                                <div
                                    class="bg-[#d1d5dc] dark:bg-[#1e2939] text-[#101828] dark:text-[#e5e7eb] rounded-xl shadow-lg">
                                    <button class="w-full px-4 py-4 flex justify-between items-center"
                                        onclick="toggleDropdown('dropdown{{ $schedule->studio->id }}')">
                                        <span class="text-lg font-semibold">{{ $schedule->studio->name }}</span>
                                        <svg class="w-5 h-5 transform transition-transform duration-300" id="icon-dropdown1"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="dropdown{{ $schedule->studio->id }}"
                                        class="px-4 pb-4 hidden transition-all duration-300">
                                        <div class="grid grid-cols-2 gap-4">
                                            @foreach ($studios as $schedule)
                                                <a href="{{ route('ticket.order', $schedule->id) }}"
                                                    class="text-center px-3 py-2 block rounded-lg hover:bg-[#0069a8] text-white dark:hover:bg-[#4a5565] transition
                                                    @if ($schedule->play_date == now()->format('Y-m-d') && $schedule->play_time <= now('Asia/Makassar')->format('H:i:s')) pointer-events-none cursor-default bg-[#0084d150] dark:bg-[#36415360]  @else bg-[#0084d1] dark:bg-[#364153] @endif
                                                    ">{{ \Carbon\Carbon::parse($schedule->play_time)->format('H:i') }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach

                @if ($schedules->isEmpty())
                    <div class="w-full flex flex-col items-center justify-center py-10 gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-[#f3f4f6] dark:bg-[#6b728033] flex items-center justify-center p-1">
                            <x-heroicon-c-x-mark class="text-[#6a7282] dark:text-[#99a1af] p-[5px]" />
                        </div>
                        <h3 class="text-[#030712] dark:text-[#fff]">No Schedules</h3>
                    </div>
                @endif
            </div>
            <div id="Details-Tab" class="tab-content flex-col gap-4 hidden">
                <div class="px-4 w-full flex flex-col gap-2 text-[#1e2939] dark:text-[#e5e7eb] mb-4 mt-5">
                    <p class="font-bold">Sinopsis</p>
                    {!! $film->description !!}
                </div>
                <div class="px-4 w-full flex flex-col gap-2 text-[#1e2939] dark:text-[#e5e7eb] mb-4">
                    <p class="font-bold">Produser</p>
                    <p>{{ $film->producer }}</p>
                </div>
                <div class="px-4 w-full flex flex-col gap-2 text-[#1e2939] dark:text-[#e5e7eb] mb-4">
                    <p class="font-bold">Sutradara</p>
                    <p>{{ $film->director }}</p>
                </div>
                <div class="px-4 w-full flex flex-col gap-2 text-[#1e2939] dark:text-[#e5e7eb] mb-4">
                    <p class="font-bold">Penulis</p>
                    <p>{{ $film->writers }}</p>
                </div>
                <div class="px-4 w-full flex flex-col gap-2 text-[#1e2939] dark:text-[#e5e7eb] mb-4">
                    <p class="font-bold">Produksi</p>
                    <p>{{ $film->production }}</p>
                </div>
            </div>
        </div>
    </main>


    <x-footer />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/details.js') }}"></script>
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
@endpush
