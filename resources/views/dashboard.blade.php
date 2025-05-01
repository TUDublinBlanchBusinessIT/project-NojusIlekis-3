@extends('layouts.app')

@section('content')
  <h1 class="mb-4">Welcome, {{ Auth::user()->name }}!</h1>

  <div class="row mb-4">
    {{-- Card 1 --}}
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Total Orders</h5>
          <p class="card-text fs-2">{{ $totalOrders }}</p>
        </div>
      </div>
    </div>

    {{-- Card 2 --}}
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5 class="card-title">Pending</h5>
          <p class="card-text fs-2">{{ $pendingOrders }}</p>
        </div>
      </div>
    </div>

    {{-- Card 3 --}}
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Total Sales</h5>
          <p class="card-text fs-2">${{ number_format($totalSales,2) }}</p>
        </div>
      </div>
    </div>

    {{-- Card 4 --}}
    <div class="col-md-3">
      <div class="card text-white bg-secondary mb-3">
        <div class="card-body">
          <h5 class="card-title">Products</h5>
          <p class="card-text fs-2">{{ $totalProducts }}</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Orders-per-day Chart --}}
  <div class="mb-5">
    <h3>Orders in the Last 7 Days</h3>
    <canvas id="ordersChart" height="100"></canvas>
  </div>

  {{-- Recent Orders Table --}}
  <h3 class="mb-3">Recent Orders</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Total</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($recentOrders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->created_at->format('M j, Y') }}</td>
          <td>${{ number_format($order->total,2) }}</td>
          <td>{{ ucfirst($order->status) }}</td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center">No orders yet.</td></tr>
      @endforelse
    </tbody>
  </table>

  <a href="{{ route('orders.index') }}" class="btn btn-primary">
    View All Orders
  </a>

  {{-- Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($chartLabels),
        datasets: [{
          label: 'Orders per Day',
          data: @json($chartData),
          fill: false,
          tension: 0.4,
          borderWidth: 2,
          borderColor: '#2563eb',
          pointBackgroundColor: '#2563eb'
        }]
      },
      options: {
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1 } }
        },
        plugins: { legend: { display: false } }
      }
    });
  </script>
@endsection


