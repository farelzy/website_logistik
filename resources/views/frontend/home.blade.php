@extends('layouts.frontend')

@section('title', 'Beranda')
@section('meta_description', 'SwiftLogix - Perusahaan logistik terpercaya. Pengiriman ekspres, kargo darat, laut, udara ke seluruh Indonesia.')

@section('content')

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="hero-badge">
                    <i class="fas fa-award"></i> Logistik Terpercaya #1 Indonesia
                </div>
                <h1 class="hero-title">
                    Kirim Lebih Cepat,<br>
                    Lebih <span class="highlight">Aman</span>,<br>
                    Lebih Terpercaya
                </h1>
                <p class="hero-subtitle">
                    SwiftLogix hadir sebagai solusi logistik modern untuk bisnis dan personal Anda.
                    Jangkauan ke 200+ kota, tracking real-time, dan armada profesional.
                </p>
                <div class="hero-cta d-flex flex-wrap gap-3">
                    <a href="{{ route('services.index') }}" class="btn-primary-custom btn">
                        <i class="fas fa-rocket me-2"></i> Lihat Layanan
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-white">
                        <i class="fas fa-headset me-2"></i> Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                <div class="hero-tracking-box">
                    <h5 class="text-white fw-700 mb-1"><i class="fas fa-search-location me-2 text-warning"></i>Lacak Paket</h5>
                    <p class="text-white-50 small mb-3">Masukkan nomor resi pengiriman Anda</p>
                    <form method="POST" action="{{ route('tracking.track') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="tracking_number" class="form-control" placeholder="Contoh: SWL1A2B3C4" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 fw-600">
                            <i class="fas fa-search me-2"></i> Lacak Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS ROW -->
<div class="stats-row">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3" data-aos="fade-up">
                <div class="stat-item">
                    <div class="stat-number">{{ number_format($stats['shipments']) }}+</div>
                    <div class="stat-label">Pengiriman Selesai</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['cities'] }}+</div>
                    <div class="stat-label">Kota Terjangkau</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['clients'] }}+</div>
                    <div class="stat-label">Klien Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['years'] }}+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SERVICES SECTION -->
