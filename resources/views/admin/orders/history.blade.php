@extends('admin.layouts.base')
@extends('admin.layouts.head')
@section('title')
    Order
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="gap-3">
                        <h4 class="card-title">Data Order</h4>
                        {{-- <select name="paginate" id="paginate" class="form-control w-auto">
                            <option value="">Pilih baris data</option>
                            <option value="5" {{ request('paginate') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('paginate') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('paginate') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('paginate') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('paginate') == 100 ? 'selected' : '' }}>100</option>
                        </select> --}}
                        <form method="GET" action="{{ route('admin.orders.history') }}" id="paginateForm">
                            <select name="paginate" id="paginate" class="form-control w-auto">
                                <option value="">Pilih baris data</option>
                                <option value="5" {{ request('paginate') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('paginate') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('paginate') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('paginate') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('paginate') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>

                    </div>
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
                                    <th> Bukti Transfer</th>
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
                                            @if ($item->payment_proof)
                                                <a href="{{ asset('storage/' . $item->payment_proof) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $item->payment_proof) }}"
                                                        alt="Bukti Pembayaran" width="100">
                                                </a>
                                            @else
                                                -
                                            @endif
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
                                            <a href="{{ route('admin.orders.destroy', $item->id) }}"
                                                class="btn btn-sm btn-danger" data-confirm-delete="true">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                            {{-- <form action="{{ route('admin.orders.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="deleteProduct({{ $item->id }})"  >
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-muted text-center">Tidak ada riwayat pesanan saat ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $orders->appends(['paginate' => request('paginate')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('paginate').addEventListener('change', function() {
            document.getElementById('paginateForm').submit();
        });
    </script>
@endsection
