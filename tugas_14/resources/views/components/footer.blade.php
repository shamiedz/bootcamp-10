<footer class="bg-dark text-white pt-5 pb-4 mt-auto border-top border-secondary">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-5 col-md-6">
        <h5 class="fw-bold mb-3">DHIMSON <span class="text-warning">E-STORE</span></h5>
        <p class="text-secondary small col-lg-10">
          Aplikasi e-commerce modern berbasis Laravel MVC Architecture dengan komponen Blade modular, koneksi MySQL database, dan penanganan multi-asset path.
        </p>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="fw-bold text-uppercase text-warning mb-3">Quick Links</h6>
        <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
          <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none hover-light">Halaman Utama</a></li>
          <li><a href="{{ route('products.index') }}" class="text-secondary text-decoration-none hover-light">Daftar Produk</a></li>
          <li><a href="{{ route('cart') }}" class="text-secondary text-decoration-none hover-light">Halaman Keranjang</a></li>
          <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none hover-light">About Us</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-12">
        <h6 class="fw-bold text-uppercase text-warning mb-3">Teknologi Digunakan</h6>
        <div class="d-flex flex-wrap gap-2">
          <span class="badge bg-secondary">Laravel 11</span>
          <span class="badge bg-secondary">Blade Components</span>
          <span class="badge bg-secondary">Bootstrap 5</span>
          <span class="badge bg-secondary">MySQL</span>
        </div>
      </div>
    </div>

    <hr class="border-secondary my-4">

    <div class="text-center text-secondary small">
      &copy; 2026 Dhimson E-Store &bull; Blade Components & Layout Modular.
    </div>
  </div>
</footer>