@extends('layouts.app')

@section('content')
  <h1>Edit Product</h1>

  <!-- Update Form -->
  <form action="{{ route('products.update', $product) }}" method="POST" class="mb-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input
        type="text"
        name="name"
        value="{{ old('name', $product->name) }}"
        class="form-control"
        required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Price</label>
      <input
        type="number"
        step="0.01"
        name="price"
        value="{{ old('price', $product->price) }}"
        class="form-control"
        required>
    </div>

    <div class="mb-3">
      <label class="form-label">Stock</label>
      <input
        type="number"
        name="stock"
        value="{{ old('stock', $product->stock) }}"
        class="form-control"
        required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select" required>
        @foreach($categories as $cat)
          <option
            value="{{ $cat->id }}"
            {{ $cat->id == $product->category_id ? 'selected' : '' }}>
            {{ $cat->name }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
  </form>

  <!-- Delete Form -->
  <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
@endsection


