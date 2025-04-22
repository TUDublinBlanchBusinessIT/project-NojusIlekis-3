@extends('layouts.app')

@section('content')
  <h1>New Product</h1>

  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Stock</label>
      <input type="number" name="stock" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select" required>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
    <button class="btn btn-success">Save</button>
  </form>
@endsection
