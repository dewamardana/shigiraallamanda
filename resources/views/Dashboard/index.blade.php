@extends('Dashboard.Layout.main')

@section('content')
<div class="w-full max-w-screen-2xl mx-auto px-5 py-6"> 
  <h1 class="text-2xl font-bold mb-4">{{ __('dashboardIndex.title') }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-teal-600 to-teal-800 text-white">
        <div class="p-5">
        <p class="text-sm opacity-80">{{ __('dashboardIndex.total_users') }}</p>
        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>
    </div>

    <!-- Active Users -->
    <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-green-600 to-green-800 text-white">
        <div class="p-5">
        <p class="text-sm opacity-80">{{ __('dashboardIndex.active_users') }}</p>
        <p class="text-3xl font-bold">{{ $activeUsers }}</p>
        </div>
    </div>

    <!-- Most Active User -->
    <div class="rounded-xl shadow overflow-hidden bg-gradient-to-r from-indigo-600 to-indigo-800 text-white">
        <div class="p-5">
        <p class="text-sm opacity-80">{{ __('dashboardIndex.most_active_user') }}</p>
        <div class="flex flex-row gap-2 my-2">
            <img class="w-8 h-8 rounded-full" src="{{ asset('images/user-profile.png') }}" alt="user photo">
            <p class="text-xl font-bold">{{ $mostActiveUser['nama'] }}</p>
        </div>
        <p class="text-sm opacity-80">
            {{ number_format($mostActiveUser['total']) }} {{ __('dashboardIndex.points') }}
        </p>
        </div>
    </div>
    </div>


  <form method="GET" action="/dashboard" class="flex gap-4 items-center mb-6">
    
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-start" name="start_date" value="{{ request('start_date') }}" datepicker datepicker-autohide datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text" value="{{ old('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="{{ __('dashboardIndex.start_date') }}">
    </div> 

    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-end" name="end_date" value="{{ request('end_date') }}" datepicker datepicker-autohide datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text" value="{{ old('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="{{ __('dashboardIndex.end_date') }}">
    </div> 

    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center me-2 mb-2"> {{ __('button.filter') }}</button>

    <a href="/dashboard">
        <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2">{{ __('button.reset') }}</button>
    </a>
  </form>
  
  
  <h2 class="text-xl font-semibold my-5 text-center">{{ __('dashboardIndex.daily_stat') }}</h2>
  <div id="dailyChart" class="w-full h-[420px]"></div>

  <h2 class="text-xl font-semibold mb-4 text-center">{{ __('dashboardIndex.total_point') }}</h2>
  <div id="pointChart" class="w-full h-[420px]"></div>
  <h2 class="text-xl font-semibold mb-4 text-center">{{ __('dashboardIndex.total_point') }}</h2>

  {{-- Tambahan: Top 6 per Activity Type --}}
  @foreach($topUsersPerActivity as $type => $data)
    <h2 class="text-lg font-semibold mt-8 mb-4 text-center">
      Top 6 {{ $type }} {{ __('dashboardIndex.points') }}
    </h2>
    <div id="chart-{{ \Illuminate\Support\Str::slug($type) }}" class="w-full h-[420px]"></div>
  @endforeach

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailyOptions = {
      chart: {
        type: 'area',
        height: 420,
        toolbar: { show: false }
      },
      colors: ['#0b292b', '#F1D6AB', '#00A896', '#F67280', '#E67E22', '#355C7D'],
      dataLabels: { enabled: false },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      series: [
        {
          name: 'OA',
          data: {!! json_encode($oaData) !!}
        },
        {
          name: 'OV',
          data: {!! json_encode($ovData) !!}
        },
        {
          name: 'Stay',
          data: {!! json_encode($stayData) !!}
        },
        {
          name: 'Vec',
          data: {!! json_encode($vecData) !!}
        },
        {
          name: 'Premier',
          data: {!! json_encode($premierData) !!}
        },
        {
          name: 'Total Room',
          data: {!! json_encode($totalRoomData) !!}
        }
      ],
      xaxis: {
        categories: {!! json_encode($dates) !!},
        labels: { style: { colors: '#555' } },
        axisBorder: { color: '#ccc' },
        axisTicks: { color: '#ccc' }
      },
      yaxis: {
        labels: { style: { colors: '#555' } },
        min: 0
      },
      legend: {
        position: 'top',
        labels: { colors: '#333' }
      },
      tooltip: {
        theme: 'light'
      },
      grid: {
        borderColor: '#eee'
      }
    };

    const dailyChart = new ApexCharts(document.querySelector("#dailyChart"), dailyOptions);
    dailyChart.render();
</script>

<script>
  const pointOptions = {
    chart: {
      type: 'bar',
      height: 420,
      toolbar: { show: false }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      }
    },
    dataLabels: { enabled: false },
    colors: ['#3498db'],
    series: [{
      name: 'Total Poin',
      data: {!! json_encode($totalPointsPerUser->pluck('total')) !!}
    }],
    xaxis: {
      categories: {!! json_encode($totalPointsPerUser->pluck('nama')) !!},
      labels: { style: { colors: '#555' } }
    },
    yaxis: {
      labels: { style: { colors: '#555' } },
      min: 0
    },
    grid: {
      borderColor: '#eee'
    },
    tooltip: {
      theme: 'light'
    }
  };

  const pointChart = new ApexCharts(document.querySelector("#pointChart"), pointOptions);
  pointChart.render();
</script>

<script>
  const activityCharts = @json($topUsersPerActivity);

  Object.keys(activityCharts).forEach(function(type) {
      const users = activityCharts[type].map(item => item.nama);
      const points = activityCharts[type].map(item => parseFloat(item.total));

      const options = {
          chart: {
              type: 'bar',
              height: 420,
              toolbar: { show: false }
          },
          plotOptions: {
              bar: {
                  horizontal: false,
                  columnWidth: '55%',
                  endingShape: 'rounded'
              }
          },
          dataLabels: { enabled: false },
          colors: ['#2ecc71'],
          series: [{
              name: 'Poin',
              data: points
          }],
          xaxis: {
              categories: users,
              labels: { style: { colors: '#555' } }
          },
          yaxis: {
              labels: { style: { colors: '#555' } },
              min: 0
          },
          grid: {
              borderColor: '#eee'
          },
          tooltip: {
              theme: 'light'
          }
      };

      const chartId = "#chart-" + type.toLowerCase().replace(/\s+/g, '-');
      const chart = new ApexCharts(document.querySelector(chartId), options);
      chart.render();
  });
</script>

@endsection