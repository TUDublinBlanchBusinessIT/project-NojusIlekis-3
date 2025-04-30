@extends('layouts.app')

@section('content')
  <h1>New Product</h1>

  <form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text"
             name="name"
             class="form-control"
             value="{{ old('name') }}"
             required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description"
                class="form-control">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="number"
             step="0.01"
             name="price"
             class="form-control"
             value="{{ old('price') }}"
             required>
    </div>

    <div class="mb-3">
      <label class="form-label">Stock</label>
      <input type="number"
             name="stock"
             class="form-control"
             value="{{ old('stock') }}"
             required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id"
              class="form-select"
              required>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}"
                  {{ old('category_id') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Active Checkbox --}}
    <div class="form-check mb-3">
      <input type="checkbox"
             name="active"
             id="active"
             class="form-check-input"
             value="1"
             {{ old('active', true) ? 'checked' : '' }}>
      <label class="form-check-label" for="active">Active?</label>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
  </form>
@endsection

