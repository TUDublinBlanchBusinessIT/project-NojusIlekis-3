@extends('layouts.app')

@section('content')
  <h1>Edit Category</h1>

  <!-- Update Form -->
  <form action="{{ route('categories.update', $category) }}" method="POST" class="mb-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input
        type="text"
        name="name"
        id="name"
        value="{{ old('name', $category->name) }}"
        class="form-control"
        required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
  </form>

  <!-- Delete Form -->
  <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
@endsection

