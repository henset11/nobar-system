<div id="BottomNav" class="relative flex w-full h-[138px] shrink-0">
    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 shadow-lg rounded-t-xl z-50 w-full max-w-[640px] bg-ngekos-black">
        <div class="grid grid-cols-5 items-center justify-between px-4 py-2 relative">

            <!-- Home (Active) -->
            <a href="" class="flex flex-col items-center text-white space-y-1">
                <x-heroicon-o-squares-2x2 class="w-6 h-6" />
                <span class="text-xs">Genre</span>
            </a>

            <!-- Laporanmu -->
            <a href="" class="flex flex-col items-center text-white space-y-1">
                <x-heroicon-o-film class="w-6 h-6" />
                <span class="text-xs">Film</span>
            </a>

            <!-- Tombol Tengah (Floating Action Button) -->
            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="absolute -top-6">
                    <button
                        class="bg-[#1F2937] dark:bg-[#4a5565] text-white w-15 h-15 rounded-full shadow-xl flex items-center justify-center border-4 border-white dark:border-[#101828]">
                        <x-heroicon-o-home class="w-8 h-8" />
                    </button>
                </a>
            </div>

            <!-- Notifikasi -->
            <a href="" class="flex flex-col items-center text-white space-y-1">
                <x-heroicon-o-ticket class="w-6 h-6" />
                <span class="text-xs">Ticket</span>
            </a>

            <!-- Profil -->
            @if (auth()->user())
                <a href="" class="flex flex-col items-center text-white space-y-1">
                    <x-heroicon-o-user-circle class="w-6 h-6" />
                    <span class="text-xs">Profile</span>
                </a>
            @else
                <a href="" class="flex flex-col items-center text-white space-y-1">
                    <x-heroicon-o-arrow-down-on-square class="w-6 h-6" />
                    <span class="text-xs">Login</span>
                </a>
            @endif


        </div>
    </div>

</div>
