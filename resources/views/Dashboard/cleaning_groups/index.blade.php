@extends('Dashboard.Layout.main')

@section('content')
  <div class="w-full max-w-screen-2xl mx-auto h-[calc(100vh-80px)] overflow-y-auto px-4 py-6">
    {{-- Alert Component --}}
    @if (session('success'))
      <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('success') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-success" aria-label="Close">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @elseif (session('error'))
      <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 mt-4 w-1/2 mx-auto"
        role="alert">
        <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <div class="ms-3 text-sm font-medium">
          {{ session('error') }}
        </div>
        <button type="button"
          class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
          data-dismiss-target="#alert-error" aria-label="Close">
          <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
    @endif
    {{-- End Alert Component --}}

    <h1 class="text-3xl font-bold mb-8 text-gray-800">
      {{ $title ?? 'Cleaning Groups' }}
    </h1>

    <div class="flex justify-end gap-4 mb-4">
      <a href="{{ route('cleaningGroups.create') }}"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
        Add Group
      </a>
      <a href="{{ route('dashboard') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5">
        Back
      </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white bg-teal-1001 uppercase text-center">
          <tr>
            <th class="px-6 py-3">No</th>
            <th class="px-6 py-3">Building Name</th>
            <th class="px-6 py-3">Description</th>
            <th class="px-6 py-3">Foto</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Created At</th>
            <th class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($groups as $group)
            <tr class="bg-white even:bg-teal-50 border-b border-gray-200 hover:bg-yellow-50 text-center">
              <td class="px-6 py-4">{{ $loop->iteration }}</td>
              <td class="px-6 py-4 font-semibold">{{ $group->building_name }}</td>
              <td class="px-6 py-4">{{ Str::limit($group->description, 40) }}</td>
              <td class="px-6 py-4">
                @if ($group->foto)
                  <img src="{{ asset('storage/' . $group->foto) }}" class="h-12 w-12 object-cover rounded mx-auto">
                @else
                  <span class="text-gray-400 italic">No image</span>
                @endif
              </td>
              <td class="px-6 py-4">
                <span
                  class="px-2 py-1 rounded text-xs font-semibold {{ $group->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                  {{ ucfirst($group->status) }}
                </span>
              </td>
              <td class="px-6 py-4">{{ $group->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 flex flex-wrap gap-2 justify-center">
                <a href="{{ route('cleaningGroups.show', $group->slug) }}"
                  class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1">
                  Show
                </a>
                <a href="{{ route('cleaningGroups.edit', $group->slug) }}"
                  class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-1">
                  Edit
                </a>
                <form action="{{ route('cleaningGroups.destroy', $group->slug) }}" method="POST" class="inline-block"
                  data-confirm="Are you sure you want to delete this group?">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-500 italic">
                No Cleaning Group found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $groups->links() }}
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
