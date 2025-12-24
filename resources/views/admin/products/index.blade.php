@extends('admin.layouts.base')
@section('title')
    Produk
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-header d-flex justify-content-between py-auto my-auto">
                <h4 class="card-title">Data Produk</h4>
                <div class="ml-auto w-auto">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">Tambah Produk</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama Produk </th>
                                <th> SKU </th>
                                <th>Slug</th>
                                <th> Harga </th>
                                <th>Foto</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ asset('storage/images/products/' . $product->image) }}" target="_blank">
                                            <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                                alt="{{ $product->name }}" width="100">
                                        </a>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-warning mr-2">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteProduct({{ $product->id }})">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-muted text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
