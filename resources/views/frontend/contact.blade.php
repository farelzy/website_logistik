@extends('layouts.frontend')

@section('title', 'Kontak Kami')

@section('content')

<div class="page-hero">
    <div class="container text-center" data-aos="fade-up">
        <div class="hero-badge mx-auto"><i class="fas fa-envelope me-1"></i> Kontak</div>
        <h1 class="hero-title mt-3">Hubungi Kami</h1>
        <p class="hero-subtitle mx-auto">Ada pertanyaan atau butuh penawaran? Tim kami siap membantu Anda.</p>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-4" data-aos="fade-right">
                <h4 class="fw-700 text-navy mb-4">Informasi Kontak</h4>

                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="fw-700 text-navy mb-1">Alamat</div>
                        <div class="text-muted small">{{ \App\Models\Setting::get('company_address', 'Jakarta, Indonesia') }}</div>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="fw-700 text-navy mb-1">Telepon</div>
                        <div class="text-muted small">{{ \App\Models\Setting::get('company_phone', '+62 21 1234 5678') }}</div>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <div class="fw-700 text-navy mb-1">WhatsApp</div>
                        <div class="text-muted small">
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', \App\Models\Setting::get('company_whatsapp', '62812345')) }}" target="_blank" class="text-muted">
                                {{ \App\Models\Setting::get('company_whatsapp') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="fw-700 text-navy mb-1">Email</div>
                        <div class="text-muted small">{{ \App\Models\Setting::get('company_email', 'info@swiftlogix.id') }}</div>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="fw-700 text-navy mb-1">Jam Operasional</div>
                        <div class="text-muted small">Senin – Jumat: 08.00 – 17.00<br>Sabtu: 08.00 – 13.00</div>
                    </div>
                </div>

                <!-- Social Media -->
                <h6 class="fw-700 text-navy mb-3 mt-2">Ikuti Kami</h6>
                <div class="d-flex gap-2">
                    @if(\App\Models\Setting::get('facebook'))
                        <a href="{{ \App\Models\Setting::get('facebook') }}" target="_blank" class="social-btn" style="background:#e9ecef;color:#555;"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(\App\Models\Setting::get('instagram'))
                        <a href="{{ \App\Models\Setting::get('instagram') }}" target="_blank" class="social-btn" style="background:#e9ecef;color:#555;"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(\App\Models\Setting::get('twitter'))
                        <a href="{{ \App\Models\Setting::get('twitter') }}" target="_blank" class="social-btn" style="background:#e9ecef;color:#555;"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(\App\Models\Setting::get('linkedin'))
                        <a href="{{ \App\Models\Setting::get('linkedin') }}" target="_blank" class="social-btn" style="background:#e9ecef;color:#555;"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8" data-aos="fade-left">
                @if(session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                    <i class="fas fa-check-circle fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
                @endif

                <div class="p-4 p-lg-5 bg-light-custom rounded-3 border">
                    <h4 class="fw-700 text-navy mb-4">Kirim Pesan</h4>
                    <form method="POST" action="{{ route('contact.store') }}" id="contactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email@contoh.com" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="+62 812 3456 7890" value="{{ old('phone') }}">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subjek <span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                                    placeholder="Perihal pesan Anda" value="{{ old('subject') }}" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                    rows="6" placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-orange px-5 py-3 rounded-pill fw-600">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
