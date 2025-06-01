@extends('layouts.master')

@section('title', 'Verifikasi Email | Nonton Bareng')

@section('content')
    <div class="flex flex-col px-5 py-5 mx-8 my-auto rounded-xl items-center justify-center bg-[#f3f4f6] dark:bg-[#1e2939]">
        <form action="{{ route('verification.send') }}" method="POST" class="w-full">
            @csrf
            <h3 class="mb-3 text-2xl font-bold text-center text-[#1e2939] dark:text-[#e5e7eb]">Verifikasi Email</h3>
            <p class="mb-4 text-center text-sm text-[#364153] dark:text-[#99a1af]">Cek email anda untuk verifikasi akun!</p>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-[#00a63e]">
                    {{ session('status') }}
                </div>
            @endif

            <button
                class="w-full px-3 py-4 text-sm font-bold leading-none bg-[#00598a] dark:bg-[#024a70] rounded-xl text-white hover:bg-[#024a70] dark:hover:bg-[#00598a]">Kirim
                Ulang Email</button>
        </form>
    </div>

    <x-footer />
@endsection
