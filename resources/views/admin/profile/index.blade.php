@extends('admin.layouts.base')
@section('title', 'Admin Profile')
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
                                <h5 class="mb-4 fw-semibold">
                                    <i class="mdi mdi-account-circle-outline"></i> Informasi Admin
                                </h5>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Nama Lengkap</label>
                                    <div class="form-control bg-light">
                                        <p class="text-dark">
                                            {{ Auth::user()->name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Email</label>
                                    <div class="form-control bg-light">
                                        <p class="text-dark">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted">Role</label>
                                    <div class="form-control bg-light">
                                        <p class="text-dark">
                                            {{ Auth::user()->role }}
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex mt-4" style="gap: 10px">
                                    <a href="{{ route('admin.profile.edit', Auth::user()->id) }}" class="btn btn-primary">
                                        <i class="mdi mdi-pencil"></i> Edit Profile
                                    </a>

                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light ">
                                        <i class="mdi mdi-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
