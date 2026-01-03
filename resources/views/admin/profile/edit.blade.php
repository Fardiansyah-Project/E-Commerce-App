@extends('admin.layouts.base')
@section('title')
    Edit Profile
@endsection
@section('content')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Profile</h4>
                    <form action="{{ route('admin.profile.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="image" name="image"
                                value="{{ Auth::user()->image }}">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center border-end">
                                <div class="mb-3">
                                    <img src="{{ Auth::user()->image
                                        ? asset('storage/images/profile/' . Auth::user()->image)
                                        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=4e73df&color=fff&size=256' }}"
                                        class="rounded-circle img-fluid shadow"
                                        style="width: 160px; height: 160px; object-fit: cover;" alt="Admin Profile">
                                </div>

                                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                                <span class="badge bg-primary mb-2">Administrator</span>

                                <p class="text-muted small">
                                    Terdaftar sejak <br>
                                    <strong>{{ Auth::user()->created_at->format('d M Y') }}</strong>
                                </p>
                            </div>

                            <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                                <h5 class="mb-4 fw-semibold">
                                    <i class="mdi mdi-account-circle-outline"></i> Edit Informasi Admin
                                </h5>
                                <form action="{{ route('admin.profile.update', Auth::user()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control bg-light text-dark"
                                            value="{{ Auth::user()->name }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Email</label>
                                        <input type="email" name="email" class="form-control bg-light text-dark"
                                            value="{{ Auth::user()->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Foto Profil</label>
                                        <input type="file" name="image" class="form-control bg-light text-dark" id="image"
                                            name="image" value="{{ Auth::user()->image }}">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex mt-4" style="gap: 10px">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save-all"></i> Simpan
                                        </button>
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light ">
                                            <i class="mdi mdi-arrow-left"></i> Kembali
                                        </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
