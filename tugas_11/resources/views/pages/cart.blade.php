@extends('layouts.app')
@section('title', 'Shopping Cart')
@section('content')
<div class="container py-5 text-center">
  <h3 class="fw-bold mb-3"><i class="bi bi-cart3 text-warning me-2"></i>Shopping Cart</h3>
  <p class="text-muted">This cart page is handled by <code>PageController@cart</code>.</p>
  <a href="{{ route('products.index') }}" class="btn btn-orange">Continue Shopping</a>
</div>
@endsection