@extends('admin.layouts.base')
@section('title')
    Edit Produk
@endsection
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Produk</h4>
                <form class="forms-sample" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" value="{{ old('name', $product->name) }}" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" value="{{ old('sku', $product->sku) }}" class="form-control" id="sku" name="sku" placeholder="SKU" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Produk</label>
                        <input type="text" value="{{ old('price', $product->price) }}" class="form-control" id="price" name="price" placeholder="Harga" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="sale_price">Harga Diskon</label>
                        <input type="text" value="{{ old('sale_price', $product->sale_price) }}" class="form-control" id="sale_price" name="sale_price" placeholder="Diskon" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok Produk</label>
                        <input type="text" value="{{ old('stock', $product->stock) }}" class="form-control" id="stock" name="stock" placeholder="Stok" autocomplete="off">
                    </div>
                    <div class="mt-3 rounded-md">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                        <small class="d-block text-secondary mb-2">Gambar saat ini</small>
                    </div>
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" value="{{ old('image', $product->image) }}" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status Barang</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Tersedia</option>
                            <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Ubah</button>
                    <a href="{{ url('/admin/products') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
