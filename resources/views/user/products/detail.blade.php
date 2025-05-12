@extends('layouts_web.main')

@section('title', 'Detail Produk')

@section('content')
    <!-- Hero Section - Gambar Produk -->
    <section id="home" class="hero-section py-5">
        <div class="container">
            <div class="row">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="img-fluid rounded w-100" style="height: 522px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Produk Section -->
    <section class="product-detail-section py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <!-- Deskripsi Produk -->
                <div class="col-md-8">
                    <h2 class="fw-bold">{{ $product->name }}</h2>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>

                <!-- Info Tambahan Produk -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-4">
                        <h5 class="mb-3">Informasi Produk</h5>
                        <ul class="list-unstyled">
                            <li><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</li>
                            <li><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</li>
                        </ul>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3 w-100">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
