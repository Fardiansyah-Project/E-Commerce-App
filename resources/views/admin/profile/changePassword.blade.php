@extends('admin.layouts.base')
@section('title')
    Ganti Password
@endsection
@section('content')
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
                                <h5 class="mb-4 fw-semibold d-flex align-items-center" style="gap: 8px">
                                    <i class="mdi mdi-lock"></i> Ganti Password
                                </h5>
                                <form action="{{ route('admin.profile.change_password', Auth::user()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Password Lama</label>
                                        <input type="password" name="current_password" class="form-control bg-light text-dark" autocomplete="off">
                                        @error('current_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Password Baru</label>
                                        <input type="password" name="new_password" class="form-control bg-light text-dark" autocomplete="off">
                                        @error('new_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Konfirmasi Password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control bg-light text-dark"
                                            autocomplete="off">
                                        @error('new_password_confirmation')
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
