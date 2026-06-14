@extends('layouts.frontend')

@section('title', 'Layanan Kami')

@section('content')

<div class="page-hero">
    <div class="container text-center" data-aos="fade-up">
        <div class="hero-badge mx-auto"><i class="fas fa-concierge-bell me-1"></i> Layanan</div>
        <h1 class="hero-title mt-3">Layanan Logistik Lengkap</h1>
        <p class="hero-subtitle mx-auto">Kami menyediakan berbagai solusi pengiriman dan logistik untuk memenuhi kebutuhan bisnis Anda.</p>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        @if($services->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-box-open fs-1 text-muted mb-3"></i>
                <p class="text-muted">Belum ada layanan tersedia.</p>
            </div>
        @else
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="service-card h-100">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-100 rounded-3 mb-3" style="height:180px;object-fit:cover;">
                    @endif
                    <div class="service-icon">
                        <i class="{{ $service->icon ?? 'fas fa-truck' }}"></i>
                    </div>
                    <h5>{{ $service->title }}</h5>
                    <p>{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="service-link">
                        Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="text-white fw-800 mb-3">Butuh Solusi Khusus?</h2>
        <p class="text-white-50 mb-4">Tim kami siap merancang paket layanan yang disesuaikan dengan kebutuhan bisnis Anda.</p>
        <a href="{{ route('contact') }}" class="btn btn-warning px-4 py-3 fw-600 rounded-pill">
            <i class="fas fa-headset me-2"></i> Konsultasi Gratis
        </a>
    </div>
</section>

@endsection