@if($services->count())
<section class="section-pad bg-light-custom">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge mx-auto"><i class="fas fa-concierge-bell"></i> Layanan Kami</div>
            <h2 class="section-title">Solusi Logistik Lengkap<br>untuk Bisnis Anda</h2>
            <p class="section-subtitle mx-auto">Dari pengiriman ekspres hingga cold chain, kami menyediakan layanan logistik end-to-end.</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card">
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
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('services.index') }}" class="btn btn-outline-dark px-4 rounded-pill">
                Lihat Semua Layanan <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- WHY US -->
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="section-badge"><i class="fas fa-star"></i> Keunggulan Kami</div>
                <h2 class="section-title">Mengapa Memilih SwiftLogix?</h2>
                <p class="text-muted">Kami tidak sekadar mengirim paket — kami mengirimkan kepercayaan dan ketenangan pikiran untuk setiap pelanggan.</p>

                @php
                $features = [
                    ['icon' => 'fas fa-bolt', 'title' => 'Pengiriman Ekspres', 'desc' => '24-48 jam ke seluruh kota besar Indonesia'],
                    ['icon' => 'fas fa-map-marked-alt', 'title' => 'Tracking Real-Time', 'desc' => 'Pantau posisi paket Anda kapan saja'],
                    ['icon' => 'fas fa-shield-alt', 'title' => 'Asuransi Pengiriman', 'desc' => 'Paket Anda terlindungi dari kerusakan'],
                    ['icon' => 'fas fa-headset', 'title' => 'Support 24/7', 'desc' => 'Tim kami siap membantu Anda kapan saja'],
                ];
                @endphp

                @foreach($features as $f)
                <div class="d-flex gap-3 mb-4">
                    <div class="service-icon flex-shrink-0" style="width:48px;height:48px;font-size:1rem;">
                        <i class="{{ $f['icon'] }}"></i>
                    </div>
                    <div>
                        <h6 class="fw-700 mb-1">{{ $f['title'] }}</h6>
                        <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="row g-3">
                    @php
                    $cards = [
                        ['num' => '98%', 'label' => 'Tingkat Kepuasan', 'icon' => 'fas fa-smile', 'color' => '#F4A025'],
                        ['num' => '24/7', 'label' => 'Layanan Aktif', 'icon' => 'fas fa-clock', 'color' => '#0D1B2A'],
                        ['num' => '200+', 'label' => 'Armada Kendaraan', 'icon' => 'fas fa-truck', 'color' => '#198754'],
                        ['num' => '15+', 'label' => 'Tahun Berpengalaman', 'icon' => 'fas fa-award', 'color' => '#0d6efd'],
                    ];
                    @endphp
                    @foreach($cards as $c)
                    <div class="col-6">
                        <div class="p-4 rounded-3 text-center" style="background:{{ $c['color'] }}15; border: 1px solid {{ $c['color'] }}30;">
                            <i class="{{ $c['icon'] }} fs-2 mb-2" style="color:{{ $c['color'] }}"></i>
                            <div class="fw-800 fs-3" style="color:{{ $c['color'] }}">{{ $c['num'] }}</div>
                            <div class="text-muted small">{{ $c['label'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
@if($testimonials->count())
<section class="section-pad bg-light-custom">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge mx-auto"><i class="fas fa-quote-left"></i> Testimoni</div>
            <h2 class="section-title">Apa Kata Pelanggan Kami</h2>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $t)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        @for($i=1;$i<=5;$i++)
                            <i class="fa{{ $i <= $t->rating ? 's' : 'r' }} fa-star"></i>
                        @endfor
                    </div>
                    <p class="testimonial-content">"{{ $t->content }}"</p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="testimonial-avatar">
                            {{ strtoupper(substr($t->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="testimonial-name">{{ $t->name }}</div>
                            <div class="testimonial-role">{{ $t->position }}@if($t->company), {{ $t->company }}@endif</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- BLOG PREVIEW -->
@if($posts->count())
<section class="section-pad">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <div class="section-badge"><i class="fas fa-newspaper"></i> Blog & Berita</div>
                <h2 class="section-title mb-0">Update Terbaru</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-dark rounded-pill px-4 d-none d-md-inline-flex">
                Semua Artikel <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="blog-card">
                    <div class="blog-card-img">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
                        @else
                            <i class="fas fa-newspaper"></i>
                        @endif
                    </div>
                    <div class="blog-card-body">
                        <span class="blog-category">{{ $post->category }}</span>
                        <h5 class="blog-title"><a href="{{ route('blog.show', $post->slug) }}" class="text-navy">{{ $post->title }}</a></h5>
                        <p class="blog-excerpt">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
                        <div class="blog-meta d-flex justify-content-between">
                            <span><i class="fas fa-calendar me-1"></i>{{ $post->published_at?->locale('id')->isoFormat('D MMM Y') }}</span>
                            <span><i class="fas fa-eye me-1"></i>{{ $post->views }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container text-center" data-aos="fade-up">
        <div class="section-badge mx-auto mb-3" style="background:rgba(244,160,37,0.15);border-color:rgba(244,160,37,0.4);">
            <i class="fas fa-rocket"></i> Mulai Sekarang
        </div>
        <h2 class="text-white fw-800 mb-3" style="font-size:2.5rem;">Siap Mengirimkan Paket Anda?</h2>
        <p class="text-white-50 mb-4 mx-auto" style="max-width:500px;">
            Bergabunglah dengan ribuan bisnis yang telah mempercayakan logistik mereka kepada SwiftLogix.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('contact') }}" class="btn btn-warning px-4 py-3 fw-600 rounded-pill">
                <i class="fas fa-headset me-2"></i> Hubungi Kami Sekarang
            </a>
            <a href="{{ route('tracking.index') }}" class="btn btn-outline-light px-4 py-3 fw-600 rounded-pill">
                <i class="fas fa-search me-2"></i> Lacak Paket
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Number counter animation
const counters = document.querySelectorAll('.stat-number');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const target = parseInt(el.textContent.replace(/\D/g, ''));
            const suffix = el.textContent.replace(/[0-9,]/g, '');
            let current = 0;
            const step = target / 60;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    el.textContent = target.toLocaleString() + suffix;
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(current).toLocaleString() + suffix;
                }
            }, 25);
            observer.unobserve(el);
        }
    });
}, { threshold: 0.5 });
counters.forEach(c => observer.observe(c));
</script>
@endpush
