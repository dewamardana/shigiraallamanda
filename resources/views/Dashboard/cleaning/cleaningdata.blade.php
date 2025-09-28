@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">📊 {{ __('dashboardCleaning.cleaningdata.title') }}</h1>

    {{-- Filter --}}
    <div class="mb-6">
      <form action="{{ route('cleaningdata') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">

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

        {{-- Building --}}
        <div class="w-full sm:w-auto">
          <label for="building" class="block mb-1 text-sm font-medium text-gray-900">
            {{ __('dashboardCleaning.cleaningdata.filter_building') }}
          </label>
          <select id="building" name="building"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
            <option value="">{{ __('dashboardCleaning.cleaningdata.filter_all') }}</option>
            @foreach ($buildings as $b)
              <option value="{{ $b->slug }}" {{ request('building') == $b->slug ? 'selected' : '' }}>
                {{ $b->building_name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- User --}}
        <div class="w-full sm:w-auto">
          <label for="user" class="block mb-1 text-sm font-medium text-gray-900">
            {{ __('dashboardCleaning.cleaningdata.filter_user') }}
          </label>
          <select id="user" name="user"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
            <option value="">{{ __('dashboardCleaning.cleaningdata.filter_user') }}</option>
            @foreach ($users as $u)
              <option value="{{ $u->id }}" {{ request('user') == $u->id ? 'selected' : '' }}>
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
        <a href="{{ route('cleaningdata') }}">
          <button type="button"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
            {{ __('button.reset') }}
          </button>
        </a>

        <a
          href="{{ route('cleaningexport', [
              'start_date' => request('start_date'),
              'end_date' => request('end_date'),
              'building' => request('building'),
          ]) }}">
          <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 focus:outline-none">
            {{ __('button.export') }}
          </button>
        </a>


      </form>
    </div>

    @foreach ($grouped as $groupKey => $data)
      @php
        [$buildingSlug, $memberCount] = explode('|', $groupKey);
        $records = $data['records'];
        $buildingName = $records[0]['building_name'] ?? 'Unknown';
        $taskNames = array_keys($data['all_task_names']);
      @endphp

      <div class="mb-10">
        <h2 class="text-2xl font-semibold mb-4 text-blue-800">
          {{ $buildingName }} — <span class="text-gray-600">{{ $memberCount }} members</span>
        </h2>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-black">
            <thead class="text-xs text-white uppercase bg-teal-1001">
              <tr>
                <th class="px-6 py-3">Date</th>
                <th class="px-6 py-3">Member</th>
                @foreach ($taskNames as $taskName)
                  <th class="px-6 py-3">{{ $taskName }}</th>
                @endforeach
                <th class="px-6 py-3">Total</th>
                <th class="px-6 py-3">Point</th>
                <th class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $rec)
                @foreach ($rec['members'] as $i => $member)
                  <tr class="{{ $loop->parent->iteration % 2 === 0 ? 'bg-slate-100' : 'bg-white' }} hover:bg-yellow-50">
                    @if ($i === 0)
                      <td rowspan="{{ $rec['member_count'] }}" class="px-6 py-4">{{ $rec['date'] }}</td>
                    @endif

                    <td class="px-6 py-4">{{ $member['nama'] }}</td>

                    @if ($i === 0)
                      @foreach ($taskNames as $taskName)
                        @php
                          $t = $rec['tasks'][$taskName] ?? null;
                        @endphp
                        <td rowspan="{{ $rec['member_count'] }}" class="px-6 py-4">
                          @if ($t)
                            <div>{{ $t['value'] }}</div>
                            <div class="text-gray-500">× {{ $t['formula'] }}</div>
                            <div class="mt-1 font-bold text-base">{{ $t['calculated'] }}</div>
                          @else
                            – {{-- jika task tidak ada di record ini --}}
                          @endif
                        </td>
                      @endforeach

                      <td rowspan="{{ $rec['member_count'] }}" class="px-6 py-4 bg-blue-100">
                        <div>Total: {{ number_format($rec['total'], 1) }}</div>
                        <div class="text-gray-500">/ {{ $rec['member_count'] }} member</div>
                        <div class="mt-1 font-bold text-base text-blue-800">
                          {{ number_format($rec['poin_per_member'], 2) }}
                        </div>
                      </td>
                    @endif

                    {{-- Point per member --}}
                    <td class="px-6 py-4 text-center text-blue-800 font-bold">
                      {{ number_format($rec['poin_per_member'], 2) }}
                    </td>

                    @if ($i === 0)
                      <td rowspan="{{ $rec['member_count'] }}" class="px-6 py-4">
                        <form action="{{ route('cleaning.destroy', $rec['id']) }}" method="POST"
                          data-confirm="{{ __('button.delete_confirm') }}">
                          @csrf
                          @method('DELETE')
                          <button class="text-white bg-red-600 px-4 py-2 rounded">{{ __('button.delete') }}</button>
                        </form>
                      </td>
                    @endif
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endforeach


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
