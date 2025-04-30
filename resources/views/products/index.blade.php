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
        <th>Add to Cart</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $p)
        <tr>
          <td>{{ $p->name }}</td>
          <td>{{ $p->category->name }}</td>
          <td>${{ number_format($p->price, 2) }}</td>
          <td>{{ $p->stock }}</td>
          <td>
            <form action="{{ route('cart.add', $p) }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
            </form>
          </td>
          <td>
            <!-- Edit button -->
            <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-secondary me-2">
              Edit
            </a>
            <!-- Delete button -->
            <form action="{{ route('products.destroy', $p) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Delete this product?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">No products yet</td>
        </tr>
      @endforelse
    </tbody>
  </table>
@endsection


