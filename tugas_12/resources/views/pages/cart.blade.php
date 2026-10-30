@extends('layouts.app')

@section('title', 'Halaman Keranjang - Dhimson E-Store')

@section('content')
<div class="container py-5">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <h3 class="fw-bold mb-1"><i class="bi bi-cart3 text-warning me-2"></i>Keranjang Belanja</h3>
      <p class="text-muted small mb-0">Kelola daftar item yang siap Anda checkout</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
    </a>
  </div>

  <div class="row g-4">
    <!-- Tabel Daftar Item -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th scope="col" class="py-3 ps-4">Produk</th>
                <th scope="col" class="py-3">Harga</th>
                <th scope="col" class="py-3 text-center">Jumlah</th>
                <th scope="col" class="py-3 text-end pe-4">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="ps-4">
                  <div class="d-flex align-items-center gap-3">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600" class="rounded object-fit-cover" width="60" height="60" alt="Headphone">
                    <div>
                      <h6 class="fw-bold mb-0">Wireless Noise-Canceling Headphone</h6>
                      <small class="text-muted">Elektronik</small>
                    </div>
                  </div>
                </td>
                <td>Rp 1.450.000</td>
                <td class="text-center">1 unit</td>
                <td class="text-end pe-4 fw-bold text-orange">Rp 1.450.000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Ringkasan Pembayaran -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-3 p-4">
        <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
        <div class="d-flex justify-content-between text-muted mb-2">
          <span>Total Item</span>
          <span>1 Barang</span>
        </div>
        <div class="d-flex justify-content-between text-muted mb-3">
          <span>Biaya Layanan</span>
          <span class="text-success fw-semibold">Gratis</span>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
          <span>Total Belanja</span>
          <span class="text-orange">Rp 1.450.000</span>
        </div>
        <a href="{{ route('checkout') }}" class="btn btn-warning w-100 py-2 fw-semibold">
          Proses Checkout <i class="bi bi-credit-card ms-1"></i>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection