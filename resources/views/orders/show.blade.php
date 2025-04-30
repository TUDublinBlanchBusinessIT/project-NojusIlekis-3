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

  <form action="{{ route('orders.rate', $order) }}" method="POST" class="mb-4">
    @csrf

    <fieldset class="starability-slot">
      <legend class="visuallyhidden">Rating for this order</legend>

      @php $current = old('rating', $order->rating ?? 0); @endphp

      @for ($i = 5; $i >= 1; $i--)
        <input type="radio"
               id="rate{{ $i }}"
               name="rating"
               value="{{ $i }}"
               {{ $current == $i ? 'checked' : '' }} />
        <label for="rate{{ $i }}" title="{{ $i }} stars">{{ $i }} stars</label>
      @endfor
    </fieldset>

    @error('rating')
      <div class="text-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
  </form>

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


