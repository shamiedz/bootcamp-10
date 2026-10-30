<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dhimson E-Store')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; color: #212529; }
    .navbar-brand span { color: #f86f03; }
    .btn-orange { background-color: #f86f03; color: #fff; font-weight: 600; }
    .btn-orange:hover { background-color: #e05e00; color: #fff; }
    .text-orange { color: #f86f03; }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('home') }}">DHIMSON <span>E-STORE</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
          <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
        </ul>
        <a href="{{ route('cart') }}" class="btn btn-warning fw-semibold">
          <i class="bi bi-cart3 me-1"></i> Cart
        </a>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <main class="flex-grow-1">
    @yield('content')
  </main>

  <footer class="py-3 bg-white border-top text-center text-muted small mt-5">
    &copy; 2026 Dhimson E-Store. Laravel Controller Implementation.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>