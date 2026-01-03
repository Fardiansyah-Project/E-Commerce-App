@extends('admin.layouts.base')
@section('title')
    Edit Kategori
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Kategori</h4>
                    <form class="forms-sample" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="ADMIN" id="role" name="role">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" value="{{ old('name', $category->name) }}" class="form-control"
                                id="name" name="name" placeholder="Nama" autocomplete="off">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button id="btn-loading" type="submit" class="btn btn-primary mr-2">
                            <span id="loading" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            Simpan
                        </button>
                        <a href="{{ url('/admin/categories') }}" class="btn btn-dark">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#loading').hide();
            $('#form-ajax').submit(function(e) {
                $('#loading').show();
                $('#btn-loading').html('Loading...')
                e.preventDefault();
            });
        });
    </script>
@endsection
