@if ($paginator->hasPages())
    <div class="w-full flex justify-center py-4">
        <nav class="flex flex-wrap gap-2 items-center" aria-label="Pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="flex w-10 h-10 mr-1 justify-center items-center rounded-full border border-[#d1d5dc] bg-[#e5e7eb] dark:bg-[#6a7282] text-[#99a1af] dark:text-[#99a1af] pointer-events-none">
                    <x-heroicon-c-chevron-left class="w-5 h-5" />
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">
                    <span
                        class="flex w-10 h-10 mr-1 justify-center items-center rounded-full border border-[#e5e7eb] bg-white dark:bg-[#364153] text-[#000000] dark:text-[#ffffff] hover:border-[#d1d5dc] dark:hover:border-[#4a5565]">
                        <x-heroicon-c-chevron-left class="w-5 h-5" />
                    </span>
                </a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span
                        class="flex w-10 h-10 mx-1 justify-center items-center text-[#99a1af] dark:text-[#ffffff]">...</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-[#000000] dark:border-[#fff] bg-[#1e2939] dark:bg-[#030712] text-white pointer-events-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-[#e5e7eb] bg-white text-[#000] dark:bg-[#364153] dark:text-[#fff] hover:border-[#d1d5dc] dark:hover:border-[#4a5565]">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex w-10 h-10 mr-1 justify-center items-center rounded-full border border-[#e5e7eb] bg-white dark:bg-[#364153] text-[#000000] dark:text-[#ffffff] hover:border-[#d1d5dc] dark:hover:border-[#4a5565]">
                    <x-heroicon-c-chevron-right class="w-5 h-5" />
                </a>
            @else
                <span
                    class="flex w-10 h-10 mr-1 justify-center items-center rounded-full border border-[#d1d5dc] bg-[#e5e7eb] dark:bg-[#6a7282] text-[#99a1af] dark:text-[#99a1af] pointer-events-none">
                    <x-heroicon-c-chevron-right class="w-5 h-5" />
                </span>
            @endif
        </nav>
    </div>
@endif
