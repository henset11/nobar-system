@extends('layouts.master')

@section('title', 'Edit Profile | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('profile.index') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Edit Profile</p>
            </div>
        </div>
    </div>

    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col justify-center items-center gap-2 px-6 py-6">
            <div class="relative group">
                <img id="preview"
                    src="{{ auth()->user()->avatar_url ? asset('storage/' . auth()->user()->avatar_url) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                    alt="{{ auth()->user()->name }}" class="rounded-full object-cover w-[100px] h-[100px]">

                <label for="avatar"
                    class="absolute inset-0 flex items-center justify-center rounded-full cursor-pointer bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity">
                    <x-heroicon-o-camera class="w-8 h-8 text-white" />
                </label>

                <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*"
                    onchange="previewImage(event)">
            </div>
            @error('avatar')
                <p class="text-[#e7000b] dark:text-[#ff637e] text-sm">{{ $message }}</p>
            @enderror
        </div>

        @if (session('success'))
            <div class="mb-4 mx-6 px-6 py-3 rounded-lg text-sm bg-[#00a63e] dark:bg-[#05df72]">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col px-6">
            <div class="mb-5">
                <label for="name" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Nama</label>
                <input type="text" name="name" id="name"
                    class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('name') border border-[#e7000b] dark:border-[#ff637e] @enderror"
                    value="{{ auth()->user()->name }}">
                @error('name')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="username" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Username</label>
                <div class="relative flex items-center">
                    <input type="text" name="username" id="username"
                        class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('username') border border-[#e7000b] dark:border-[#ff637e] @enderror"
                        value="{{ auth()->user()->username }}" readonly>
                    <button type="button" onclick="showPasswordModal('username')"
                        class="absolute right-2 flex items-center px-1 py-1 text-xs font-medium rounded-full "><x-heroicon-o-pencil-square
                            class="w-5 h-5" /></button>
                </div>
                @error('username')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="mb-2 text-sm text-[#1e2939] dark:text-[#e5e7eb]">Email</label>
                <div class="relative flex items-center">
                    <input type="email" name="email" id="email"
                        class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] @error('email') border border-[#e7000b] dark:border-[#ff637e] @enderror"
                        value="{{ auth()->user()->email }}" readonly>
                    <button type="button" onclick="showPasswordModal('email')"
                        class="absolute right-2 flex items-center px-1 py-1 text-xs font-medium rounded-full "><x-heroicon-o-pencil-square
                            class="w-5 h-5" /></button>
                </div>
                @error('email')
                    <p class="text-[#e7000b] dark:text-[#ff637e]">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full mb-2 mt-4 px-3 py-4 text-sm font-bold leading-none bg-[#00598a] dark:bg-[#024a70] rounded-full text-white hover:bg-[#024a70] dark:hover:bg-[#00598a]">Simpan</button>
        </div>
    </form>

    <!-- Modal Password -->
    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-[#1e2939] p-6 rounded-xl w-[90%] max-w-md">
            <h3 class="text-lg font-semibold mb-4 text-[#1e2939] dark:text-[#ffffff]">Konfirmasi Password</h3>
            <p id="passwordError" class="text-[#e7000b] dark:text-[#ff637e] text-sm hidden mb-2"></p>
            <input type="password" id="confirmPassword"
                class="flex items-center w-full px-3 py-3 rounded-xl text-sm font-medium placeholder:text-[#99a1af] dark:placeholder:text-[#99a1af] bg-[#e5e7eb] dark:bg-[#4a5565] text-[#101828] dark:text-[#e5e7eb] outline-none focus:bg-[#d1d5dc] dark:focus:bg-[#6a7282] mb-5"
                placeholder="Masukkan password Anda">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closePasswordModal()"
                    class="px-4 py-2 text-sm bg-[#e5e7eb] dark:bg-[#364153] rounded-lg">
                    Batal
                </button>
                <button type="button" onclick="validatePassword()"
                    class="px-4 py-2 text-sm text-white bg-[#00598a] hover:bg-[#024a70] rounded-lg">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>

    <x-footer />
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        let currentField = '';

        function showPasswordModal(field) {
            currentField = field;
            document.getElementById('passwordModal').classList.remove('hidden');
            document.getElementById('passwordModal').classList.add('flex');
            document.getElementById('confirmPassword').value = '';
        }

        function closePasswordModal() {
            const errorElement = document.getElementById('passwordError');
            document.getElementById('passwordModal').classList.add('hidden');
            document.getElementById('passwordModal').classList.remove('flex');

            // Reset error message
            errorElement.textContent = '';
            errorElement.classList.add('hidden');
        }

        function validatePassword() {
            const password = document.getElementById('confirmPassword').value;
            const errorElement = document.getElementById('passwordError');

            // Reset error message
            errorElement.textContent = '';
            errorElement.classList.add('hidden');

            // Ajax request untuk validasi password
            fetch('{{ route('validate.password') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        // Password valid, enable input
                        document.getElementById(currentField).readOnly = false;
                        document.getElementById(currentField).focus();
                        closePasswordModal();
                    } else {
                        errorElement.textContent = 'Password yang Anda masukkan salah.';
                        errorElement.classList.remove('hidden');
                    }
                });
        }
    </script>
@endpush
