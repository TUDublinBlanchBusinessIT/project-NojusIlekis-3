@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">New Category</a>
  </div>

  <ul class="list-group">
    @foreach($categories as $c)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $c->name }}
        <span>
          <!-- Edit button -->
          <a href="{{ route('categories.edit', $c) }}"
             class="btn btn-sm btn-secondary me-2">
            Edit
          </a>

          <!-- Delete button -->
          <form action="{{ route('categories.destroy', $c) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('Delete this category?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
              Delete
            </button>
          </form>
        </span>
      </li>
    @endforeach
  </ul>
@endsection
