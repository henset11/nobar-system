@extends('layouts.master')

@section('title', 'Studios | Nonton Bareng')

@section('content')
    <div id="Background" class="absolute top-0 w-full h-[570px] rounded-b-[75px] bg-[#b8e6fe] dark:bg-[#00598a]">
    </div>
    {{-- Top Navigation --}}
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <a href="{{ url()->previous() }}">
            <x-heroicon-s-arrow-left-circle class="w-15 h-15 text-[#6a7282] dark:text-[#f3f4f6]" />
        </a>
        <p class="font-semibold text-[#1e2939] dark:text-[#e5e7eb]">Browse Studio</p>
        <div class="dummy-btn w-12"></div>
    </div>
    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col gap-[6px]">
            <h1 class="font-bold text-[32px] leading-[48px] text-[#1e2939] dark:text-[#e5e7eb]">Choose your Studio</h1>
            <p class="text-[#6a7282] dark:text-[#d1d5dc]">Available {{ $studios->count() }} studio</p>
        </div>
    </div>

    {{-- Studio Card Section --}}
    <section id="Studios" class="relative flex flex-col gap-4 px-5 mt-5 mb-9">
        @if ($studios->isEmpty())
            <div class="w-full flex flex-col items-center justify-center py-10 gap-4">
                <div class="w-[120px] h-[120px] bg-[#D9D9D9] rounded-full flex items-center justify-center">
                    <x-heroicon-o-building-office class="w-16 h-16 text-[#6a7282]" />
                </div>
                <p class="text-lg text-[#6a7282] dark:text-[#d1d5dc]">No studios available.</p>
            </div>
        @endif

        @foreach ($studios as $studio)
            <a href="{{ route('studios.show', $studio->id) }}" class="card">
                <div
                    class="flex rounded-[30px] border border-[#F1F2F6] dark:border-[#364153] p-4 gap-4 bg-white dark:bg-[#1e2939] hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
                    <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                        <img src="{{ $studio->getFirstMediaUrl('studio') }}" class="w-full h-full object-cover"
                            alt="{{ $studio->name }}">
                    </div>
                    <div class="flex flex-col gap-3 w-full">
                        <h3 class="font-semibold text-lg leading-[40px] line-clamp-2 min-h-[40px]">{{ $studio->name }}</h3>
                        <hr class="border-[#F1F2F6]">

                        <div class="flex flex-wrap gap-2">
                            @foreach ($studio->seat_rows as $row)
                                <div
                                    class="px-2 py-1 text-xs font-medium rounded-[0.5rem] bg-[#DCFCE7] text-[#166534] hover:bg-[#BBF7D0] transition-colors">
                                    {{ $row }}</div>
                            @endforeach
                        </div>
                        <hr class="border-[#F1F2F6]">
                        <div class="flex items-center gap-[6px]">
                            <x-heroicon-o-users class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                            <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Capacity: {{ $studio->capacity }} seats
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach

        <div class="mt-5">
            {{ $studios->links('vendor.pagination.custom') }}
        </div>
    </section>

    <x-footer />
@endsection
