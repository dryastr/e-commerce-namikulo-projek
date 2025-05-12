@extends('layouts_web.main')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section Template -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="position-relative">
                    <img src="https://s3-alpha-sig.figma.com/img/6293/9363/cc54d3da40047f67c69189b6d6605361?Expires=1745798400&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=jlil03gCiiV5yBs002EuuSk6qYnDYXky~YMxO7im9g9hZnbBoaUoF2NHZE4TwPQ~uBU1fh05TkDo14Iue8M6Ej4gRKbGsnHBC~caIiZuQBQXM-ZENUSpwI5d3NFQKBBvYWvj7stup-jZQF3dSmN9CbfjiHJvMz~80CfNg8rnJX5EEDwLeHL7oAyZBzo-EYcqzxT1pI7axfE3vpug-CqR2TDcTSJbpEEpZqy2KLCF-IMSKWcyHGTOSOLkWf77YDbI3ataT4BhpnNBeDlFaQZKNDas2PPrKIaWhnzBmFtumuNYGL-~d-LKxUMpXbLsI4X7uahxjYC7PabRJIj8z~l7Tg__"
                        alt="Hero Image" class="img-fluid rounded w-100">

                    <div class="position-absolute top-0 end-0 px-3 py-2 m-3 text-end">
                        <span class="fw-bold text-dark" style="font-size: 52px;">Selamat Datang <br> Desa Wisata Tegal
                            Guci</span>
                    </div>

                    <div class="position-absolute bottom-0 start-50 translate-middle-x m-3 w-75">
                        <div class="bg-white p-3 rounded shadow-sm d-flex align-items-center">
                            <!-- Bagian Lokasi (kiri) -->
                            <div class="flex-grow-1 text-left border-end pe-3 me-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Guci</h6>
                                        <small class="text-muted">Tegal, Indonesia</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Search (kanan) -->
                            <form action="{{ route('landing_page') }}" method="GET" class="flex-shrink-1"
                                style="width: 60%;">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari tempat wisata..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section Template -->
    <section class="testimonial-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">Destinasi Wisata Favorit</h2>
            </div>

            <div class="row g-4">
                @foreach ($latestProducts as $product)
                    <div class="col-md-6">
                        <div class="card h-100 border-0">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">

                            <div class="card-body d-flex justify-content-between align-items-center"
                                style="background: #F8F9FA">
                                <div class="pe-3">
                                    <h5 class="card-title mb-1 fw-bold">{{ $product->name }}</h5>
                                    <p class="card-text text-muted mb-0">
                                        {{ Str::limit($product->description, 80) }}
                                    </p>
                                </div>
                                <a href="{{ route('produk.show', $product->id) }}" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
