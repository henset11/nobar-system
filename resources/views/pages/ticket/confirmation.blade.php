@extends('layouts.master')

@section('title', 'Booking Success | Nonton Bareng')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <x-footer />
@endsection
