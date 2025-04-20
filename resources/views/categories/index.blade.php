@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">New Category</a>
  </div>

  <ul class="list-group">
    @foreach($categories as $c)
      <li class="list-group-item">{{ $c->name }}</li>
    @endforeach
  </ul>
@endsection
