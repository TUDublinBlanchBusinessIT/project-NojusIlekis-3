<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'E-Shop') }}</title>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">

  <!-- Starability CSS -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/starability/css/starability-all.min.css"/>

  <!-- Your custom overrides -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="font-sans antialiased">
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">

      <!-- Logo + Site Name -->
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}"
             alt="{{ config('app.name') }} logo"
             style="height:30px; margin-right:8px;">
        {{ config('app.name', 'E-Shop') }}
      </a>

      <!-- Toggler button -->
      <button class="navbar-toggler" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#mainNav"
              aria-controls="mainNav"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible nav links -->
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <!-- Dashboard link -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
          </li>

          <!-- Categories dropdown -->
          @inject('navCategories','App\Models\Category')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarCategories"
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarCategories">
              <!-- Manage link -->
              <li>
                <a class="dropdown-item" href="{{ route('categories.index') }}">
                  Manage Categories
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <!-- Front-end filters -->
              @foreach($navCategories->all() as $cat)
                <li>
                  <a class="dropdown-item"
                     href="{{ route('products.index', ['category_id' => $cat->id]) }}">
                    {{ $cat->name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          @auth
            <li class="nav-item">
              <span class="nav-link">{{ Auth::user()->name }}</span>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link btn btn-link" type="submit">Log Out</button>
              </form>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Log In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




