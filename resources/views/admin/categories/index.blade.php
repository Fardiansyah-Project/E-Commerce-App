@extends('admin.layouts.base')
@section('title')
    Kategori Produk
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header d-flex justify-content-between py-auto my-auto">
                    <h4 class="card-title">Data Kategori Produk</h4>
                    <div class="ml-auto w-auto">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">Tambah Kategori</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nama </th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-warning mr-2">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.destroy', $category->id) }}"
                                               data-confirm-delete="true" class="btn btn-sm btn-danger">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-muted text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $categories->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
