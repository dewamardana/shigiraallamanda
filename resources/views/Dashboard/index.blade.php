@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto px-5 py-6">

    {{-- Judul Halaman --}}
    <h1 class="text-3xl font-bold mb-8 text-gray-800 tracking-tight">
      {{ $title }}
    </h1>

    {{-- Cards Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6 mb-10">
      <div
        class="rounded-xl shadow-lg overflow-hidden bg-gradient-to-r from-blue-600 to-blue-800 text-white hover:shadow-xl transition">
        <div class="p-6 text-center">
          <p class="text-sm opacity-80">Total User</p>
          <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
        </div>
      </div>
      <div
        class="rounded-xl shadow-lg overflow-hidden bg-gradient-to-r from-green-600 to-emerald-700 text-white hover:shadow-xl transition">
        <div class="p-6 text-center">
          <p class="text-sm opacity-80">User Aktif</p>
          <p class="text-3xl font-bold mt-2">{{ $activeUsers }}</p>
        </div>
      </div>
      <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition">
        <div class="p-6 text-center">
          <p class="text-sm font-medium text-gray-600">Cleaning</p>
          <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalCleaning['activity'] }}</p>
          <p class="text-md text-gray-500">{{ $totalCleaning['point'] }} Poin</p>
        </div>
      </div>
      <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition">
        <div class="p-6 text-center">
          <p class="text-sm font-medium text-gray-600">Checker</p>
          <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalChecker['activity'] }}</p>
          <p class="text-md text-gray-500">{{ $totalChecker['point'] }} Poin</p>
        </div>
      </div>
      <div class="rounded-xl shadow bg-white border border-gray-100 hover:shadow-lg transition">
        <div class="p-6 text-center">
          <p class="text-sm font-medium text-gray-600">Office</p>
          <p class="text-3xl font-bold text-orange-600 mt-2">{{ $totalOffice['activity'] }}</p>
          <p class="text-md text-gray-500">{{ $totalOffice['point'] }} Poin</p>
        </div>
      </div>
    </div>

    {{-- Filter Section --}}
    <div class="mb-6">
      <form action="{{ route('dashboard') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">

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

        {{-- Filter Button --}}
        <button type="submit"
          class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center">
          {{ __('button.filter') }}
        </button>

        {{-- Reset Button --}}
        <a href="{{ route('dashboard') }}"
          class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center inline-block">
          {{ __('button.reset') }}
        </a>

      </form>
    </div>


    {{-- Diagram Per Aktivitas --}}
    <div class="space-y-8 mb-10">
      <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-700">Poin Cleaning per User</h2>
          <select id="cleaningFilter"
            class="border rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="all">All User</option>
            <option value="hasPoints">User dengan Poin</option>
            <option value="5">Top 5</option>
            <option value="10">Top 10</option>
          </select>
        </div>
        <canvas id="cleaningChart" height="150"></canvas>
      </div>

      <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-700">Poin Checker per User</h2>
          <select id="checkerFilter"
            class="border rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="all">All User</option>
            <option value="hasPoints">User dengan Poin</option>
            <option value="5">Top 5</option>
            <option value="10">Top 10</option>
          </select>
        </div>
        <canvas id="checkerChart" height="150"></canvas>
      </div>

      <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-700">Poin Office per User</h2>
          <select id="officeFilter"
            class="border rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="all">All User</option>
            <option value="hasPoints">User dengan Poin</option>
            <option value="5">Top 5</option>
            <option value="10">Top 10</option>
          </select>
        </div>
        <canvas id="officeChart" height="150"></canvas>
      </div>
    </div>

    {{-- Leaderboard --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-10 hover:shadow-xl transition">
      <h2 class="text-2xl font-semibold mb-4 text-gray-700">Leaderboard Semua User</h2>
      <canvas id="leaderboardChart" height="200"></canvas>
    </div>

    {{-- Tren Harian --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition">
      <h2 class="text-2xl font-semibold mb-4 text-gray-700">Tren Harian Aktivitas</h2>
      <canvas id="dailyChart" height="150"></canvas>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const chartData = @json($chartData);
    const leaderboardData = @json($leaderboardData);
    const dailyStats = @json($dailyStats);


    function filterChart(chart, labels, data, top, hasPoints = null) {
      let combined = labels.map((label, i) => ({
        label,
        value: data[i]
      })).filter(x => x.label); // hapus label kosong

      // --- Jika pilih “User dengan Poin” ---
      if (top === 'hasPoints' && hasPoints) {
        combined = combined.filter(x => x.value > 0);
      }

      // --- Urut dari poin terbesar ke kecil ---
      combined.sort((a, b) => b.value - a.value);


      // --- Jika top 5 / top 10 ---
      if (top !== 'all' && top !== 'hasPoints') {
        combined = combined.slice(0, parseInt(top));
      }

      // --- Jika hanya 1 user punya poin, tampilkan 1 saja ---
      if (top === 'hasPoints' && combined.length < 5) {
        combined = combined.slice(0, 1);
      }


      chart.data.labels = combined.map(x => x.label);
      chart.data.datasets[0].data = combined.map(x => x.value);
      chart.update();
    }


    // Cleaning Chart
    const cleaningChart = new Chart(document.getElementById('cleaningChart'), {
      type: 'bar',
      data: {
        labels: chartData.labels,
        datasets: [{
          label: 'Cleaning',
          data: chartData.cleaning,
          backgroundColor: '#3b82f6'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });

    // Checker Chart
    const checkerChart = new Chart(document.getElementById('checkerChart'), {
      type: 'bar',
      data: {
        labels: chartData.labels,
        datasets: [{
          label: 'Checker',
          data: chartData.checker,
          backgroundColor: '#a855f7'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });

    // Office Chart
    const officeChart = new Chart(document.getElementById('officeChart'), {
      type: 'bar',
      data: {
        labels: chartData.labels,
        datasets: [{
          label: 'Office',
          data: chartData.office,
          backgroundColor: '#f97316'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
    // --- Event listener untuk dropdown ---
    document.getElementById('cleaningFilter').addEventListener('change', e => {
      filterChart(
        cleaningChart,
        chartData.labels,
        chartData.cleaning,
        e.target.value,
        chartData.cleaning
      );
    });

    document.getElementById('checkerFilter').addEventListener('change', e => {
      filterChart(
        checkerChart,
        chartData.labels,
        chartData.checker,
        e.target.value,
        chartData.checker
      );
    });

    document.getElementById('officeFilter').addEventListener('change', e => {
      filterChart(
        officeChart,
        chartData.labels,
        chartData.office,
        e.target.value,
        chartData.office
      );
    });

    // Leaderboard
    new Chart(document.getElementById('leaderboardChart'), {
      type: 'bar',
      data: {
        labels: leaderboardData.labels,
        datasets: [{
          label: 'Total Poin',
          data: leaderboardData.points,
          backgroundColor: '#6366f1'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });

    window.addEventListener('load', () => {
      // Set value dropdown ke “hasPoints”
      document.getElementById('cleaningFilter').value = 'hasPoints';
      document.getElementById('checkerFilter').value = 'hasPoints';
      document.getElementById('officeFilter').value = 'hasPoints';

      // Jalankan filter pertama kali
      filterChart(cleaningChart, chartData.labels, chartData.cleaning, 'hasPoints', chartData.cleaning);
      filterChart(checkerChart, chartData.labels, chartData.checker, 'hasPoints', chartData.checker);
      filterChart(officeChart, chartData.labels, chartData.office, 'hasPoints', chartData.office);
    });

    // Tren Harian
    const grouped = {};
    dailyStats.forEach(row => {
      if (!grouped[row.type]) grouped[row.type] = {
        label: row.type,
        data: [],
        borderWidth: 2,
        fill: false
      };
    });
    const dates = [...new Set(dailyStats.map(r => r.date))];
    Object.keys(grouped).forEach(type => {
      grouped[type].data = dates.map(d => {
        const found = dailyStats.find(r => r.date === d && r.type === type);
        return found ? found.total : 0;
      });
    });
    new Chart(document.getElementById('dailyChart'), {
      type: 'line',
      data: {
        labels: dates,
        datasets: Object.values(grouped)
      }
    });
  </script>
@endsection
