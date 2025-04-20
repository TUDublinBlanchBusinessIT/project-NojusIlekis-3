@extends('layouts.app')

@section('content')
  <h1>New Category</h1>

  <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text"
             name="name"
             id="name"
             class="form-control"
             required>
    </div>
    <button class="btn btn-success">Save</button>
  </form>
@endsection
