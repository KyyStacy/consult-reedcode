@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="mt-6">
        <div class="flex justify-between items-center">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-default leading-5 rounded-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-cyan-500 to-cyan-600 border border-cyan-600 leading-5 rounded-xl hover:from-cyan-600 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 active:bg-cyan-700 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {!! __('pagination.previous') !!}
                    </a>
                @endif
            </span>

            <span class="text-sm text-gray-600 px-4">
                Menampilkan {{ $paginator->firstItem() ?? 0 }} - {{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }} hasil
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-cyan-500 to-cyan-600 border border-cyan-600 leading-5 rounded-xl hover:from-cyan-600 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 active:bg-cyan-700 transition-all duration-200 shadow-sm hover:shadow-md">
                        {!! __('pagination.next') !!}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 cursor-default leading-5 rounded-xl">
                        {!! __('pagination.next') !!}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </span>
                @endif
            </span>
        </div>
    </nav>
@endif