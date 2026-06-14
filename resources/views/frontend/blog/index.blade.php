@extends('layouts.frontend')

@section('title', 'Blog & Berita')

@section('content')

<div class="page-hero">
    <div class="container text-center" data-aos="fade-up">
        <div class="hero-badge mx-auto"><i class="fas fa-newspaper me-1"></i> Blog</div>
        <h1 class="hero-title mt-3">Blog & Berita</h1>
        <p class="hero-subtitle mx-auto">Tips, berita terbaru, dan insight dunia logistik dari tim SwiftLogix.</p>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <!-- Filter & Search -->
        <div class="row g-3 mb-5" data-aos="fade-up">
            <div class="col-md-6">
                <form method="GET" action="{{ route('blog.index') }}" class="d-flex gap-2">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-orange rounded-pill px-3"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="col-md-6 d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ route('blog.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-warning' : 'btn-outline-secondary' }} rounded-pill px-3">Semua</a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat]) }}" class="btn btn-sm {{ request('category') === $cat ? 'btn-warning' : 'btn-outline-secondary' }} rounded-pill px-3">{{ $cat }}</a>
                @endforeach
            </div>
        </div>

        @if($posts->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-newspaper fs-1 text-muted mb-3"></i>
            <p class="text-muted">Belum ada artikel yang diterbitkan.</p>
        </div>
        @else
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="blog-card h-100">
                    <div class="blog-card-img">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
                        @else
                            <i class="fas fa-newspaper"></i>
                        @endif
                    </div>
                    <div class="blog-card-body d-flex flex-column">
                        <span class="blog-category">{{ $post->category }}</span>
                        <h5 class="blog-title flex-grow-1">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-navy">{{ $post->title }}</a>
                        </h5>
                        <p class="blog-excerpt">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
                        <div class="blog-meta d-flex justify-content-between mt-auto">
                            <span><i class="fas fa-calendar me-1"></i>{{ $post->published_at?->locale('id')->isoFormat('D MMM Y') }}</span>
                            <span><i class="fas fa-eye me-1"></i>{{ $post->views }} views</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center" data-aos="fade-up">
            {{ $posts->withQueryString()->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
