@extends('admin.layouts.base')
@section('title')
    Tambah Produk
@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Pesanan</h4>
                <form class="forms-sample" action="{{ route('admin.orders.update_status', $order->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="status">Status Barang</label>
                        <select name="status" id="status" class="form-control">
                            <option value="PENDING" {{ $order->status == 'PENDING' ? 'selected' : '' }}>Pending</option>
                            <option value="PROCESSING" {{ $order->status == 'PROCESSING' ? 'selected' : '' }}>Proses</option>
                            <option value="CANCELLED" {{ $order->status == 'CANCELLED' ? 'selected' : '' }}>Dibatalkan
                            </option>
                            <option value="COMPLETED" {{ $order->status == 'COMPLETED' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Ubah</button>
                    <a href="{{ url('/admin/orders/success') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
