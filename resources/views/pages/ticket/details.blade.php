@extends('layouts.master')

@section('title', 'Detail Tiket | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('ticket.index') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Detail Tiket</p>
            </div>
        </div>
    </div>

    <div class="mx-6 mt-5 px-3 py-4 rounded-xl bg-[#d1d5dc70] dark:bg-[#4a556570] gap-2">
        <p class="text-center text-xs font-extralight">Kode ticket</p>
        @if ($ticket)
            <p class="text-center text-sm font-semibold mb-5">{{ $ticket->code }}</p>

            <div class="justify-center flex mb-2">
                <img src="{{ asset('storage/qrcodes/ticket/' . $ticket->code . '.png') }}" alt="QR Code"
                    class="p-2 rounded-lg bg-white">
            </div>

            <p class="text-center text-xs font-light flex items-center justify-center gap-2">Scan untuk redeem
                <x-heroicon-o-information-circle class="w-3 h-3" />
            </p>
        @endif

        <div class="my-5 border-b-2 border-dashed border-[#99a1af] dark:border-[#6a7282] relative">
            <div class="absolute rounded-full w-8 h-8 bg-white dark:bg-[#101828] -left-7 -mt-4">
            </div>
            <div class="absolute rounded-full w-8 h-8 bg-white dark:bg-[#101828] -right-7 -mt-4">
            </div>
        </div>

        <div class="flex gap-4 mb-5">
            <div class="w-[6rem]">
                <img src="{{ $ticket->schedule->film->getFirstMediaUrl('film') }}" alt="{{ $ticket->schedule->film->name }}"
                    class="w-full rounded-md">
            </div>
            <div class="flex flex-col flex-1 gap-3">
                <p class="text-lg font-semibold">{{ $ticket->schedule->film->name }}</p>
                <div class="flex gap-2 text-sm font-light">
                    <x-heroicon-o-building-office class="w-5 h-5 flex-shrink-0" />
                    <p>{{ $ticket->schedule->studio->name }}</p>
                </div>
                <div class="flex gap-2 text-sm font-light">
                    <x-heroicon-o-map-pin class="w-5 h-5 flex-shrink-0" />
                    <p>DUNIA PRESTASI, Jl.Srikandi No.6, Baktiseraga</p>
                </div>
                <div class="flex gap-2 text-sm font-light">
                    <x-heroicon-o-calendar-days class="w-5 h-5 flex-shrink-0" />
                    <p>
                        {{ \Carbon\Carbon::parse($ticket->schedule->play_date)->locale('id')->isoFormat('ddd, DD MMM YYYY') }}.
                        {{ \Carbon\Carbon::parse($ticket->schedule->play_time)->format('H:i') }}
                    </p>
                </div>
                <div class="flex gap-2 text-sm font-light">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.5 20v2a1 1 0 0 1-1 1H7.596a2 2 0 0 1-1.95-1.557L1.278 2.222A1 1 0 0 1 2.253 1h3.455a1 1 0 0 1 .973.771L10.5 18h10a2 2 0 0 1 2 2"
                            stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.967 3H9a1 1 0 0 1 1 1v2L8 7.5m5.5 6.875h-6" stroke-width="1.7" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <p>{{ $ticket->seat->seat_number }}</p>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
@endsection
