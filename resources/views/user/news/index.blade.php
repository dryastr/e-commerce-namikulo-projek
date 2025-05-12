@extends('layouts_web.main')

@section('title', 'Berita Terbaru')

@section('content')
    <!-- Hero Section - Gambar Header -->
    <section id="home" class="hero-section py-5">
        <div class="container">
            <div class="row">
                <div class="position-relative">
                    <img src="https://s3-alpha-sig.figma.com/img/f113/e975/40f569ec749fd59ad1d3e5789037fc9b?Expires=1746403200&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=fGNKEgU0Rak~tn6kSDRIz2-XMGMxNqAnobufcoTtRwOOTey-c6jRej95J4BQinJ3LhN0TieYFrvWi5xz213j7w4cPk06UcZu-TmrzjvxrfW6o9pymAdLf3JC-qwL45qMcyvhuGnU5wvfJzwVzrSz39jCnjoYOPlrVKowuy8VMI7w7oAtBKdVlZdE3E87PnELzLZRY3kZF7xkQOhjXYAYwbmG8F1tDVW~o7qU~BwfEv9ReMl8tlOsIF3SbbRJEun5zX-aVVXt7N8BLGdJHgzYqZDIUgT~l6lvwmJBKa6SJpjsD5OKoorowBxFBZEQO2hPOMoAtL12gLzrrCZvI5xUWA__"
                        alt="Berita" class="img-fluid rounded w-100" style="height: 522px; object-fit: cover;">

                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Berita -->
    <section class="news-section py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4">Berita Terbaru</h2>

            @foreach ($latestNews as $item)
                <a href="{{ url('/berita/' . $item->id) }}" class="text-decoration-none text-dark">
                    <div class="row mb-4 align-items-start">
                        <!-- Gambar Berita -->
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="img-fluid rounded w-100">
                        </div>

                        <!-- Info Berita -->
                        <div class="col-md-8">
                            <p class="text-muted mb-1">
                                <small>Post by Admin ·
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</small>
                            </p>
                            <h5 class="fw-bold mb-2">{{ $item->name }}</h5>
                            <p class="mb-0">{{ Str::limit($item->description, 200) }}</p>
                        </div>
                    </div>
                </a>
                <hr>
            @endforeach

        </div>
    </section>
@endsection
