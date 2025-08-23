@extends('Dashboard.Layout.main')
@section('content')
  <div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardUser.edit.title') }}</h2>
    <form action="/dashboard/user/{{ $user->slug }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="flex flex-col md:flex-row gap-8 justify-center p-6">

        {{-- Foto --}}
        <div class="w-full md:max-w-xs">
          <h6 class="mb-2 text-lg font-semibold text-center">{{ __('dashboardUser.form.profile_photo') }}</h6>
          <p class="text-xs text-slate-500 mb-6 text-center">{{ __('dashboardUser.form.photo_hint') }}</p>
          <div
            class="relative w-40 h-40 rounded-full overflow-hidden mb-6 border-2 border-indigo-600 group cursor-pointer block mx-auto">
            <img id="preview-foto"
              src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://via.placeholder.com/150' }}" alt=""
              class="object-cover w-full h-full">
            <div
              class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
              <i class="fas fa-edit text-white text-2xl"></i>
            </div>
          </div>
          <label class="block mb-2 text-sm font-medium text-teal-1001"
            for="foto">{{ __('dashboardUser.form.photo_upload') }}</label>
          <input type="file" name="foto" id="foto" accept="image/*"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-teal-1001 file:text-white hover:file:bg-teal-1000" />
          <p class="mt-1 text-sm text-teal-1001" id="foto">{{ __('dashboardUser.form.upload_hint') }}</p>
          @error('foto')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Form Input --}}
        <div class="w-full space-y-5">

          <div>
            <label for="nama"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.name') }}</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="{{ __('dashboardUser.form.name_placeholder') }}" required />
            @error('nama')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="username"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.username') }}</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="{{ __('dashboardUser.form.username_placeholder') }}" required />
            @error('username')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="email"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.email') }}</label>
            <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="{{ __('dashboardUser.form.email_placeholder') }}" required />
            @error('email')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="nomor_telp"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.phone_number') }}</label>
            <input type="text" name="nomor_telp" id="nomor_telp" value="{{ old('nomor_telp', $user->nomor_telp) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="{{ __('dashboardUser.form.phone_placeholder') }}" required />
            @error('nomor_telp')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="department"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.department') }}</label>
            <input type="text" name="department" id="department" value="{{ old('department', $user->department) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="{{ __('dashboardUser.form.department_placeholder') }}" required />
            @error('department')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-teal-1001 mb-2">{{ __('dashboardUser.form.gender') }}</label>
            <div class="flex items-center gap-6">
              <label class="inline-flex items-center">
                <input type="radio" name="gender" value="L"
                  {{ old('gender', $user->gender) == 'L' ? 'checked' : '' }}
                  class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUser.form.male') }}</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="gender" value="P"
                  {{ old('gender', $user->gender) == 'P' ? 'checked' : '' }}
                  class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUser.form.female') }}</span>
              </label>
            </div>
            @error('gender')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-teal-1001 mb-2">{{ __('dashboardUser.form.status') }}</label>
            <div class="flex items-center gap-6">
              <label class="inline-flex items-center">
                <input type="radio" name="status" value="Active"
                  {{ old('status', $user->status) == 'Active' ? 'checked' : '' }}
                  class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUser.form.active') }}</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="status" value="Inactive"
                  {{ old('status', $user->status) == 'Inactive' ? 'checked' : '' }}
                  class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUser.form.inactive') }}</span>
              </label>
            </div>
            @error('status')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Roles --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.role') }}</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              @foreach ($roles as $role)
                <div class="flex items-center">
                  <input id="role-{{ $role->id }}" type="checkbox" name="roles[]" value="{{ $role->id }}"
                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                  <label for="role-{{ $role->id }}" class="ms-2 font-medium text-teal-1001">
                    {{ $role->name }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          {{-- Skills --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.skill') }}</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              @foreach ($skills as $skill)
                <div class="flex items-center">
                  <input id="skill-{{ $skill->id }}" type="checkbox" name="skills[]" value="{{ $skill->id }}"
                    {{ $user->skills->contains($skill->id) ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                  <label for="skill-{{ $skill->id }}" class="ms-2 font-medium text-teal-1001">
                    {{ $skill->name }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>


          <div>
            <label for="password"
              class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUser.form.password') }}</label>
            <div class="relative">
              <input type="password" name="password" id="password" value="{{ old('password') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="{{ __('dashboardUser.form.password_placeholder') }}" />

              <!-- Tombol Show/Hide -->
              <button type="button" onclick="togglePassword()"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-indigo-600">
                <i data-feather="eye" id="toggleIcon"></i>
              </button>
              <p class="text-sm text-red-600 mt-1">* {{ __('dashboardUser.form.password_hint') }}</p>
            </div>

            @error('password')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="flex justify-center gap-4 mt-6">
            <button type="submit"
              class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-6 py-2.5">
              {{ __('button.edit') }}
            </button>

            <a href="{{ route('user.index') }}"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 focus:outline-none">
              {{ __('button.back') }}
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
@section('scripts')
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
@endsection
