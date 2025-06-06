@extends('layouts.master')

@section('title', 'Lupa Password | Nonton Bareng')

@section('content')
    <div class="flex flex-col px-5 py-5 mx-8 my-auto rounded-xl items-center justify-center bg-[#f3f4f6] dark:bg-[#1e2939]">
        <form action="{{ route('password.email') }}" method="POST" class="w-full">
            @csrf
            <h3 class="mb-3 text-2xl font-bold text-center text-[#1e2939] dark:text-[#e5e7eb]">Request Password Reset</h3>
            <p class="mb-4 text-center text-sm text-[#364153] dark:text-[#99a1af]">Masukkan email untuk reset password</p>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-[#00a63e]">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-5">
                <label for="email" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Email</label>
                <input type="email" name="email" id="email" placeholder="example@gmail.com"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('email') border border-[#e7000b] dark:border-[#ff637e] @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex mb-4 justify-end">
                <a href="{{ route('login') }}"
                    class="text-sm font-medium text-[#00598a] dark:text-[#0084d1] hover:text-[#024a70] dark:hover:text-[#00a6f4] gap-1 items-center flex"><x-heroicon-o-arrow-left
                        class="w-4 h-4" /> Kembali login</a>
            </div>

            <button
                class="w-full px-3 py-4 text-sm font-bold leading-none bg-[#00598a] dark:bg-[#024a70] rounded-xl text-white hover:bg-[#024a70] dark:hover:bg-[#00598a]">Reset
                Password</button>
        </form>
    </div>

    <x-footer />
@endsection
