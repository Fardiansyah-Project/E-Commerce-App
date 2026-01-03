@extends('admin.layouts.base')
@section('title')
    Tambah Produk
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Produk</h4>
                    <form class="forms-sample" action="{{ route('admin.products.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" value="{{ old('name') }}" class="form-control" id="name"
                                name="name" placeholder="Name" autocomplete="off">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Produk</label>
                            <input type="text" value="{{ old('price') }}" class="form-control" id="price"
                                name="price" placeholder="Harga" autocomplete="off">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sale_price">Harga Diskon</label>
                            <input type="text" value="{{ old('sale_price') }}" class="form-control" id="sale_price"
                                name="sale_price" placeholder="Diskon" autocomplete="off">
                            @error('sale_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok Produk</label>
                            <input type="text" value="{{ old('stock') }}" class="form-control" id="stock"
                                name="stock" placeholder="Stok" autocomplete="off">
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Foto</label>
                            <input type="file" value="{{ old('image') }} " name="image" id="image"
                                class="form-control">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                        <label for="is_active">Status Barang</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div> --}}
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary mr-2">Tambah</button> --}}
                        <button id="btn-loading" class="btn btn-primary" type="submit">
                            <span id="loading" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            Simpan
                        </button>
                        <a href="{{ url('/admin/products') }}" class="btn btn-dark">Kembali</a>
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
