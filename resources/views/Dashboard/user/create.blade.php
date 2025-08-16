@extends('Dashboard.Layout.main')

@section('content')
<div class="bg-white p-5 rounded-xl shadow-2xl m-5 mx-auto max-w-5xl w-full">
    <h2 class="font-bold text-4xl text-center text-black-500 mb-8">{{ __('dashboardUserCreate.title') }}</h2>
    <form action="/dashboard/user" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col md:flex-row gap-8 justify-center p-6">

            {{-- Foto --}}
            <div class="w-full md:max-w-xs">
                <h6 class="mb-2 text-lg font-semibold text-center">{{ __('dashboardUserCreate.profile_photo') }}</h6>
                <p class="text-xs text-slate-500 mb-6 text-center">{{ __('dashboardUserCreate.photo_hint') }}</p>
                <div class="relative w-40 h-40 rounded-full overflow-hidden mb-6 border-2 border-indigo-600 group cursor-pointer block mx-auto">
                    <img id="preview-foto" src="https://via.placeholder.com/150" class="object-cover w-full h-full">
                    <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                        <i class="fas fa-edit text-white text-2xl"></i>
                    </div>
                </div>
                <label class="block mb-2 text-sm font-medium text-teal-1001" for="foto">Upload file</label>
                <input type="file" name="foto" id="foto" accept="image/*"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-teal-1001 file:text-white hover:file:bg-teal-1000"/>
                    <p class="mt-1 text-sm text-teal-1001" id="foto">SVG, PNG, JPG or GIF (Ratio 1:1).</p>
                @error('foto')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
          
            {{-- Form Input --}}
            <div class="w-full space-y-5">
                {{-- Nama --}}
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUserCreate.name') }}</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('dashboardUserCreate.name_placeholder') }}" required />
                    @error('nama')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- username --}}
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUserCreate.username') }}</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('dashboardUserCreate.username_placeholder') }}" required />
                    @error('username')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUserCreate.email') }}</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('dashboardUserCreate.email_placeholder') }}" required />
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label for="nomor_telp" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUserCreate.phone_number') }}</label>
                    <input type="text" name="nomor_telp" id="nomor_telp" value="{{ old('nomor_telp') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('dashboardUserCreate.phone_placeholder') }}" required />
                    @error('nomor_telp')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Department --}}
                <div>
                    <label for="department" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUserCreate.department') }}</label>
                    <input type="text" name="department" id="department" value="{{ old('department') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('dashboardUserCreate.department_placeholder') }}" required />
                    @error('department')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gender --}}
                <div>
                    <label class="block text-sm font-medium text-teal-1001 mb-2">{{ __('dashboardUserCreate.gender') }}</label>
                    <div class="flex items-center gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="L" {{ old('gender') == 'L' ? 'checked' : '' }}
                                class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                            <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUserCreate.male') }}</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="P" {{ old('gender') == 'P' ? 'checked' : '' }}
                                class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                            <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUserCreate.female') }}</span>
                        </label>
                    </div>
                    @error('gender')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-teal-1001 mb-2">{{ __('dashboardUserCreate.status') }}</label>
                    <div class="flex items-center gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="Active" {{ old('status') == 'Active' ? 'checked' : '' }}
                                class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                            <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUserCreate.active') }}</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="Inactive" {{ old('status') == 'Inactive' ? 'checked' : '' }}
                                class="w-4 h-4 text-teal-1001 bg-gray-100 border-gray-300 focus:ring-teal-1001 focus:ring-2">
                            <span class="ml-2 text-sm text-teal-1001">{{ __('dashboardUserCreate.inactive') }}</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
 
                {{-- Password --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-teal-1001">{{ __('dashboardUserCreate.password') }}</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" value="{{ old('password') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('dashboardUserCreate.password_placeholder') }}" required />
                  
                      <!-- Tombol Show/Hide -->
                      <button type="button" onclick="togglePassword()" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-indigo-600">
                        <i data-feather="eye" id="toggleIcon"></i>
                      </button>
                    </div>
                  
                    @error('password')
                      <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center gap-4 mt-6">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5">
                        {{ __('dashboardUserCreate.add_worker') }}
                    </button>

                    <a href="{{ route('user.index') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('dashboardUserCreate.back') }}
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
