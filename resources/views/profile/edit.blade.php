@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-5 py-6 sm:py-10 max-w-4xl">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white">
                <h1 class="text-2xl font-bold">Edit Profil</h1>
                <p class="text-sm opacity-90">Perbarui informasi akun Anda</p>
            </div>

            <!-- Form -->
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')
                <!-- Avatar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        @if (!empty($user->avatar))
                            <img src="{{ asset('storage/images/profile/' . $user->avatar) }}"
                                class="w-20 h-20 rounded-full object-cover border">
                        @else
                            <img src="{{ 'https://ui-avatars.com/api/?name=' . $user->name }}"
                                class="w-20 h-20 rounded-full object-cover border">
                        @endif
                        <input type="file" name="avatar"
                            class="block w-full text-sm text-gray-600
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-600
                                  hover:file:bg-indigo-100">
                        @error('avatar')
                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full rounded-lg py-2 px-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full rounded-lg py-2 px-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                        class="w-full rounded-lg py-2 px-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}"
                        class="w-full rounded-lg py-2 px-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password Baru <span class="text-xs text-gray-400">(Opsional)</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full rounded-lg px-2 py-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full rounded-lg px-2 py-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('user.profile', $user->id) }}"
                        class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
