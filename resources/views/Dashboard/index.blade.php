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

    {{-- Diagram Per Aktivitas --}}
    <div class="space-y-8 mb-10">
      <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-700">Poin Cleaning per User</h2>
          <select id="cleaningFilter"
            class="border rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="all">All User</option>
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
            class="border rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-purple-500 focus:outline-none">
            <option value="all">All User</option>
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
            class="border rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-none">
            <option value="all">All User</option>
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

    function filterChart(chart, labels, data, top) {
      let sorted = labels.map((label, i) => ({
          label,
          value: data[i]
        }))
        .sort((a, b) => b.value - a.value);

      if (top !== 'all') {
        sorted = sorted.slice(0, parseInt(top));
      }

      chart.data.labels = sorted.map(x => x.label);
      chart.data.datasets[0].data = sorted.map(x => x.value);
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
    document.getElementById('cleaningFilter').addEventListener('change', e => {
      filterChart(cleaningChart, chartData.labels, chartData.cleaning, e.target.value);
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
    document.getElementById('checkerFilter').addEventListener('change', e => {
      filterChart(checkerChart, chartData.labels, chartData.checker, e.target.value);
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
    document.getElementById('officeFilter').addEventListener('change', e => {
      filterChart(officeChart, chartData.labels, chartData.office, e.target.value);
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
