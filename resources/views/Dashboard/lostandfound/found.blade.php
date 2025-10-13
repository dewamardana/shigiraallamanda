@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">📦 Dashboard Lost & Found</h1>

    {{-- Filter --}}
    <div class="mb-6">
      <form action="{{ route('founditem') }}" method="GET" class="grid sm:flex sm:flex-wrap sm:items-end gap-4">
        {{-- Start Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="start_date" name="start_date" type="date" value="{{ request('start_date') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[180px] ps-10 p-2.5"
            placeholder="Start Date">
        </div>

        {{-- End Date --}}
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <i data-feather="calendar" class="w-4 h-4 text-accent-1000"></i>
          </div>
          <input id="end_date" name="end_date" type="date" value="{{ request('end_date') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[180px] ps-10 p-2.5"
            placeholder="End Date">
        </div>

        {{-- User --}}
        <div class="w-full sm:w-auto">
          <label for="user_id" class="block mb-1 text-sm font-medium text-gray-900">Ditemukan Oleh</label>
          <select id="user_id" name="user_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-[200px] p-2.5">
            <option value="">Semua</option>
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
          Filter
        </button>

        {{-- Reset Button --}}
        <a href="{{ route('founditem') }}">
          <button type="button"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-sm text-sm px-5 py-2.5">
            Reset
          </button>
        </a>
      </form>
    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white bg-teal-1001 uppercase text-center">
          <tr>
            <th class="border border-gray-300 px-4 py-3 text-center">Tanggal</th>
            <th class="border border-gray-300 px-4 py-3 text-center">Nama Barang</th>
            <th class="border border-gray-300 px-4 py-3 text-center">Lokasi</th>
            <th class="border border-gray-300 px-4 py-3 text-center">Deskripsi</th>
            <th class="border border-gray-300 px-4 py-3 text-center">Status</th>
            <th class="border border-gray-300 px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($foundItems as $item)
            <tr class="bg-white even:bg-teal-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
              <td class="px-6 py-4">{{ $item->date->format('d M Y') }}</td>
              <td class="px-6 py-4">{{ $item->name }}</td>
              <td class="px-6 py-4">{{ $item->location }}</td>
              <td class="px-6 py-4">{{ Str::limit($item->description, 50) }}</td>

              <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">
                  @if ($item->status == 0)
                    Belum Diambil
                  @else
                    Sudah Diambil
                  @endif
                </span>
              </td>

              <td class="px-6 py-4">
                <div class="flex justify-center items-center gap-2">
                  <a href="{{ route('lostitem.show', $item->id) }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none">
                    Detail
                  </a>
                  <form action="{{ route('lostitem.destroy', $item->id) }}" method="POST" class="inline-block"
                    data-confirm="Yakin ingin menghapus data ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-gray-500 py-6">Tidak ada data ditemukan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $foundItems->links() }}
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('form[data-confirm]').forEach(form => {
        form.addEventListener('submit', e => {
          if (!confirm(form.getAttribute('data-confirm'))) e.preventDefault();
        });
      });
    });
  </script>
@endsection
