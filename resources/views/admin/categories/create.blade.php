@extends('admin.layouts.base')
@section('title')
    Tambah Kategori
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Kategori</h4>
                    <form class="forms-sample" action="{{ route('admin.categories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="ADMIN" id="role" name="role">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" value="{{ old('name') }}" class="form-control" id="name"
                                name="name" placeholder="Nama" autocomplete="off">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                        <a href="{{ url('/admin/categories') }}" class="btn btn-dark">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
