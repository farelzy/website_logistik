@extends('layouts.frontend')

@section('title', 'Lacak Paket')

@section('content')

<div class="tracking-hero">
    <div class="container text-center" data-aos="fade-up">
        <div class="hero-badge mx-auto"><i class="fas fa-search-location me-1"></i> Tracking</div>
        <h1 class="hero-title mt-3">Lacak Paket Anda</h1>
        <p class="hero-subtitle mx-auto">Masukkan nomor resi untuk mengetahui posisi paket Anda secara real-time.</p>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <!-- SEARCH FORM -->
                <div class="tracking-card mb-4" data-aos="fade-up">
                    <h5 class="fw-700 text-navy mb-3"><i class="fas fa-search text-orange me-2"></i>Cari Nomor Resi</h5>
                    <form method="POST" action="{{ route('tracking.track') }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="tracking_number"
                                class="form-control form-control-lg @error('tracking_number') is-invalid @enderror"
                                placeholder="Masukkan nomor resi (contoh: SWL1A2B3C4)"
                                value="{{ $tracking_number ?? old('tracking_number') }}"
                                required>
                            <button type="submit" class="btn btn-warning px-4 fw-600">
                                <i class="fas fa-search me-1"></i> Lacak
                            </button>
                        </div>
                        @error('tracking_number')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                </div>

                @isset($tracking_number)
                    @if($shipment)
                    <!-- SHIPMENT FOUND -->
                    <div data-aos="fade-up">
                        <!-- Status Card -->
                        <div class="tracking-card mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <div class="text-muted small">Nomor Resi</div>
                                    <h5 class="fw-800 text-navy mb-0">{{ $shipment->tracking_number }}</h5>
                                </div>
                                <span class="badge bg-{{ $shipment->status_color }} fs-6 px-3 py-2 rounded-pill">
                                    {{ $shipment->status_label }}
                                </span>
                            </div>
                            <hr>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="text-muted small fw-600 text-uppercase mb-1">Pengirim</div>
                                    <div class="fw-700">{{ $shipment->sender_name }}</div>
                                    <div class="text-muted small">{{ $shipment->origin_city }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small fw-600 text-uppercase mb-1">Penerima</div>
                                    <div class="fw-700">{{ $shipment->receiver_name }}</div>
                                    <div class="text-muted small">{{ $shipment->destination_city }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small fw-600 text-uppercase mb-1">Deskripsi</div>
                                    <div>{{ $shipment->description ?? '-' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small fw-600 text-uppercase mb-1">Estimasi Tiba</div>
                                    <div>{{ $shipment->estimated_delivery?->locale('id')->isoFormat('D MMMM Y') ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline -->
                        @if($shipment->histories->count())
                        <div class="tracking-card">
                            <h6 class="fw-700 text-navy mb-4"><i class="fas fa-route text-orange me-2"></i>Riwayat Pengiriman</h6>
                            <div class="timeline">
                                @foreach($shipment->histories as $history)
                                <div class="timeline-item {{ $loop->last ? ($shipment->status === 'delivered' ? 'delivered' : 'active') : '' }}">
                                    <div class="timeline-time">{{ $history->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') }}</div>
                                    <div class="timeline-location">{{ $history->location }}</div>
                                    @if($history->description)
                                        <div class="timeline-desc">{{ $history->description }}</div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    @else
                    <!-- NOT FOUND -->
                    <div class="tracking-card text-center" data-aos="fade-up">
                        <i class="fas fa-search-minus fs-1 text-muted mb-3"></i>
                        <h5 class="fw-700 text-navy">Paket Tidak Ditemukan</h5>
                        <p class="text-muted">Nomor resi <strong>{{ $tracking_number }}</strong> tidak ditemukan dalam sistem kami.</p>
                        <p class="text-muted small">Pastikan nomor resi yang Anda masukkan sudah benar, atau hubungi customer service kami.</p>
                        <a href="{{ route('contact') }}" class="btn btn-orange rounded-pill px-4">
                            <i class="fas fa-headset me-2"></i> Hubungi CS
                        </a>
                    </div>
                    @endif
                @endisset

                <!-- INFO BOX -->
                @unless(isset($tracking_number) && $shipment)
                <div class="row g-3 mt-2" data-aos="fade-up">
                    @php
                    $tips = [
                        ['icon' => 'fas fa-receipt', 'title' => 'Nomor Resi', 'desc' => 'Temukan di bukti pengiriman atau email konfirmasi Anda'],
                        ['icon' => 'fas fa-sync-alt', 'title' => 'Update Realtime', 'desc' => 'Status diperbarui setiap kali paket berpindah lokasi'],
                        ['icon' => 'fas fa-phone', 'title' => 'Butuh Bantuan?', 'desc' => 'Hubungi CS kami di ' . \App\Models\Setting::get('company_phone', '+62 21 1234 5678')],
                    ];
                    @endphp
                    @foreach($tips as $tip)
                    <div class="col-md-4">
                        <div class="text-center p-3 rounded-3 bg-light-custom">
                            <i class="{{ $tip['icon'] }} fs-4 text-orange mb-2"></i>
                            <div class="fw-700 small text-navy">{{ $tip['title'] }}</div>
                            <div class="text-muted" style="font-size:0.8rem;">{{ $tip['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endunless

            </div>
        </div>
    </div>
</section>

@endsection
