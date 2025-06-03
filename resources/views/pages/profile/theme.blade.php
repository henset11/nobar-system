@extends('layouts.master')

@section('title', 'Tema | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('profile.index') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Tema</p>
            </div>
        </div>
    </div>

    <div class="text-center p-6 rounded-xl w-full">
        <h1 class="text-2xl font-semibold mb-8">Pilih mode kamu!</h1>

        <div class="flex justify-center items-center mb-4 transition-all duration-500">
            <div class="relative w-16 h-16">
                <!-- Icon Bulan -->
                <svg id="icon-moon"
                    class="absolute inset-0 w-16 h-16 text-white transition-all duration-500 ease-in-out opacity-100 scale-100"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                </svg>

                <!-- Icon Matahari -->
                <svg id="icon-sun"
                    class="absolute inset-0 w-16 h-16 text-[#fdc700] transition-all duration-500 ease-in-out opacity-0 scale-75"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6m0 2a5 5 0 1 1 0-10 5 5 0 0 1 0 10m0-15a1 1 0 0 1 1 1v2a1 1 0 0 1-2 0V1a1 1 0 0 1 1-1m0 16a1 1 0 0 1 1 1v2a1 1 0 0 1-2 0v-2a1 1 0 0 1 1-1M1 9h2a1 1 0 1 1 0 2H1a1 1 0 0 1 0-2m16 0h2a1 1 0 0 1 0 2h-2a1 1 0 0 1 0-2m.071-6.071a1 1 0 0 1 0 1.414l-1.414 1.414a1 1 0 1 1-1.414-1.414l1.414-1.414a1 1 0 0 1 1.414 0M5.757 14.243a1 1 0 0 1 0 1.414L4.343 17.07a1 1 0 1 1-1.414-1.414l1.414-1.414a1 1 0 0 1 1.414 0zM4.343 2.929l1.414 1.414a1 1 0 0 1-1.414 1.414L2.93 4.343A1 1 0 0 1 4.343 2.93zm11.314 11.314 1.414 1.414a1 1 0 0 1-1.414 1.414l-1.414-1.414a1 1 0 1 1 1.414-1.414" />
                </svg>
            </div>
        </div>

        <label class="flex items-center justify-center gap-3 cursor-pointer mb-6">
            <div class="relative">
                <input type="checkbox" class="sr-only peer" id="themeToggle">
                <div class="w-11 h-6 bg-[#364153] rounded-full peer-checked:bg-[#155dfc] transition-colors duration-300">
                </div>
                <div
                    class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-all duration-300 peer-checked:left-[1.5rem]">
                </div>
            </div>
            <span id="modeLabel">Dark</span>
        </label>

        <hr class="border-[#4a5565] mb-6">

        <div class="flex items-center justify-between">
            <div class="flex flex-col items-start">
                <p class="text-lg">Pakai tema gadget</p>
                <p class="text-sm text-[#99a1af]">aplikasi akan pakai mode sesuai setting-an gadget kamu.</p>
            </div>

            <label class="flex items-center justify-center gap-3 cursor-pointer mb-6">
                <div class="relative">
                    <input type="checkbox" class="sr-only peer" id="systemToggle">
                    <div
                        class="w-11 h-6 bg-[#364153] rounded-full peer-checked:bg-[#155dfc] transition-colors duration-300">
                    </div>
                    <div
                        class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-all duration-300 peer-checked:left-[1.5rem]">
                    </div>
                </div>
            </label>
        </div>
    </div>

    <x-footer />
@endsection

@push('scripts')
    <script>
        const html = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const systemToggle = document.getElementById('systemToggle');
        const sunIcon = document.getElementById('icon-sun');
        const moonIcon = document.getElementById('icon-moon');
        const label = document.getElementById('modeLabel');

        function updateIcons() {
            const isDark = html.classList.contains('dark');

            if (isDark) {
                sunIcon.classList.add('opacity-0', 'scale-75');
                sunIcon.classList.remove('opacity-100', 'scale-100');
                moonIcon.classList.remove('opacity-0', 'scale-75');
                moonIcon.classList.add('opacity-100', 'scale-100');
                label.textContent = 'Dark';
            } else {
                sunIcon.classList.remove('opacity-0', 'scale-75');
                sunIcon.classList.add('opacity-100', 'scale-100');
                moonIcon.classList.add('opacity-0', 'scale-75');
                moonIcon.classList.remove('opacity-100', 'scale-100');
                label.textContent = 'Light';
            }
        }

        // Simpan preferensi di localStorage
        themeToggle.addEventListener('change', () => {
            if (themeToggle.checked) {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
            updateIcons();
        });

        systemToggle.addEventListener('change', () => {
            if (systemToggle.checked) {
                localStorage.setItem('theme', 'system');
                themeToggle.disabled = true;
                themeToggle.checked = false;
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    html.classList.add('dark');
                } else {
                    html.classList.remove('dark');
                }
            } else {
                themeToggle.disabled = false;
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    themeToggle.checked = true;
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    themeToggle.checked = false;
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }
            updateIcons();
        });

        //Saat load halaman
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            html.classList.add('dark');
            themeToggle.checked = true;
        } else if (savedTheme === 'light') {
            html.classList.remove('dark');
            themeToggle.checked = false;
        } else {
            systemToggle.checked = true;
            themeToggle.disabled = true;
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                html.classList.add('dark');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            updateIcons();
        });
    </script>
@endpush
