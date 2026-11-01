@extends('layouts.app')

@section('title', $product->nama_produk . ' - Details')

@section('content')
<div class="container py-5">
  <div class="card border-0 shadow-sm p-4">
    <div class="row g-4 align-items-center">
      <div class="col-md-5">
        <!-- Tag gambar yang sudah disesuaikan -->
        <img src="{{ str_starts_with($product->gambar, 'http') ? $product->gambar : asset(str_replace('\\', '/', $product->gambar)) }}" 
             class="img-fluid rounded shadow-sm" 
             alt="{{ $product->nama_produk }}">
      </div>
      <div class="col-md-7">
        <span class="badge bg-secondary mb-2">{{ ucfirst($product->kategori ?? 'Product') }}</span>
        <h2 class="fw-bold">{{ $product->nama_produk }}</h2>
        <h3 class="text-orange fw-bold my-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>
        <p class="text-muted">{{ $product->deskripsi }}</p>
        <p class="small text-secondary mb-4">Stock available: <strong>{{ $product->stok }} units</strong></p>
        <div class="d-flex gap-3">
          <a href="{{ route('cart') }}" class="btn btn-warning px-4 py-2 fw-semibold">
            <i class="bi bi-cart-plus me-1"></i> Add to Cart
          </a>
          <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4 py-2">Back to Catalog</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection