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
@endsection

