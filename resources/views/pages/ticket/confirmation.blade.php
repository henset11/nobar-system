@extends('layouts.master')

@section('title', 'Booking Success | Nonton Bareng')

@section('content')
    <div class="w-full flex flex-col min-h-screen items-center justify-center">
        <dotlottie-wc src="{{ asset('assets/lottie/check.lottie') }}" autoplay loop></dotlottie-wc>
        <div class="text-xl text-[#22cb88] font-semibold">Tiket Berhasil Dipesan</div>
        <a href="{{ route('ticket.index') }}" class="px-4 py-2 bg-[#22cb88] mt-[1rem] rounded-full">Cek Tiket</a>
    </div>
    <x-footer />
@endsection

@push('scripts')
    <script type="module" src="https://unpkg.com/@lottiefiles/dotlottie-wc@latest/dist/dotlottie-wc.js"></script>
@endpush
