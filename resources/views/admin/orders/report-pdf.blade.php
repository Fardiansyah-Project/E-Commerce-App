<!DOCTYPE html>
<html>

<head>
    <title>Laporan Order Selesai</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h3 align="center">Laporan Order Selesai</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Order</th>
                <th>Nama User</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Status Bayar</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp {{ number_format($order->total_amount) }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Tidak ada data laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
