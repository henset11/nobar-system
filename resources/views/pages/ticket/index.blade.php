@extends('layouts.master')

@section('title', 'Ticket Saya | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('home') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Tiket Saya</p>
            </div>
        </div>
    </div>

    <div class="mt-5 px-5">
        <div id="Tabs" class="flex w-full overflow-x-hidden gap-2">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300 !bg-ngekos-black !text-white"
                data-target-tab="#Film-Tab">Film</button>
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Food-Tab">Makanan</button>
        </div>
    </div>

    <div id="TabsContent" class="px-5 mt-5">
        <div id="Film-Tab" class="tab-content flex flex-col gap-4">
            @if ($tickets->isEmpty())
                <div
                    class="w-full flex flex-col items-center justify-center py-5 px-5 rounded-lg bg-[#e5e7eb] dark:bg-[#4a5565] dark:text-[#ffffff]">
                    <x-heroicon-o-film class="w-12 h-12 text-[#99a1af] mb-5" />
                    <p class="font-semibold mg-1 text-[#364153] dark:text-[#e5e7eb] text-center">Hari ini kita nonton, yuk!
                    </p>
                    <p class="font-extralight text-xs text-[#99a1af] mb-5 text-center">Nikmati waktu luang kamu dengan
                        nonton film!</p>
                    <a href="{{ route('films.index') }}"
                        class="px-4 py-1 border dark:border-[#ffffff] border-[#1e2939] hover:bg-[#d1d5dc] dark:hover:bg-[#364153] rounded-full text-sm text-[#364153] dark:text-[#e5e7eb]">Lihat
                        yang lagi tayang</a>
                </div>
            @endif

            <div class="flex flex-col gap-5">
                @foreach ($tickets as $ticket)
                    <a href="{{ route('ticket.details', $ticket->id) }}">
                        <div class="flex rounded-lg gap-2 px-3 py-3 bg-[#d1d5dc] dark:bg-[#4a5565]">
                            <img src="{{ $ticket->schedule->film->getFirstMediaUrl('film') }}"
                                alt="{{ $ticket->schedule->film->name }}" class="w-[5.5rem] rounded-md">
                            <div class="mx-3 border-r-2 border-dashed border-[#99a1af] dark:border-[#6a7282] relative">
                                <div
                                    class="absolute rounded-full w-5 h-5 bg-white dark:bg-[#101828] -left-2 top-0 -translate-y-1/2">
                                </div>
                                <div
                                    class="absolute rounded-full w-5 h-5 bg-white dark:bg-[#101828] -left-2 bottom-0 translate-y-1/2">
                                </div>
                            </div>
                            <div class="flex flex-col ml-1 flex-1 min-w-0">
                                <p class="font-bold text-xl mb-4 truncate dark:text-[#ffffff] text-[#101828]">
                                    {{ $ticket->schedule->film->name }}</p>
                                <div class="flex gap-1 mb-1 dark:text-[#ffffff] text-[#101828] text-sm font-normal">
                                    <x-heroicon-o-map-pin class="w-5 h-5" />
                                    <p class="truncate">
                                        {{ $ticket->schedule->studio->name }}
                                    </p>
                                </div>
                                <div class="flex gap-1 mb-4 dark:text-[#ffffff] text-[#101828] text-sm font-normal">
                                    <x-heroicon-o-calendar-days class="w-5 h-5" />
                                    <p class="truncate">
                                        {{ \Carbon\Carbon::parse($ticket->schedule->play_date)->locale('id')->isoFormat('ddd, DD MMM YYYY') }}.
                                        {{ \Carbon\Carbon::parse($ticket->schedule->play_time)->format('H:i') }}
                                    </p>
                                </div>
                                <p
                                    class="@if ($ticket->status == 'success') text-[#00c950] dark:text-[#05df72]
                                @elseif ($ticket->status == 'pending')
                                    text-[#d08700] dark:text-[#f0b100]
                                @else
                                    text-[#e7000b] dark:text-[#ec003f] @endif font-medium">
                                    Pesanan {{ $ticket->status }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div id="Food-Tab" class="tab-content flex-col gap-4 hidden">
            <div
                class="w-full flex flex-col items-center justify-center py-5 px-5 rounded-lg bg-[#e5e7eb] dark:bg-[#4a5565] dark:text-[#ffffff]">
                <x-fas-utensils class="w-12 h-12 text-[#99a1af] mb-5" />
                <p class="font-semibold mg-1 text-[#364153] dark:text-[#e5e7eb] text-center">Hari ini kita nyemil, yuk!</p>
                <p class="font-extralight text-xs text-[#99a1af] mb-5 text-center">Cemilin snack, sosis, atau makanan &
                    minuman enak
                    lainnya!</p>
                <a href="{{ route('films.index') }}"
                    class="px-4 py-1 border dark:border-[#ffffff] border-[#1e2939] hover:bg-[#d1d5dc] dark:hover:bg-[#364153] rounded-full text-sm text-[#364153] dark:text-[#e5e7eb]">Lihat
                    yang lagi tayang</a>
            </div>
        </div>
    </div>

    <x-footer />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/details.js') }}"></script>
@endpush
