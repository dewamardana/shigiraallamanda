@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">📋 {{ __('dashboardCleaning.checkdata.title') }}</h1>

    {{-- Filter --}}
    <div class="mb-6">
      <form action="{{ route('checkerdata') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">

        {{-- Start Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-start" name="start_date" value="{{ request('start_date') }}" datepicker
            datepicker-autohide datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
            placeholder="{{ __('general.filter.start_date') }}">
        </div>

        {{-- End Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="datepicker-end" name="end_date" value="{{ request('end_date') }}" datepicker datepicker-autohide
            datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px] ps-10 p-2.5"
            placeholder="{{ __('general.filter.end_date') }}">
        </div>

        {{-- User --}}
        <div class="w-full sm:w-auto">
          <label for="user_id" class="block mb-1 text-sm font-medium text-gray-900">
            {{ __('dashboardCleaning.checkdata.user') }}
          </label>
          <select id="user_id" name="user_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
            <option value="">{{ __('dashboardCleaning.checkdata.all') }}</option>
            @foreach ($users as $u)
              <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                {{ $u->nama }}
              </option>
            @endforeach
          </select>
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

        <a
          href="{{ route('checkerexport', [
              'start_date' => request('start_date'),
              'end_date' => request('end_date'),
              'user_id' => request('user_id'),
          ]) }}">
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 focus:outline-none">
            {{ __('button.export') }}
          </button>
        </a>


      </form>
    </div>


    {{-- Table --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-300 my-4">
      <table class="min-w-full table-auto text-sm text-gray-800 border-collapse">
        <thead class="bg-teal-1001 text-white sticky top-0">
          <tr>
            <th class="border border-gray-300 px-4 py-3 text-left">{{ __('dashboardCleaning.checkdata.table.date') }}
            </th>
            <th class="border border-gray-300 px-4 py-3 text-left">{{ __('dashboardCleaning.checkdata.table.name') }}
            </th>

            @foreach ($tasks as $task)
              <th class="border border-gray-300 px-3 py-3 text-center">
                {{ $task->name }}
              </th>
            @endforeach

            <th class="border border-gray-300 px-3 py-3 text-center">
              {{ __('dashboardCleaning.checkdata.table.total') }}
            </th>
            <th class="border border-gray-300 px-3 py-3 text-center">
              {{ __('dashboardBuilding.index.table.action') }}
            </th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @forelse ($checkerData as $data)
            <tr class="border-t border-gray-200 hover:bg-yellow-50">
              <td class="px-4 py-2 whitespace-nowrap">{{ \Carbon\Carbon::parse($data['date'])->format('d M Y') }}</td>
              <td class="px-4 py-2 whitespace-nowrap">{{ $data['user_name'] }}</td>

              @foreach ($tasks as $task)
                @php
                  $value = $data['tasks'][$task->name] ?? null;
                  $point = $data['tasks'][$task->name . '_poin'] ?? null;
                @endphp
                <td class="text-center">
                  @if ($task->type === 'number')
                    {{ $value ? $value . ' × ' . $task->formula : '❌' }}
                  @else
                    {{ $value ? '✅ + ' . $task->formula : '❌' }}
                  @endif
                </td>
              @endforeach

              <td class="text-center font-bold text-green-700 whitespace-nowrap">
                {{ number_format($data['total_point'], 2) }}
              </td>
              <td class="text-center">
                <form action="{{ route('checkerDestroy', $data['id']) }}" method="POST" class="inline-block"
                  data-confirm="{{ __('button.delete_confirm') }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 mx-2 my-2">
                    {{ __('button.delete') }}
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="{{ 3 + count($tasks) }}" class="text-center text-gray-500 py-6">
                {{ __('dashboardCleaning.checkdata.table.no_data') }}
              </td>
            </tr>
          @endforelse
        </tbody>

      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('form[data-confirm]').forEach(function(form) {
        form.addEventListener('submit', function(e) {
          const message = form.getAttribute('data-confirm');
          if (!confirm(message)) {
            e.preventDefault();
          }
        });
      });
    });
  </script>
@endsection
