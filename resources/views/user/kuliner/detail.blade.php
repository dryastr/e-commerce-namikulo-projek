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
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold">{{ $product->name }}</h2>
                        <a href="{{ route('landing_page') }}">Kembali</a>
                    </div>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>

            </div>
        </div>
    </section>
@endsection
