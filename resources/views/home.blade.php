@extends('layouts.master')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-line icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Analytics Dashboard
                    <div class="page-title-subheading">Monitor your business metrics at a glance.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Products</div>
                        <div class="widget-subheading">All products in system</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $totalProducts }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Categories</div>
                        <div class="widget-subheading">Product categories</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $totalCategories }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Active Products</div>
                        <div class="widget-subheading">Products currently active</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{ $activeProducts }}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Users</div>
                        <div class="widget-subheading">Registered users</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{ $totalUsers }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">Recent Products
                    <div class="btn-actions-pane-right">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">View All</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProducts as $product)
                            <tr>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img style="width: 50px; height: 50px; object-fit: cover;"
                                                        class="rounded"
                                                        src="{{ asset('images/' . $product->image) }}"
                                                        alt="{{ $product->name }}">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $product->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <span class="badge {{ $product->status ? 'badge-success' : 'badge-warning' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">Recent Categories
                    <div class="btn-actions-pane-right">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm">View All</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Products</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentCategories as $category)
                            <tr>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img style="width: 50px; height: 50px; object-fit: cover;"
                                                        class="rounded"
                                                        src="{{ asset('images/' . $category->image) }}"
                                                        alt="{{ $category->name }}">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $category->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $category->products->count() }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Product Status Distribution</div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-success font-weight-bold">Active Products:</span>
                                <h2>{{ $activeProducts }}</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-warning font-weight-bold">Inactive Products:</span>
                                <h2>{{ $inactiveProducts }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="progress">
                        @php
                            $activePercentage = $totalProducts > 0 ? ($activeProducts / $totalProducts) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $activePercentage }}%"
                             aria-valuenow="{{ $activePercentage }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ round($activePercentage) }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">Products by Category Distribution</div>
                <div class="card-body">
                    <canvas id="categoryPieChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">Monthly Products Added ({{ date('Y') }})</div>
                <div class="card-body">
                    <canvas id="monthlyLineChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Top 5 Most Expensive Products</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Price Bar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topProducts as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/' . $product->image) }}" 
                                                 alt="{{ $product->name }}"
                                                 style="width: 40px; height: 40px; object-fit: cover;"
                                                 class="rounded mr-2">
                                            <span>{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" 
                                                 role="progressbar" 
                                                 style="width: {{ ($product->price / $topProducts->max('price')) * 100 }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Category Pie Chart
    const categoryCtx = document.getElementById('categoryPieChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($productsByCategory->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($productsByCategory->pluck('products_count')) !!},
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            cutout: '60%'
        }
    });

    // Monthly Line Chart
    const monthlyCtx = document.getElementById('monthlyLineChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Products Added',
                data: {!! json_encode(array_values($chartData)) !!},
                borderColor: '#4e73df',
                tension: 0.3,
                fill: true,
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
