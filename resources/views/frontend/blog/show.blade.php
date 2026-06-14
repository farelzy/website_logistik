@extends('layouts.frontend')

@section('title', $post->title)
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')

<div class="page-hero" style="padding-bottom:2rem;">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="hero-badge mx-auto">{{ $post->category }}</span>
                <h1 class="hero-title mt-3" style="font-size:clamp(1.8rem,4vw,3rem);">{{ $post->title }}</h1>
                <div class="d-flex justify-content-center gap-4 text-white-50 small mt-3">
                    <span><i class="fas fa-user me-1"></i>{{ $post->author?->name ?? 'Admin' }}</span>
                    <span><i class="fas fa-calendar me-1"></i>{{ $post->published_at?->locale('id')->isoFormat('D MMMM Y') }}</span>
                    <span><i class="fas fa-eye me-1"></i>{{ $post->views }} views</span>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-8" data-aos="fade-right">
                @if($post->image)
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-100 rounded-3 mb-4" style="max-height:400px;object-fit:cover;">
                @endif
                <div class="blog-content" style="font-size:1rem;line-height:1.9;color:#444;">
                    {!! $post->content !!}
                </div>

                <!-- Share -->
                <div class="mt-4 pt-4 border-top">
                    <h6 class="fw-700 text-navy mb-3">Bagikan Artikel Ini:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="fab fa-facebook me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-info btn-sm rounded-pill px-3 text-white">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <!-- CTA Box -->
                <div class="p-4 rounded-3 bg-light-custom border mb-4">
                    <h6 class="fw-700 text-navy mb-2"><i class="fas fa-shipping-fast text-orange me-2"></i>Butuh Layanan Logistik?</h6>
                    <p class="text-muted small mb-3">Hubungi kami untuk mendapatkan penawaran terbaik sesuai kebutuhan Anda.</p>
                    <a href="{{ route('contact') }}" class="btn btn-orange w-100 rounded-pill btn-sm">
                        <i class="fas fa-headset me-2"></i> Hubungi Kami
                    </a>
                </div>

                <!-- Related Posts -->
                @if($related->count())
                <h6 class="fw-700 text-navy mb-3">Artikel Terkait</h6>
                @foreach($related as $r)
                <div class="mb-3">
                    <a href="{{ route('blog.show', $r->slug) }}" class="d-flex gap-3 align-items-start text-decoration-none">
                        <div class="flex-shrink-0" style="width:60px;height:60px;background:var(--navy-2);border-radius:10px;overflow:hidden;">
                            @if($r->image)
                                <img src="{{ Storage::url($r->image) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-orange">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="fw-600 text-navy small" style="line-height:1.3;">{{ Str::limit($r->title, 60) }}</div>
                            <div class="text-muted" style="font-size:0.75rem;">{{ $r->published_at?->locale('id')->isoFormat('D MMM Y') }}</div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
