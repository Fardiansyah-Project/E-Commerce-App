@extends('admin.layouts.base')
@extends('admin.layouts.head')
@section('title')
    Order
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Order</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th> Nama Pengguna </th>
                                <th> Nomor Pesanan </th>
                                <th> Total Pembayaran</th>
                                <th> Alamat Pengantaran </th>
                                <th> Metode Pembayaran</th>
                                <th> Status Pembayaran</th>
                                <th> Status </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item->user->name }}
                                    </td>
                                    <td>
                                        {{ $item->order_no }}
                                    </td>
                                    <td>
                                        {{ $item->total_amount }}
                                    </td>
                                    <td>
                                        {{ $item->shipping_address }}
                                    </td>
                                    <td>
                                        {{ $item->payment_method }}
                                    </td>
                                    <td>
                                        {{ $item->payment_status }}
                                    </td>
                                    <td>
                                        {{ $item->status }}
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.orders.edit_status', $item->id) }}"
                                            class="btn btn-sm btn-warning mr-2">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteProduct({{ $item->id }})">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Belum ada pesana selesai saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
