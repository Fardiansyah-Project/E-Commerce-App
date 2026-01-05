<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersReportExport implements FromCollection,  WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function collection()
    {
        return Order::with('user')
            ->where('status', 'COMPLETED')
            ->when($this->startDate, function ($q) {
                $q->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($q) {
                $q->whereDate('created_at', '<=', $this->endDate);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No Order',
            'Nama User',
            'Total Pembayaran',
            'Metode Pembayaran',
            'Status Pembayaran',
            'Tanggal'
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_no,
            $order->user->name,
            $order->total_amount,
            $order->payment_method,
            $order->payment_status,
            $order->created_at->format('d-m-Y'),
        ];
    }
}
