@extends('admin.layouts.base')

@section('title')
    Dashboard
@endsection

@section('styles')
    <style>
        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .dashboard-header p {
            color: #adb5bd;
            margin: 0;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 1.5rem;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .stats-card.revenue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stats-card.orders {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-card.sold {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stats-card.traffic {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stats-label {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-change {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .stats-change.positive {
            color: #d4edda;
        }

        .stats-change.negative {
            color: #f8d7da;
        }

        .chart-card {
            background: #2d3748;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #4a5568;
        }

        .chart-card h3 {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .products-card {
            background: #2d3748;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #4a5568;
            height: 100%;
        }

        .products-card h3 {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #4a5568;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .product-image {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            background: #4a5568;
        }

        .product-name {
            color: #fff;
            font-weight: 500;
        }

        .product-sold {
            color: #adb5bd;
            font-size: 0.875rem;
        }

        .orders-card {
            background: #2d3748;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #4a5568;
            margin-top: 2rem;
        }

        .orders-card h3 {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .orders-subtitle {
            color: #adb5bd;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #4a5568;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-info h5 {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .order-details {
            color: #adb5bd;
            font-size: 0.875rem;
        }

        .order-price {
            color: #fff;
            font-size: 1.125rem;
            font-weight: 600;
        }
    </style>
@endsection
@section('content')
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Selamat datang, {{ Auth::user()->name }} dihalaman admin SneakerStore</p>
    </div>


    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card revenue">
                <div class="stats-label">Total Pendapatan</div>
                <div class="stats-value">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div class="stats-change positive">+12% from last month</div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card orders">
                <div class="stats-label">Total Orders</div>
                <div class="stats-value">{{ number_format($totalOrders, 0, ',', '.') }}</div>
                <div class="stats-change positive">+8.2% from last month</div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card sold">
                <div class="stats-label">Sepatu Terjual</div>
                <div class="stats-value">{{ number_format($totalSold, 0, ',', '.') }}</div>
                <div class="stats-change positive">+8.2% from last month</div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card traffic">
                <div class="stats-label">Trafik Penjualan</div>
                <div class="stats-value">{{ number_format($trafficGrowth, 1) }}%</div>
                <div class="stats-change {{ $trafficGrowth >= 0 ? 'positive' : 'negative' }}">
                    {{ $trafficGrowth >= 0 ? '+' : '' }}{{ number_format($trafficGrowth, 1) }}% from last month
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h4 class="card-title">Sales Overview</h4>
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4  grid-margin stretch-card">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h3>Top Selling Products</h3>
                    @forelse($topProducts as $product)
                        <div class="product-item">
                            <div class="product-info">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                        alt="{{ $product->name }}" class="product-image">
                                @else
                                    <div class="product-image"></div>
                                @endif
                                <div>
                                    <div class="product-name">{{ Str::limit($product->name, 20) }}</div>
                                    <div class="product-sold">{{ $product->total_sold ?? 0 }} terjual</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada produk terjual</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h4 class="card-title">Recent Orders</h4>
                    @foreach ($recentOrders as $order)
                        <div class="order-item">
                            <div class="order-info">
                                <h5>{{ $order->user->name ?? 'Guest' }}</h5>
                                <div class="order-details">
                                    #{{ $order->order_number }} •
                                    {{ $order->items->pluck('product.name')->implode(', ') }}
                                </div>
                            </div>
                            <div class="order-price">
                                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Sales Chart
        const ctx = document.getElementById('salesChart');

        const salesData = @json($salesChart);

        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const labels = salesData.map(item => monthNames[item.month - 1]);
        const data = salesData.map(item => item.total);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: data,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#fff',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#adb5bd',
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: '#4a5568'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#adb5bd'
                        },
                        grid: {
                            color: '#4a5568'
                        }
                    }
                }
            }
        });
    </script>
@endsection


{{-- @push('scripts')
  
@endpush --}}
