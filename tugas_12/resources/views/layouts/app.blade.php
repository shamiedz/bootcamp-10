<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dhimson E-Store')</title>
  
  <!-- Bootstrap 5 CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; color: #212529; }
    .btn-orange { background-color: #f86f03; color: #fff; font-weight: 600; }
    .btn-orange:hover { background-color: #e05e00; color: #fff; }
    .text-orange { color: #f86f03; }
    .hover-light:hover { color: #f8f9fa !important; }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- 1. Komponen Blade: Navbar -->
  <x-navbar />

  <!-- 2. Area Konten Dinamis Halaman -->
  <main class="flex-grow-1">
    @yield('content')
  </main>

  <!-- 3. Komponen Blade: Footer -->
  <x-footer />

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>