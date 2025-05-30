<div class="swiper-slide !w-fit pb-[30px]">
    <a href="{{ route('genres.film', $genre->id) }}" class="card">
        <div
            class="flex flex-col items-center w-[120px] shrink-0 rounded-[40px] p-4 pb-5 gap-3 bg-white border border-white dark:bg-[#052f4a] dark:border-[#052f4a] shadow-[0px_12px_30px_0px_#0000000D] text-center hover:border-[#00598a] dark:hover:border-[#00bcff]">
            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                <img src="{{ $genre->getFirstMediaUrl('genre') }}" class="w-full h-full object-cover"
                    alt="{{ $genre->name }}">
            </div>
            <div class="flex flex-col gap-[2px]">
                <h3 class="font-semibold">{{ $genre->name }}</h3>
                <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">{{ $genre->films->count() }} movies
                </p>
            </div>
        </div>
    </a>
</div>
