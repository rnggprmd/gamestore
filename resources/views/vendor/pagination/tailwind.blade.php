@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between gap-3">
        <div class="flex-1 flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-watt-text-sec text-xs font-medium cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-white text-xs font-medium hover:border-watt-cyan hover:text-watt-cyan transition-colors">Previous</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-white text-xs font-medium hover:border-watt-cyan hover:text-watt-cyan transition-colors">Next</a>
            @else
                <span class="inline-flex items-center px-4 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-watt-text-sec text-xs font-medium cursor-not-allowed">Next</span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between sm:gap-4">
            <div>
                <p class="text-xs text-watt-text-sec font-mono">
                    @if ($paginator->firstItem())
                        Menampilkan <span class="font-semibold text-white">{{ $paginator->firstItem() }}</span>
                        sampai <span class="font-semibold text-white">{{ $paginator->lastItem() }}</span>
                        dari <span class="font-semibold text-white">{{ $paginator->total() }}</span> data
                    @else
                        Menampilkan <span class="font-semibold text-white">0</span> data
                    @endif
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex flex-wrap gap-2">
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-watt-text-sec text-xs font-medium cursor-not-allowed">‹</span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-white text-xs font-medium hover:border-watt-cyan hover:text-watt-cyan transition-colors">‹</a>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-watt-text-sec text-xs font-medium">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-cyan bg-gradient-to-r from-watt-cyan to-blue-500 text-watt-bg text-xs font-bold shadow-[0_10px_30px_rgba(0,229,255,0.18)]">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-white text-xs font-medium hover:border-watt-cyan hover:text-watt-cyan transition-colors">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-white text-xs font-medium hover:border-watt-cyan hover:text-watt-cyan transition-colors">›</a>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')" class="inline-flex items-center px-3.5 py-2 rounded-xl border border-watt-border bg-watt-bg/60 text-watt-text-sec text-xs font-medium cursor-not-allowed">›</span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
