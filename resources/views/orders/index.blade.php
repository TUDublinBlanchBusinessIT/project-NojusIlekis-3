@extends('layouts.app')

@section('content')
  <h1>My Orders</h1>

  @if($orders->isEmpty())
    <p>You have not placed any orders yet.</p>
  @else
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Order #</th>
          <th>Placed On</th>
          <th>Total</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->created_at->format('M j, Y') }}</td>
            <td>${{ number_format($order->total,2) }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
              <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">
                View
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $orders->links() }}
  @endif
@endsection
