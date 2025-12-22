@extends('Homepage.Layout.main')

@section('content')
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Judul Halaman -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-extrabold text-teal-900 mb-2">
        Pilih Cleaning Group
      </h1>
      <p class="text-slate-600 text-sm sm:text-base">
        Silakan pilih gedung atau area untuk melihat daftar ruang dan aktivitas cleaning.
      </p>
    </div>

    <!-- Grid Daftar Group -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse ($groups as $group)
        <a href="{{ route('roomTracker', $group->slug) }}"
          class="block group transition-transform transform hover:-translate-y-1">
          <div
            class="bg-white rounded-xl border border-teal-200 shadow-md hover:shadow-xl hover:border-teal-400 transition-all duration-300 p-6 flex flex-col justify-between h-full">

            <!-- Header Kartu -->
            <div class="flex items-center justify-center mb-4">
              <div class="flex items-center justify-center w-12 h-12 bg-teal-100 rounded-full shadow-inner">
                @if ($group->foto)
                  <img src="{{ asset('storage/' . $group->foto) }}" class="h-12 w-12 object-cover rounded mx-auto">
                @else
                  <i data-feather="map-pin" class="w-6 h-6 text-teal-700"></i>
                @endif
              </div>
            </div>

            <!-- Isi -->
            <div class="text-center">
              <h2 class="text-lg font-semibold text-teal-900 group-hover:text-teal-700 transition-colors">
                {{ $group->building_name }}
              </h2>
              <p class="text-sm text-slate-500 mt-2">
                {{ $group->description }}
              </p>
            </div>

            <!-- Tombol Lihat -->
            <div class="mt-5 mx-auto">
              <span
                class="inline-block bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium rounded-md py-2 transition px-4">
                Lihat Ruangan
              </span>
            </div>
          </div>
        </a>
      @empty
        <div class="col-span-full text-center py-8 bg-white border border-slate-200 rounded-xl shadow">
          <i data-feather="info" class="mx-auto w-10 h-10 text-slate-400 mb-3"></i>
          <p class="text-slate-600">{{ __('homepageGroup.no_group') ?? 'Belum ada group yang tersedia.' }}</p>
        </div>
      @endforelse
    </div>
  </div>

  @push('script')
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        feather.replace();
      });
    </script>
  @endpush
@endsection
