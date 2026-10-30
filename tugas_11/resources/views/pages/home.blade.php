@extends('layouts.app')

@section('title', 'Home - Dhimson E-Store')

@section('content')
<div class="bg-dark text-white py-5 mb-5" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
  <div class="container text-center py-4">
    <h1 class="display-5 fw-bold mb-3">Welcome to Dhimson E-Store</h1>
    <p class="lead text-white-50 mb-4">E-Commerce platform managed with Laravel MVC Architecture.</p>
    <a href="{{ route('products.index') }}" class="btn btn-warning px-4 py-2 fw-semibold">Explore Products</a>
  </div>
</div>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Featured Products</h4>
    <a href="{{ route('products.index') }}" class="text-decoration-none fw-semibold text-warning">View All &rarr;</a>
  </div>

  <div class="row g-4">
    @foreach ($featured_products as $p)
      <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
          <!-- Tag gambar yang sudah disesuaikan -->
          <img src="{{ str_starts_with($p->gambar, 'http') ? $p->gambar : asset(str_replace('\\', '/', $p->gambar)) }}" 
               class="card-img-top object-fit-cover" 
               height="200" 
               alt="{{ $p->nama_produk }}">
          <div class="card-body d-flex flex-column">
            <h6 class="fw-bold mb-1">{{ $p->nama_produk }}</h6>
            <p class="text-muted small text-truncate">{{ $p->deskripsi }}</p>
            <div class="text-warning fw-bold fs-5 mt-auto mb-2">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
            <a href="{{ route('products.show', $p->id) }}" class="btn btn-outline-dark btn-sm">View Details</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection