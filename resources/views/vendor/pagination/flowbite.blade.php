@if ($paginator->hasPages())
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 space-y-4 sm:space-y-0">

    {{-- Info jumlah data --}}
    <div>
      <p class="text-sm text-blue-600 leading-5">
        {!! __('Showing') !!}
        @if ($paginator->firstItem())
          <span class="font-medium">{{ $paginator->firstItem() }}</span>
          {!! __('to') !!}
          <span class="font-medium">{{ $paginator->lastItem() }}</span>
        @else
          {{ $paginator->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
      </p>
    </div>

    {{-- Pagination tombol --}}
    <nav aria-label="Page navigation">
      <ul class="flex items-center -space-x-px h-9 text-sm">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <li>
            <span
              class="flex items-center justify-center px-3 h-9 leading-tight 
                text-gray-400 bg-gray-100 border border-e-0 border-gray-200 rounded-s-lg cursor-not-allowed">
              <span class="sr-only">Previous</span>
              <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 1 1 5l4 4" />
              </svg>
            </span>
          </li>
        @else
          <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
              class="flex items-center justify-center px-3 h-9 leading-tight 
                text-blue-600 bg-white border border-e-0 border-gray-200 rounded-s-lg
                hover:bg-blue-50 hover:text-blue-700 transition">
              <span class="sr-only">Previous</span>
              <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 1 1 5l4 4" />
              </svg>
            </a>
          </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- Dots --}}
          @if (is_string($element))
            <li>
              <span
                class="flex items-center justify-center px-3 h-9 leading-tight 
                  text-gray-500 bg-white border border-gray-200">
                {{ $element }}
              </span>
            </li>
          @endif

          {{-- Array of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <li>
                  <span aria-current="page"
                    class="z-10 flex items-center justify-center px-3 h-9 leading-tight 
                      text-white bg-blue-600 border border-blue-600 font-semibold 
                      hover:bg-blue-700 hover:text-white transition">
                    {{ $page }}
                  </span>
                </li>
              @else
                <li>
                  <a href="{{ $url }}"
                    class="flex items-center justify-center px-3 h-9 leading-tight 
                      text-blue-600 bg-white border border-gray-200
                      hover:bg-blue-50 hover:text-blue-700 transition">
                    {{ $page }}
                  </a>
                </li>
              @endif
            @endforeach
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
              class="flex items-center justify-center px-3 h-9 leading-tight 
                text-blue-600 bg-white border border-gray-200 rounded-e-lg 
                hover:bg-blue-50 hover:text-blue-700 transition">
              <span class="sr-only">Next</span>
              <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
            </a>
          </li>
        @else
          <li>
            <span
              class="flex items-center justify-center px-3 h-9 leading-tight 
                text-gray-400 bg-gray-100 border border-gray-200 rounded-e-lg cursor-not-allowed">
              <span class="sr-only">Next</span>
              <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
            </span>
          </li>
        @endif
      </ul>
    </nav>
  </div>
@endif
