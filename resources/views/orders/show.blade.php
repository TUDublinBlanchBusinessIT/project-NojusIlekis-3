@extends('layouts.app')

@section('content')
  <h1>Order #{{ $order->id }} Confirmation</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
  <p><strong>Placed on:</strong> {{ $order->created_at->format('F j, Y \a\t g:ia') }}</p>
  <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>

  <h3 class="mt-4">Rate Your Experience</h3>

  @php
    $rating    = 4;  // later, you can use e.g. $order->rating
    $maxStars  = 5;
  @endphp

  <div class="mb-4">
    @for ($i = 1; $i <= $maxStars; $i++)
      @if ($i <= $rating)
        <span class="fs-3 text-warning">&#9733;</span><!-- filled star -->
      @else
        <span class="fs-3 text-muted">&#9734;</span><!-- empty star -->
      @endif
    @endfor
  </div>

  <h3 class="mt-4">Items</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
        <tr>
          <td>{{ $item->product->name }}</td>
          <td>${{ number_format($item->price, 2) }}</td>
          <td>{{ $item->quantity }}</td>
          <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

