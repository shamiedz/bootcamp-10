@extends('layouts.app')

@section('title', 'Product Catalog')

@section('content')
<div class="container py-4">
  <div class="text-center mb-4">
    <h3 class="fw-bold">Product Catalog</h3>
    <p class="text-muted small">Managed via <code>ProductController@index</code></p>
    
    <div class="d-flex justify-content-center gap-2 mt-3">
      <a href="{{ route('products.index') }}" class="btn btn-sm {{ empty($kategori) || $kategori == 'all' ? 'btn-dark' : 'btn-outline-dark' }}">All</a>
      <a href="{{ route('products.index', ['kategori' => 'elektronik']) }}" class="btn btn-sm {{ $kategori == 'elektronik' ? 'btn-dark' : 'btn-outline-dark' }}">Electronics</a>
      <a href="{{ route('products.index', ['kategori' => 'fashion']) }}" class="btn btn-sm {{ $kategori == 'fashion' ? 'btn-dark' : 'btn-outline-dark' }}">Fashion</a>
      <a href="{{ route('products.index', ['kategori' => 'aksesoris']) }}" class="btn btn-sm {{ $kategori == 'aksesoris' ? 'btn-dark' : 'btn-outline-dark' }}">Accessories</a>
    </div>
  </div>

  <div class="row g-4">
    @forelse ($products as $product)
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card h-100 border-0 shadow-sm">
          <!-- Tag gambar di bawah ini yang diperbarui agar mendukung gambar web dan gambar lokal -->
          <img src="{{ str_starts_with($product->gambar, 'http') ? $product->gambar : asset(str_replace('\\', '/', $product->gambar)) }}" 
               class="card-img-top object-fit-cover" 
               height="200" 
               alt="{{ $product->nama_produk }}">
               
          <div class="card-body d-flex flex-column">
            <span class="badge bg-light text-secondary border w-auto align-self-start mb-2">{{ ucfirst($product->kategori ?? 'General') }}</span>
            <h6 class="fw-bold mb-1">{{ $product->nama_produk }}</h6>
            <p class="text-muted small text-truncate mb-3">{{ $product->deskripsi }}</p>
            <div class="text-orange fw-bold fs-5 mt-auto mb-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
            <div class="d-flex gap-2">
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary btn-sm flex-fill">Details</a>
              <a href="{{ route('cart') }}" class="btn btn-orange btn-sm flex-fill"><i class="bi bi-cart-plus"></i> Buy</a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted">No products available in this category.</p>
      </div>
    @endforelse
  </div>
</div>
@endsection