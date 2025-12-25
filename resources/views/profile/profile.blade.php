@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10 max-w-4xl">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white">
            <h1 class="text-2xl font-bold">Profil Saya</h1>
            <p class="text-sm opacity-90">Informasi akun pengguna</p>
        </div>

        <!-- Content -->
        <div class="p-6 sm:p-8">
            <div class="flex flex-col md:flex-row items-center gap-6">

                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <img
                        src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500"
                        alt="Avatar"
                    >
                </div>

                <!-- User Info -->
                <div class="flex-1 space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Bergabung Sejak</p>
                        <p class="text-gray-800">
                            {{ auth()->user()->created_at->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex gap-3">
                <a href="{{ route('profile.edit', $user->id) }}"
                   class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                    <i class="fas fa-user-edit mr-2"></i> Edit Profil
                </a>

                <a href="{{ url('/') }}"
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition font-medium">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
