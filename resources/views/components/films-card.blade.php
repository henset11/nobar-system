<a href="{{ route('films.show', $film->id) }}" class="card">
    <div
        class="flex rounded-[30px] border border-[#F1F2F6] dark:border-[#364153] p-4 gap-4 bg-white dark:bg-[#1e2939] hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
        <div class="flex w-[120px] h-[183px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
            <img src="{{ $film->getFirstMediaUrl('film') }}" class="w-full h-full object-cover" alt="{{ $film->name }}">
        </div>
        <div class="flex flex-col gap-3 w-full">
            <h3 class="font-semibold text-lg leading-[40px] line-clamp-2 min-h-[40px]">{{ $film->name }}
                ({{ $film->release_year }})</h3>
            <hr class="border-[#F1F2F6]">
            <div class="flex flex-wrap gap-2">
                @foreach ($film->genres as $genre)
                    <a href=""
                        class="px-2 py-1 text-xs font-medium rounded-full bg-[#DCFCE7] text-[#166534] hover:bg-[#BBF7D0] transition-colors">{{ $genre->name }}</a>
                @endforeach
            </div>
            <hr class="border-[#F1F2F6]">
            <div class="flex items-center gap-[6px]">
                <x-heroicon-o-clock class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Duration: {{ $film->duration }}
                    minutes</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <x-heroicon-o-users class="w-5 h-5 flex shrink-0 text-ngekos-grey" />
                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Producer: {{ $film->producer }}
                </p>
            </div>
        </div>
    </div>
</a>
