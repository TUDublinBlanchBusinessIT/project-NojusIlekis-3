@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">New Product</a>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $p)
        <tr>
          <td>{{ $p->name }}</td>
          <td>{{ $p->category->name }}</td>
          <td>${{ number_format($p->price, 2) }}</td>
          <td>{{ $p->stock }}</td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center">No products yet</td></tr>
      @endforelse
    </tbody>
  </table>
@endsection
