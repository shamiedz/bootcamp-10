@extends('layouts.app')

@section('title', 'Halaman Utama - Dhimson E-Store')

@section('content')
<!-- Hero Section -->
<div class="text-white py-5 mb-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
  <div class="container text-center py-5">
    <span class="badge bg-warning text-dark px-3 py-2 mb-3 fw-semibold">Blade Modular Architecture</span>
    <h1 class="display-4 fw-bold mb-3">Selamat Datang di Dhimson E-Store</h1>
    <p class="lead text-white-50 mb-4 col-md-8 mx-auto">
      Temukan perangkat teknologi performa tinggi dan produk tren terkini dengan pengalaman belanja modern.
    </p>
    <a href="{{ route('products.index') }}" class="btn btn-warning px-4 py-2 fw-semibold shadow-sm">
      <i class="bi bi-grid me-1"></i> Jelajahi Daftar Produk
    </a>
  </div>
</div>

<!-- Featured Products Section -->
<div class="container mb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1">Produk Unggulan</h3>
      <p class="text-muted small mb-0">Rekomendasi pilihan terbaik untuk kebutuhan harian Anda</p>
    </div>
    <a href="{{ route('products.index') }}" class="text-orange text-decoration-none fw-semibold">
      Lihat Semua <i class="bi bi-arrow-right"></i>
    </a>
  </div>

  <div class="row g-4">
    @forelse ($featured_products as $p)
      <div class="col-lg-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
          <img src="{{ str_starts_with($p->gambar, 'http') ? $p->gambar : asset(str_replace('\\', '/', $p->gambar)) }}" 
               class="card-img-top object-fit-cover" 
               height="200" 
               alt="{{ $p->nama_produk }}">
          <div class="card-body d-flex flex-column">
            <span class="badge bg-light text-secondary border w-auto align-self-start mb-2">{{ ucfirst($p->kategori ?? 'Umum') }}</span>
            <h6 class="fw-bold mb-1">{{ $p->nama_produk }}</h6>
            <p class="text-muted small text-truncate">{{ $p->deskripsi }}</p>
            <div class="text-orange fw-bold fs-5 mt-auto mb-3">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
            <a href="{{ route('products.show', $p->id) }}" class="btn btn-outline-dark btn-sm">Lihat Detail</a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-4">
        <p class="text-muted">Belum ada produk unggulan yang tersedia.</p>
      </div>
    @endforelse
  </div>
</div>
@endsection