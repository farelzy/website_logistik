@extends('layouts.frontend')

@section('title', $service->title)

@section('content')

<div class="page-hero">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="service-icon mx-auto mb-3" style="background:rgba(244,160,37,0.2);">
                    <i class="{{ $service->icon ?? 'fas fa-truck' }}" style="color:var(--orange);font-size:1.8rem;"></i>
                </div>
                <h1 class="hero-title">{{ $service->title }}</h1>
                <p class="hero-subtitle mx-auto">{{ $service->short_description }}</p>
            </div>
        </div>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                @if($service->image)
                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-100 rounded-3 mb-4" style="max-height:350px;object-fit:cover;">
                @endif
                <h3 class="fw-700 text-navy mb-3">Tentang Layanan Ini</h3>
                <div class="text-muted" style="line-height:1.9;">{!! $service->description !!}</div>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div class="p-4 rounded-3 bg-light-custom border mb-4">
                    <h5 class="fw-700 text-navy mb-3"><i class="fas fa-phone-alt text-orange me-2"></i>Pesan Sekarang</h5>
                    <p class="text-muted small">Hubungi kami untuk mendapatkan penawaran harga terbaik.</p>
                    <a href="{{ route('contact') }}" class="btn btn-orange w-100 rounded-pill">
                        <i class="fas fa-headset me-2"></i> Hubungi Kami
                    </a>
                </div>

                @if($related->count())
                <div>
                    <h6 class="fw-700 text-navy mb-3">Layanan Lainnya</h6>
                    @foreach($related as $r)
                    <a href="{{ route('services.show', $r->slug) }}" class="d-flex gap-3 align-items-center p-3 rounded-3 bg-light-custom border mb-2 text-decoration-none">
                        <div style="width:40px;height:40px;background:var(--orange);border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;flex-shrink:0;font-size:0.9rem;">
                            <i class="{{ $r->icon ?? 'fas fa-truck' }}"></i>
                        </div>
                        <span class="fw-600 text-navy small">{{ $r->title }}</span>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
