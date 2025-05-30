@extends('layouts.master')

@section('title', $studio->name . ' | Nonton Bareng')

@section('content')
    {{-- Top Navigation --}}
    <div id="ForegroundFade"
        class="absolute top-0 w-full h-[143px] bg-[linear-gradient(180deg,#070707_0%,rgba(7,7,7,0)_100%)] z-10">
    </div>
    <div id="TopNavAbsolute" class="absolute top-[60px] flex items-center justify-between w-full px-5 z-10">
        <a href="{{ url()->previous() }}"
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
            <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#ffffff25]" />
        </a>
        <p class="font-semibold text-white">Studio Details</p>
        <div
            class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
            <x-heroicon-m-hand-thumb-up class="w-6 h-6 text-[#ffffff25]" />
        </div>
    </div>
    <div class="w-full overflow-hidden -mb-[38px] flex shrink-0 h-[430px]">
        <img src="{{ $studio->getFirstMediaUrl('studio') }}" class="w-full h-full object-cover" alt="{{ $studio->name }}">
    </div>

    {{-- Main Content --}}
    <main id="Details"
        class="relative flex flex-col rounded-t-[40px] py-5 pb-[10px] gap-4 bg-white dark:bg-[#101828] z-10">
        <div id="Title" class="flex items-center justify-between gap-2 px-5">
            <h1 class="font-bold text-[22px] leading-[33px]">{{ $studio->name }}</h1>
            <div
                class="flex flex-col items-center text-center shrink-0 rounded-[22px] border border-[#ff6467] p-[10px] gap-2 bg-white dark:bg-[#101828]">
                <x-heroicon-m-heart class="w-6 h-6 text-[#ff6467]" />
            </div>
        </div>
        <hr class="border-[#F1F2F6] mx-5">
        <div id="Features" class="grid grid-cols-2 gap-x-[10px] gap-y-4 px-5">
            <div class="flex items-center gap-[6px]">
                <x-heroicon-m-map-pin class="w-[26px] h-[26px] flex shrink-0 text-ngekos-grey dark:text-[#d1d5dc]" />
                <p class="text-ngekos-grey dark:text-[#d1d5dc]">Dupres Srikandi</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <x-heroicon-m-users class="w-[26px] h-[26px] flex shrink-0 text-ngekos-grey dark:text-[#d1d5dc]" />
                <p class="text-ngekos-grey dark:text-[#d1d5dc]">{{ $studio->capacity }} person</p>
            </div>
        </div>
        <hr class="border-[#F1F2F6] mx-5">
        <div id="About" class="flex flex-col gap-[6px] px-5">
            <h2 class="font-bold">About</h2>
            <p class="leading-[30px]">Our studio offers a clean and comfortable space, equipped with air conditioning,
                high-quality audio, and an excellent visual system. Designed to enhance your viewing experience, it's the
                perfect place for private screenings, film sessions, or any audiovisual event.</p>
        </div>
        <div id="Tabs" class="flex w-full overflow-x-hidden mx-5 gap-2">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300 !bg-ngekos-black !text-white"
                data-target-tab="#Schedule-Tab">Schedule</button>
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Seat-Tab">Seats</button>
        </div>
        <div id="TabsContent" class="px-5">
            <div id="Schedule-Tab" class="tab-content flex flex-col gap-4">
                @foreach ($schedules as $schedule)
                    <a href="" class="card pointer-events-none cursor-default">
                        <div
                            class="flex rounded-[30px] border border-[#F1F2F6] dark:border-[#364153] p-4 gap-4 bg-white dark:bg-[#1e2939] hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
                            <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                <img src="{{ $schedule->film->getFirstMediaUrl('film') }}"
                                    class="w-full h-full object-cover" alt="{{ $schedule->film->name }}">
                            </div>
                            <div class="flex flex-col gap-3 w-full">
                                <h3 class="font-semibold text-lg leading-[40px] line-clamp-2 min-h-[40px]">
                                    {{ $schedule->film->name }}
                                    ({{ $schedule->film->release_year }})
                                </h3>

                                <hr class="border-[#F1F2F6]">

                                <div class="flex items-center gap-[6px]">
                                    <x-heroicon-o-calendar-days class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                                    <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">
                                        {{ \Carbon\Carbon::parse($schedule->play_date)->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-[6px]">
                                    <x-heroicon-o-clock class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                                    <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">At
                                        <b>{{ \Carbon\Carbon::parse($schedule->play_time)->format('H:i') }} WITA</b>
                                    </p>
                                </div>
                                <div class="flex items-center gap-[6px]">
                                    <x-heroicon-o-clock class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                                    <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Duration:
                                        {{ $schedule->film->duration }}
                                        minutes</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="mt-5">
                    {{ $schedules->links('vendor.pagination.custom') }}
                </div>
            </div>
            <div id="Seat-Tab" class="tab-content flex-col gap-5 hidden">
                <div
                    class="items-center justify-center w-[300px] mx-auto h-[30px] bg-[#364153] dark:bg-[#6a7282] flex flex-col text-center text-white rounded-[0.75rem] mb-8">
                    Layar
                </div>
                @foreach ($seats as $rowSeats)
                    <div class="grid grid-cols-6 items-center justify-center w-max mx-auto gap-3">
                        @foreach ($rowSeats as $seat)
                            <div
                                class="rounded-[0.75rem] w-12 h-12 bg-[#1e2939] dark:bg-[#4a5565] text-white flex flex-col text-center justify-center">
                                {{ $seat }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <x-footer />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/details.js') }}"></script>
@endpush
