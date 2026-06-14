@extends('layouts.frontend')

@section('title', 'Tentang Kami')
@section('meta_description', 'Pelajari lebih lanjut tentang SwiftLogix, perusahaan logistik terpercaya di Indonesia sejak 2010.')

@section('content')

<div class="page-hero">
    <div class="container text-center" data-aos="fade-up">
        <div class="hero-badge mx-auto"><i class="fas fa-building me-1"></i> Tentang Kami</div>
        <h1 class="hero-title mt-3">Kami adalah SwiftLogix</h1>
        <p class="hero-subtitle mx-auto">Membangun ekosistem logistik yang menghubungkan seluruh Indonesia dengan teknologi dan profesionalisme.</p>
    </div>
</div>

<!-- OUR STORY -->
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="section-badge"><i class="fas fa-history"></i> Cerita Kami</div>
                <h2 class="section-title">Perjalanan 15 Tahun Melayani Indonesia</h2>
                <p class="text-muted">{{ \App\Models\Setting::get('company_about', 'SwiftLogix adalah perusahaan logistik terkemuka di Indonesia yang berdiri sejak 2010.') }}</p>
                <p class="text-muted">Dimulai dari garasi kecil di Jakarta dengan 3 kendaraan, kini SwiftLogix telah berkembang menjadi salah satu perusahaan logistik terkemuka dengan lebih dari 200 armada kendaraan dan jaringan yang mencakup seluruh nusantara.</p>
                <div class="row g-3 mt-2">
                    @php
                    $milestones = [
                        ['year' => '2010', 'event' => 'SwiftLogix didirikan di Jakarta'],
                        ['year' => '2015', 'event' => 'Ekspansi ke 50 kota besar'],
                        ['year' => '2020', 'event' => 'Peluncuran platform tracking digital'],
                        ['year' => '2025', 'event' => 'Jangkauan 200+ kota di Indonesia'],
                    ];
                    @endphp
                    @foreach($milestones as $m)
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-light">
                            <div class="fw-700 text-orange">{{ $m['year'] }}</div>
                            <div class="small text-muted">{{ $m['event'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="row g-3">
                    @php
                    $values = [
                        ['icon' => 'fas fa-eye', 'title' => 'Visi', 'desc' => 'Menjadi perusahaan logistik nomor satu di Asia Tenggara yang paling dipercaya, inovatif, dan berdampak positif bagi masyarakat.', 'color' => '#F4A025'],
                        ['icon' => 'fas fa-bullseye', 'title' => 'Misi', 'desc' => 'Memberikan layanan logistik berkualitas tinggi yang cepat, aman, dan terjangkau dengan memanfaatkan teknologi terkini.', 'color' => '#0D1B2A'],
                        ['icon' => 'fas fa-gem', 'title' => 'Nilai', 'desc' => 'Integritas, inovasi, kolaborasi, dan komitmen terhadap kepuasan pelanggan adalah fondasi dari setiap langkah kami.', 'color' => '#198754'],
                    ];
                    @endphp
                    @foreach($values as $v)
                    <div class="col-12">
                        <div class="p-4 rounded-3 d-flex gap-3" style="background:{{ $v['color'] }}10; border: 1px solid {{ $v['color'] }}25;">
                            <div style="width:42px;height:42px;background:{{ $v['color'] }};border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;flex-shrink:0;">
                                <i class="{{ $v['icon'] }}"></i>
                            </div>
                            <div>
                                <h6 class="fw-700 mb-1">{{ $v['title'] }}</h6>
                                <p class="text-muted small mb-0">{{ $v['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TEAM -->
@if($team->count())
<section class="section-pad bg-light-custom">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge mx-auto"><i class="fas fa-users"></i> Tim Kami</div>
            <h2 class="section-title">Orang-Orang di Balik SwiftLogix</h2>
            <p class="section-subtitle mx-auto">Tim profesional kami berdedikasi untuk memberikan layanan logistik terbaik bagi Anda.</p>
        </div>
        <div class="row g-4">
            @foreach($team as $member)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="team-card">
                    <div class="team-avatar">
                        @if($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}">
                        @else
                            {{ strtoupper(substr($member->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="team-name">{{ $member->name }}</div>
                    <div class="team-position">{{ $member->position }}</div>
                    <p class="team-bio">{{ Str::limit($member->bio, 100) }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($member->linkedin)
                        <a href="{{ $member->linkedin }}" target="_blank" class="social-btn" style="width:32px;height:32px;font-size:0.8rem;">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        @if($member->twitter)
                        <a href="{{ $member->twitter }}" target="_blank" class="social-btn" style="width:32px;height:32px;font-size:0.8rem;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
