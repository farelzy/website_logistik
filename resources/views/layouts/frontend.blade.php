<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'SwiftLogix - Perusahaan logistik terpercaya di Indonesia. Pengiriman cepat, aman, dan terjangkau ke seluruh nusantara.')">
    <meta name="keywords" content="logistik, pengiriman, ekspres, kargo, SwiftLogix">
    <title>@yield('title', 'SwiftLogix') | Delivering Trust, Every Mile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="brand-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <span class="brand-text">Swift<span class="text-warning">Logix</span></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-warning btn-sm px-3 fw-600 rounded-pill" href="{{ route('tracking.index') }}">
                            <i class="fas fa-search me-1"></i> Lacak Paket
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-dark">
        <div class="container">
            <div class="row g-4 py-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="brand-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <span class="fs-4 fw-800 text-white">Swift<span class="text-warning">Logix</span></span>
                    </div>
                    <p class="text-muted-light mb-3">{{ \App\Models\Setting::get('company_tagline', 'Delivering Trust, Every Mile') }}</p>
                    <p class="text-muted-light small">{{ \App\Models\Setting::get('company_about', '') }}</p>
                    <div class="social-links mt-3 d-flex gap-2">
                        @if(\App\Models\Setting::get('facebook'))
                        <a href="{{ \App\Models\Setting::get('facebook') }}" target="_blank" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if(\App\Models\Setting::get('instagram'))
                        <a href="{{ \App\Models\Setting::get('instagram') }}" target="_blank" class="social-btn"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(\App\Models\Setting::get('twitter'))
                        <a href="{{ \App\Models\Setting::get('twitter') }}" target="_blank" class="social-btn"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if(\App\Models\Setting::get('linkedin'))
                        <a href="{{ \App\Models\Setting::get('linkedin') }}" target="_blank" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <h6 class="footer-heading">Layanan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('services.index') }}">Pengiriman Ekspres</a></li>
                        <li><a href="{{ route('services.index') }}">Kargo Darat</a></li>
                        <li><a href="{{ route('services.index') }}">Kargo Laut</a></li>
                        <li><a href="{{ route('services.index') }}">Kargo Udara</a></li>
                        <li><a href="{{ route('services.index') }}">Cold Chain</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6">
                    <h6 class="footer-heading">Perusahaan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog & Berita</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                        <li><a href="{{ route('tracking.index') }}">Lacak Paket</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h6 class="footer-heading">Hubungi Kami</h6>
                    <ul class="footer-links contact-list">
                        <li>
                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                            {{ \App\Models\Setting::get('company_address', 'Jakarta, Indonesia') }}
                        </li>
                        <li>
                            <i class="fas fa-phone text-warning me-2"></i>
                            {{ \App\Models\Setting::get('company_phone', '+62 21 1234 5678') }}
                        </li>
                        <li>
                            <i class="fab fa-whatsapp text-warning me-2"></i>
                            {{ \App\Models\Setting::get('company_whatsapp', '+6281234567890') }}
                        </li>
                        <li>
                            <i class="fas fa-envelope text-warning me-2"></i>
                            {{ \App\Models\Setting::get('company_email', 'info@swiftlogix.id') }}
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="footer-divider">

            <div class="row py-3">
                <div class="col-md-6">
                    <p class="text-muted-light small mb-0">&copy; {{ date('Y') }} SwiftLogix. Hak cipta dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted-light small mb-0">Dibuat dengan <i class="fas fa-heart text-danger"></i> di Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Init AOS
        AOS.init({ duration: 700, once: true, offset: 80 });

        // Navbar scroll effect
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>

    @stack('scripts')
</body>
</html>
