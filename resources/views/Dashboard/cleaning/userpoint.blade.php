@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-900">📊 {{ __('dashboardCleaning.userpoint.title') }}</h1>

    {{-- Filter --}}
    <div class="mb-6">
      <form method="GET" action="{{ route('userpoint') }}" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">
        @csrf

        {{-- Start Date (Year & Month only) - custom popup (Tailwind style) --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>

          <!-- visible input (text, not native month) -->
          <input id="filter_date" name="filter_date" type="text" readonly
            value="{{ old('filter_date', $filter_date ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5 cursor-pointer"
            placeholder="YYYY-MM" />

          <!-- Popup -->
          <div id="monthPickerPopup"
            class="invisible opacity-0 pointer-events-none absolute mt-2 left-0 z-50 w-72 bg-white border border-gray-200 rounded-lg shadow-lg p-3 transform transition-all duration-200 ease-out"
            style="min-width: 18rem;">
            <div class="flex items-center justify-between mb-3 gap-2">
              <div class="flex items-center gap-1">
                <button type="button" id="prevYear" class="p-1 rounded hover:bg-gray-100" title="Previous Year">
                  <!-- chevron-left -->
                  <svg class="w-5 h-5 text-gray-600" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 16L6 10l6-6"></path>
                  </svg>
                </button>

                <select id="yearSelect"
                  class="text-sm font-medium rounded border bg-white pr-6 pl-2 py-1 appearance-none cursor-pointer focus:ring-blue-500 focus:border-blue-500 relative">
                </select>


                <button type="button" id="nextYear" class="p-1 rounded hover:bg-gray-100" title="Next Year">
                  <!-- chevron-right -->
                  <svg class="w-5 h-5 text-gray-600" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 4l6 6-6 6"></path>
                  </svg>
                </button>
              </div>

              <div class="flex items-center gap-2">
                <button type="button" id="todayBtn"
                  class="text-sm px-2 py-1 rounded bg-blue-600 text-white hover:bg-blue-700">Today</button>
                <button type="button" id="clearMonth"
                  class="text-sm px-2 py-1 rounded bg-gray-100 hover:bg-gray-200">Clear</button>
              </div>
            </div>

            <div class="grid grid-cols-3 gap-2" id="monthsGrid" aria-label="Months">
              <!-- month buttons injected by JS -->
            </div>

            <div class="mt-3 text-right">
              <button type="button" id="closePicker"
                class="text-sm px-3 py-1 rounded bg-gray-50 hover:bg-gray-100">Close</button>
            </div>
          </div>
        </div>



        {{-- Filter Button --}}
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
          {{ __('button.filter') }}
        </button>

        {{-- Reset Button --}}
        <a href="{{ route('checkerdata') }}">
          <button type="button"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
            {{ __('button.reset') }}
          </button>
        </a>

        {{-- Export Button --}}
        <a
          href="{{ route('userPointExport', [
              'year' => $year,
              'month' => $month,
          ]) }}">
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 focus:outline-none">
            {{ __('button.export') }}
          </button>
        </a>
      </form>
    </div>



    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-300 my-4">
      <table class="min-w-full table-auto text-sm text-gray-800 border-collapse">
        <thead class="bg-teal-1001 text-white">
          <tr>
            <th class="border border-gray-300 px-4 py-3 text-center whitespace-nowrap">
              {{ __('dashboardCleaning.userpoint.table.no') }}
            </th>
            <th class="border border-gray-300 px-4 py-3 text-left whitespace-nowrap">
              {{ __('dashboardCleaning.userpoint.table.name') }}
            </th>
            @for ($i = 1; $i <= $daysInMonth; $i++)
              <th class="border border-gray-300 px-3 py-3 text-center whitespace-nowrap">
                {{ __('dashboardCleaning.userpoint.table.day') }} {{ $i }}
              </th>
            @endfor
            <th class="border border-gray-300 px-4 py-3 text-center whitespace-nowrap">
              {{ __('dashboardCleaning.userpoint.table.total') }}
            </th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @php $no = 1; @endphp
          @foreach ($rekap as $userId => $data)
            <tr class="border-t border-gray-200 hover:bg-yellow-50 odd:bg-teal-50">
              {{-- No --}}
              <td class="border border-gray-300 px-4 py-2 text-center font-semibold whitespace-nowrap">
                {{ $no++ }}
              </td>

              {{-- Nama --}}
              <td class="border border-gray-300 px-4 py-2 text-left font-semibold whitespace-nowrap">
                {{ $data['nama'] }}
              </td>

              {{-- Hari 1 - N --}}
              @for ($i = 1; $i <= $daysInMonth; $i++)
                <td
                  class="border border-gray-300 px-3 py-2 text-center whitespace-nowrap {{ $data['poin'][$i] == 0 ? 'text-gray-400' : 'font-medium text-slate-700' }}">
                  {{ number_format($data['poin'][$i], 1) }}
                </td>
              @endfor

              {{-- Total --}}
              <td class="border border-gray-300 px-4 py-2 text-center font-bold text-blue-800 whitespace-nowrap">
                <a href="{{ route('userpoint.rekap', ['user' => $userId, 'year' => $year, 'month' => $month]) }}"
                  class="text-blue-600 hover:underline">
                  {{ number_format($data['total'], 1) }}
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    (function() {
      const input = document.getElementById('filter_date');
      const popup = document.getElementById('monthPickerPopup');
      const yearSelect = document.getElementById('yearSelect');
      const prevBtn = document.getElementById('prevYear');
      const nextBtn = document.getElementById('nextYear');
      const clearBtn = document.getElementById('clearMonth');
      const todayBtn = document.getElementById('todayBtn');
      const closeBtn = document.getElementById('closePicker');
      const monthsGrid = document.getElementById('monthsGrid');

      const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      let currentYear = new Date().getFullYear();

      // Build year options (change range here if needed)
      function buildYearOptions(centerYear = new Date().getFullYear(), rangeBefore = 5, rangeAfter = 5) {
        yearSelect.innerHTML = '';
        const start = centerYear - rangeBefore;
        const end = centerYear + rangeAfter;
        for (let y = end; y >= start; y--) {
          const opt = document.createElement('option');
          opt.value = y;
          opt.textContent = y;
          yearSelect.appendChild(opt);
        }
      }

      function pad(n) {
        return String(n).padStart(2, '0');
      }

      function showPopup() {
        // set currentYear from input if present
        const val = input.value;
        if (val && /^\d{4}-\d{2}$/.test(val)) {
          currentYear = parseInt(val.split('-')[0], 10);
        } else {
          currentYear = new Date().getFullYear();
        }

        // build years and set selected
        buildYearOptions(currentYear, 10, 10); // -10..+10
        yearSelect.value = String(currentYear);

        renderMonths();
        // animate in
        popup.classList.remove('invisible', 'opacity-0', 'pointer-events-none', '-translate-y-1');
        popup.classList.add('opacity-100');
        popup.style.transform = 'translateY(0)';
      }

      function hidePopup() {
        // animate out
        popup.classList.add('opacity-0', 'pointer-events-none');
        popup.style.transform = 'translateY(-6px)';
        // add invisible after transition for accessibility
        setTimeout(() => popup.classList.add('invisible'), 200);
      }

      function renderMonths() {
        monthsGrid.innerHTML = '';
        monthNames.forEach((m, idx) => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'w-full text-sm py-2 rounded hover:bg-blue-50 focus:bg-blue-50 focus:outline-none';
          btn.dataset.month = idx;
          btn.textContent = m;
          // highlight current selected if matches input
          const cur = input.value;
          if (cur && cur.startsWith(String(currentYear))) {
            const sel = parseInt(cur.split('-')[1], 10) - 1;
            if (sel === idx) {
              btn.classList.add('bg-blue-600', 'text-white', 'font-medium');
            }
          }
          btn.addEventListener('click', (e) => {
            const monthValue = pad(idx + 1);
            input.value = `${currentYear}-${monthValue}`;
            input.dispatchEvent(new Event('change', {
              bubbles: true
            }));
            hidePopup();
          });
          monthsGrid.appendChild(btn);
        });
      }

      // events
      input.addEventListener('click', (e) => {
        e.stopPropagation();
        // toggle
        if (popup.classList.contains('invisible')) showPopup();
        else hidePopup();
      });

      yearSelect.addEventListener('change', (e) => {
        currentYear = parseInt(yearSelect.value, 10);
        renderMonths();
      });

      prevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        currentYear--;
        // update yearSelect (if value exists)
        if (Array.from(yearSelect.options).some(o => o.value == currentYear)) {
          yearSelect.value = String(currentYear);
        } else {
          // rebuild with new center
          buildYearOptions(currentYear, 10, 10);
          yearSelect.value = String(currentYear);
        }
        renderMonths();
      });

      nextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        currentYear++;
        if (Array.from(yearSelect.options).some(o => o.value == currentYear)) {
          yearSelect.value = String(currentYear);
        } else {
          buildYearOptions(currentYear, 10, 10);
          yearSelect.value = String(currentYear);
        }
        renderMonths();
      });

      clearBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        input.value = '';
        input.dispatchEvent(new Event('change', {
          bubbles: true
        }));
        renderMonths();
      });

      todayBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const d = new Date();
        input.value = `${d.getFullYear()}-${pad(d.getMonth()+1)}`;
        input.dispatchEvent(new Event('change', {
          bubbles: true
        }));
        hidePopup();
      });

      closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        hidePopup();
      });

      // close on outside click
      document.addEventListener('click', (e) => {
        if (!popup.contains(e.target) && e.target !== input) {
          hidePopup();
        }
      });

      // close on escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') hidePopup();
      });

      // init (render invisible but ready)
      (function init() {
        popup.classList.add('invisible', 'opacity-0', 'pointer-events-none');
        popup.style.transform = 'translateY(-6px)';
        // pre-build year options
        buildYearOptions(currentYear, 10, 10);
        renderMonths();
      })();
    })();
  </script>
@endsection
