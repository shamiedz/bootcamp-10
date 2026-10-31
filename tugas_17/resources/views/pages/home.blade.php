@extends('layouts.app')

@section('title', 'Home - Dhimson E-Store')

@section('content')
<!-- Hero Section -->
<div class="bg-dark text-white text-center py-5 mb-5 shadow-sm">
  <div class="container py-4">
    <h1 class="display-4 fw-bold">Welcome to <span class="text-warning">Dhimson E-Store</span></h1>
    <p class="lead text-secondary col-lg-8 mx-auto mt-3">
      E-Commerce platform managed with Laravel MVC Architecture.
    </p>
    <a href="{{ route('products.index') }}" class="btn btn-warning fw-semibold px-4 py-2 mt-2">
      Explore Products
    </a>
  </div>
</div>

<!-- Featured Products Section -->
<div class="container pb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">Featured Products</h3>
    <a href="{{ route('products.index') }}" class="text-warning text-decoration-none fw-semibold">
      View All &rarr;
    </a>
  </div>

  @php
    $items = $featured_products ?? $products ?? [];
  @endphp

  <div class="row g-4">
    @forelse ($items as $product)
      <div class="col-lg-3 col-md-6">
        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
          <!-- Penanganan gambar link eksternal vs file lokal upload -->
          <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset(str_replace('\\', '/', $product->image)) }}" 
               class="card-img-top object-fit-cover" 
               height="200" 
               alt="{{ $product->name }}">
               
          <div class="card-body d-flex flex-column">
            <span class="badge bg-light text-secondary border w-auto align-self-start mb-2">
              {{ $product->category->name ?? 'Umum' }}
            </span>
            <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
            <p class="text-muted small text-truncate mb-3">{{ $product->description }}</p>
            <div class="text-orange fw-bold fs-5 mt-auto mb-3">
              Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-dark btn-sm w-100">
              View Details
            </a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted">Belum ada produk unggulan yang tersedia.</p>
      </div>
    @endforelse
  </div>
</div>
@endsection