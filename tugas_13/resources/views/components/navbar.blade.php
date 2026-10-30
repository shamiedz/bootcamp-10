<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">
      DHIMSON <span class="text-warning">E-STORE</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active text-warning fw-semibold' : '' }}" href="{{ route('home') }}">
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('products.*') ? 'active text-warning fw-semibold' : '' }}" href="{{ route('products.index') }}">
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active text-warning fw-semibold' : '' }}" href="{{ route('about') }}">
            About Us
          </a>
        </li>
      </ul>
      
      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('cart') }}" class="btn btn-warning position-relative fw-semibold">
          <i class="bi bi-cart3 me-1"></i> Cart
        </a>
      </div>
    </div>
  </div>
</nav>