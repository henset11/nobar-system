@extends('layouts.master')

@section('title', 'Genre ' . $genre->name . ' | Nonton Bareng')

@section('content')
    <div id="Background" class="absolute top-0 w-full h-[570px] rounded-b-[75px] bg-[#b8e6fe] dark:bg-[#00598a]">
    </div>
    <div id="TopNav" class="relative flex items-center justify-between px-5 mt-[60px]">
        <a href="{{ url()->previous() }}">
            <x-heroicon-s-arrow-left-circle class="w-15 h-15 text-[#6a7282] dark:text-[#f3f4f6]" />
        </a>
        <p class="font-semibold text-[#1e2939] dark:text-[#e5e7eb]">Browse {{ $genre->name }}</p>
        <div class="dummy-btn w-12"></div>
    </div>
    <div id="Header" class="relative flex items-center justify-between gap-2 px-5 mt-[18px]">
        <div class="flex flex-col gap-[6px]">
            <h1 class="font-bold text-[32px] leading-[48px] text-[#1e2939] dark:text-[#e5e7eb]">All Movie with Genre
                {{ $genre->name }}</h1>
            <p class="text-[#6a7282] dark:text-[#d1d5dc]">Available {{ $genre->films->count() }} movies</p>
        </div>
        <div
            class="flex flex-col items-center text-center shrink-0 rounded-[22px] p-[10px] gap-2 bg-white dark:bg-[#d1d5dc]">
            <img src="{{ $genre->getFirstMediaUrl('genre') }}" class="w-15" alt="{{ $genre->name }}">
        </div>
    </div>

    <section id="Result" class="relative flex flex-col gap-4 px-5 mt-5 mb-9">
        @if ($films->isEmpty())
            <div class="w-full flex flex-col items-center justify-center py-10 gap-4">
                <div class="w-[120px] h-[120px] bg-[#D9D9D9] rounded-full flex items-center justify-center">
                    <x-heroicon-o-film class="w-16 h-16 text-[#6a7282]" />
                </div>
                <p class="text-lg text-[#6a7282] dark:text-[#d1d5dc]">No movies available in this genre.</p>
            </div>
        @endif

        @foreach ($films as $film)
            <x-films-card :film="$film" />
        @endforeach

        <div class="mt-5">
            {{ $films->links('vendor.pagination.custom') }}
        </div>
    </section>

    <x-footer />
@endsection
