@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
      {{-- Tombol Previous --}}
      @if ($paginator->onFirstPage())
        <span
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
          Previous
        </span>
      @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-orange-600 leading-5 rounded-md hover:bg-orange-700 focus:outline-none focus:ring focus:ring-orange-300">
          Previous
        </a>
      @endif

      {{-- Tombol Next --}}
      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
          class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-orange-600 leading-5 rounded-md hover:bg-orange-700 focus:outline-none focus:ring focus:ring-orange-300">
          Next
        </a>
      @else
        <span
          class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
          Next
        </span>
      @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700 leading-5">
          Showing
          <span class="font-medium">{{ $paginator->firstItem() }}</span>
          to
          <span class="font-medium">{{ $paginator->lastItem() }}</span>
          of
          <span class="font-medium">{{ $paginator->total() }}</span>
          results
        </p>
      </div>

      <div>
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
          {{-- Tombol Previous --}}
          @if ($paginator->onFirstPage())
            <span
              class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
              aria-hidden="true">
              <i data-feather="chevron-left" class="w-4 h-4"></i>
            </span>
          @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
              class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-orange-600 border border-orange-600 rounded-l-md leading-5 hover:bg-orange-700 focus:z-10 focus:outline-none focus:ring focus:ring-orange-300"
              aria-label="Previous">
              <i data-feather="chevron-left" class="w-4 h-4"></i>
            </a>
          @endif

          {{-- Nomor Halaman --}}
          @foreach ($elements as $element)
            {{-- Separator ("...") --}}
            @if (is_string($element))
              <span
                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
            @endif

            {{-- Link Halaman --}}
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                  <span
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold text-white bg-orange-600 border border-orange-600 cursor-default leading-5">{{ $page }}</span>
                @else
                  <a href="{{ $url }}"
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-orange-600 bg-white border border-gray-300 leading-5 hover:text-orange-700 hover:bg-orange-50 focus:z-10 focus:outline-none focus:ring focus:ring-orange-300"
                    aria-label="Go to page {{ $page }}">
                    {{ $page }}
                  </a>
                @endif
              @endforeach
            @endif
          @endforeach

          {{-- Tombol Next --}}
          @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
              class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-white bg-orange-600 border border-orange-600 rounded-r-md leading-5 hover:bg-orange-700 focus:z-10 focus:outline-none focus:ring focus:ring-orange-300"
              aria-label="Next">
              <i data-feather="chevron-right" class="w-4 h-4"></i>
            </a>
          @else
            <span
              class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-md leading-5"
              aria-hidden="true">
              <i data-feather="chevron-right" class="w-4 h-4"></i>
            </span>
          @endif
        </span>
      </div>
    </div>
  </nav>
@endif
