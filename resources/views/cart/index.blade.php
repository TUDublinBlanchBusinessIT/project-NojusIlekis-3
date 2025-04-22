@extends('layouts.app')

@section('content')
  <h1>Your Shopping Cart</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(empty($cart))
    <p>Your cart is empty.</p>
  @else
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $item)
          @php 
            $subtotal = $item['price'] * $item['quantity']; 
            $total += $subtotal; 
          @endphp
          <tr>
            <td>{{ $item['name'] }}</td>
            <td>${{ number_format($item['price'],2) }}</td>
            <td>
              <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-inline-block">
                @csrf
                @method('PATCH')
                <input 
                  type="number" 
                  name="quantity" 
                  value="{{ $item['quantity'] }}" 
                  min="1" 
                  class="form-control d-inline-block" 
                  style="width:80px;">
                <button class="btn btn-sm btn-primary">Update</button>
              </form>
            </td>
            <td>${{ number_format($subtotal,2) }}</td>
            <td>
              <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button 
                  class="btn btn-sm btn-danger" 
                  onclick="return confirm('Remove this item?')">
                  Remove
                </button>
              </form>
            </td>
          </tr>
        @endforeach
        <tr>
          <td colspan="3" class="text-end"><strong>Total:</strong></td>
          <td colspan="2"><strong>${{ number_format($total,2) }}</strong></td>
        </tr>
      </tbody>
    </table>

    <!-- Proceed to Checkout -->
    <form action="{{ route('checkout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-success">Proceed to Checkout</button>
    </form>
  @endif
@endsection

