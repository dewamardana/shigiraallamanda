@extends('Homepage.Layout.main')

@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">Profile</h2>

    {{-- Foto dan Nama --}}
    <div class="flex flex-col items-center mb-8">
      <div class="relative w-44 h-44 rounded-full overflow-hidden border-4 border-indigo-600 mb-4">
        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://via.placeholder.com/150' }}" alt="Foto"
          class="object-cover w-full h-full">
      </div>
      <h1 class="text-3xl font-bold text-gray-800">{{ $user->nama }}</h1>
      <p class="text-indigo-500 font-semibold mt-1">{{ $user->department }}</p>
    </div>

    {{-- Detail User --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-700">
      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUser.form.email') }}</p>
        <p class="text-base font-medium">{{ $user->email }}</p>
      </div>
      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUser.form.username') }}</p>
        <p class="text-base font-medium">{{ $user->username }}</p>
      </div>
      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUser.form.phone_number') }}</p>
        <p class="text-base font-medium">{{ $user->nomor_telp }}</p>
      </div>
      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUser.form.status') }}</p>
        <p class="text-base font-medium">{{ $user->status }}</p>
      </div>
      <div class="bg-slate-100 p-4 rounded-lg">
        <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUser.form.gender') }}</p>
        <p class="text-base font-medium">
          {{ $user->gender == 'L' ? __('dashboardUser.form.male') : __('dashboardUser.form.female') }}
        </p>
      </div>
    </div>

    {{-- Skills --}}
    <div class="mt-6">
      <p class="text-xs font-semibold text-slate-500 mb-2">{{ __('dashboardUser.form.skill') }}</p>
      <div class="flex flex-wrap gap-2">
        @forelse($user->skills as $skill)
          <span class="px-3 py-1 bg-teal-600 text-white rounded-full text-sm">
            {{ $skill->name }}
          </span>
        @empty
          <span class="text-slate-400 text-sm">-</span>
        @endforelse
      </div>
    </div>

    {{-- Tombol Back --}}
    <div class="flex justify-end mt-8">
      <a href="{{ route('homepage') }}"
        class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center me-2 mb-2">
        {{ __('button.back') }}
      </a>
    </div>
  </div>

  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full mb-20">
    <form method="GET" action="/dashboard" class="flex gap-4 items-center mb-6">

      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-start" name="start_date" value="{{ request('start_date') }}" datepicker datepicker-autohide
          datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text" value="{{ old('date') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
          placeholder="{{ __('dashboardIndex.start_date') }}">
      </div>

      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <i data-feather="calendar" class="w-4 y-4 text-accent-1000"></i>
        </div>
        <input id="datepicker-end" name="end_date" value="{{ request('end_date') }}" datepicker datepicker-autohide
          datepicker-autoselect-today datepicker-format="dd/mm/yyyy" type="text" value="{{ old('date') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
          placeholder="{{ __('dashboardIndex.end_date') }}">
      </div>

      <button type="submit"
        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center me-2 mb-2">
        {{ __('button.filter') }}</button>

      <a href="{{ route('homepage') }}">
        <button type="button"
          class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2">{{ __('button.reset') }}</button>
      </a>
    </form>


    <h2 class="text-xl font-semibold my-5 text-center">{{ __('dashboardIndex.daily_stat') }}</h2>
    <div id="dailyChart" class="w-full h-[420px]"></div>

    <h2 class="text-xl font-semibold mb-4 text-center">{{ __('dashboardIndex.total_point') }}</h2>
    <div id="pointChart" class="w-full h-[420px]"></div>
    <h2 class="text-xl font-semibold mb-4 text-center">{{ __('dashboardIndex.total_point') }}</h2>

    {{-- Tambahan: Top 6 per Activity Type --}}
    @foreach ($topUsersPerActivity as $type => $data)
      <h2 class="text-lg font-semibold mt-8 mb-4 text-center">
        Top 6 {{ $type }} {{ __('dashboardIndex.points') }}
      </h2>
      <div id="chart-{{ \Illuminate\Support\Str::slug($type) }}" class="w-full h-[420px]"></div>
    @endforeach
  </div>
@endsection

@section('script')
  <script>
    document.getElementById('foto').addEventListener('change', function(event) {
      const [file] = event.target.files;
      if (file) {
        document.getElementById('preview-foto').src = URL.createObjectURL(file);
      }
    });

    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.setAttribute('data-feather', 'eye-off');
      } else {
        passwordInput.type = 'password';
        icon.setAttribute('data-feather', 'eye');
      }

      feather.replace(); // refresh icon feather
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const dailyOptions = {
      chart: {
        type: 'area',
        height: 420,
        toolbar: {
          show: false
        }
      },
      colors: ['#0b292b', '#F1D6AB', '#00A896', '#F67280', '#E67E22', '#355C7D'],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      series: [{
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
        labels: {
          style: {
            colors: '#555'
          }
        },
        axisBorder: {
          color: '#ccc'
        },
        axisTicks: {
          color: '#ccc'
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: '#555'
          }
        },
        min: 0
      },
      legend: {
        position: 'top',
        labels: {
          colors: '#333'
        }
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
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        }
      },
      dataLabels: {
        enabled: false
      },
      colors: ['#3498db'],
      series: [{
        name: 'Total Poin',
        data: {!! json_encode($totalPointsPerUser->pluck('total')) !!}
      }],
      xaxis: {
        categories: {!! json_encode($totalPointsPerUser->pluck('nama')) !!},
        labels: {
          style: {
            colors: '#555'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: '#555'
          }
        },
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
          toolbar: {
            show: false
          }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          }
        },
        dataLabels: {
          enabled: false
        },
        colors: ['#2ecc71'],
        series: [{
          name: 'Poin',
          data: points
        }],
        xaxis: {
          categories: users,
          labels: {
            style: {
              colors: '#555'
            }
          }
        },
        yaxis: {
          labels: {
            style: {
              colors: '#555'
            }
          },
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
