@extends('Dashboard.Layout.main')
@section('content')
<div class="bg-white p-8 rounded-xl shadow-2xl m-5 mx-auto max-w-4xl w-full">

    <div class="flex flex-col items-center mb-8">
        <div class="relative w-44 h-44 rounded-full overflow-hidden border-4 border-indigo-600 mb-4">
            <img src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://via.placeholder.com/150' }}" alt="Foto" class="object-cover w-full h-full">
        </div>
        <h1 class="text-3xl font-bold text-gray-800">{{ $user->nama }}</h1>
        <p class="text-indigo-500 font-semibold mt-1">{{ $user->department }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-700">
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUserShow.email') }}</p>
            <p class="text-base font-medium">{{ $user->email }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUserShow.username') }}</p>
            <p class="text-base font-medium">{{ $user->username }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUserShow.phone_number') }}</p>
            <p class="text-base font-medium">{{ $user->nomor_telp }}</p>
        </div>
        <div class="bg-slate-100 p-4 rounded-lg">
            <p class="text-xs font-semibold text-slate-500 mb-1">{{ __('dashboardUserShow.status') }}</p>
            <p class="text-base font-medium">{{ $user->status }}</p>
        </div>
        
    </div>

    <div class="flex justify-between mt-8">
        <a href="{{ route('user.index') }}" class="bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded">{{ __('dashboardUserShow.back') }}</a>
    </div>
</div>
@endsection
