 <div class="swiper-slide !w-fit">
     <a href="{{ route('films.show', $playing->id) }}" class="card">
         <div
             class="flex flex-col w-[250px] shrink-0 rounded-[30px] border border-[#F1F2F6] dark:border-[#364153] p-4 pb-5 gap-[10px] bg-white dark:bg-[#1e2939] hover:border-[#00598a] dark:hover:border-[#00bcff] transition-all duration-300">
             <div class="flex w-full h-full shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                 <img src="{{ $playing->getFirstMediaUrl('film') }}" class="w-full h-full object-cover"
                     alt="{{ $playing->name }}">
             </div>
             <div class="flex flex-col gap-3">
                 <h3 class="font-semibold text-lg text-center leading-[40px] line-clamp-2 min-h-[40px]">
                     {{ $playing->name }} ({{ $playing->release_year }})</h3>
                 <hr class="border-[#F1F2F6]">
                 <div class="flex flex-wrap gap-2">
                     @foreach ($playing->genres->take(2) as $genre)
                         <a href=""
                             class="px-2 py-1 text-xs font-medium rounded-full bg-[#DCFCE7] text-[#166534] hover:bg-[#BBF7D0] transition-colors">{{ $genre->name }}</a>
                     @endforeach
                     @if ($playing->genres->count() > 2)
                         <button
                             class="px-2 py-1 text-xs font-medium rounded-full bg-[#f3f4f6] text-[#4b5563] hover:bg-[#e5e7eb] transition-colors"
                             title="{{ $playing->genres->skip(2)->pluck('name')->join(', ') }}">
                             +{{ $playing->genres->count() - 2 }}
                         </button>
                     @endif
                 </div>
                 <hr class="border-[#F1F2F6]">
                 <div class="flex items-center gap-[6px]">
                     <x-heroicon-o-clock class="w-5 h-5 flex shrink-0 text-ngekos-grey dark:text-[#99a1af]" />
                     <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Durasi:
                         {{ $playing->duration }} menit</p>
                 </div>
                 <div class="flex items-center gap-[6px]">
                     <x-heroicon-o-users class="w-5 h-5 flex shrink-0 text-ngekos-grey dark:text-[#99a1af]" />
                     <p class="text-sm text-ngekos-grey dark:text-[#99a1af]">Producer:
                         {{ $playing->producer }}</p>
                 </div>
             </div>
         </div>
     </a>
 </div>
