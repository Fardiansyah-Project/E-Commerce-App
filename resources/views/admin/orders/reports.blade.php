@extends('admin.layouts.base')
@extends('admin.layouts.head')

@section('title')
    Laporan Order 
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Laporan Pesanan Selesai</h4>
                        <div class="col-md-3 d-flex" style="gap: 10px">
                            <a href="{{ route('admin.orders.export.excel', request()->query()) }}" class="btn btn-success">
                                <i class="mdi mdi-file-excel"></i> Export Excel
                            </a>

                            <a href="{{ route('admin.orders.export.pdf') }}" class="btn btn-danger">
                                <i class="mdi mdi-file-pdf"></i> Export PDF
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.orders.reports') }}" method="GET" class="row g-2 mb-4">
                        <div class="col-md-3">
                            <label>Dari Tanggal</label>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ request('start_date') }}">
                        </div>

                        <div class="col-md-3">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>

                        <div class="col-md-3 align-self-end">
                            <button class="btn btn-primary">
                                <i class="mdi mdi-filter"></i> Filter
                            </button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>No Order</th>
                                    <th>Total</th>
                                    <th>Alamat</th>
                                    <th>Metode</th>
                                    <th>Status Bayar</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->order_no }}</td>
                                        <td>Rp {{ number_format($item->total_amount) }}</td>
                                        <td>{{ $item->shipping_address }}</td>
                                        <td>{{ $item->payment_method }}</td>

                                        <td>
                                            <span class="badge badge-success">
                                                {{ $item->payment_status }}
                                            </span>
                                        </td>

                                        <td>
                                            @if ($item->payment_proof)
                                                <a href="{{ asset('storage/' . $item->payment_proof) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $item->payment_proof) }}"
                                                        width="80" class="img-thumbnail">
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            Tidak ada data laporan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $orders->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
