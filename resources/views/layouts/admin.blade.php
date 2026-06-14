<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | SwiftLogix Admin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="admin-body">

    <!-- SIDEBAR -->
    <div class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <i class="fas fa-shipping-fast text-warning me-2"></i>
            <span>Swift<span class="text-warning">Logix</span></span>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-group-label">Manajemen</div>

            <a href="{{ route('admin.shipments.index') }}" class="nav-item {{ request()->routeIs('admin.shipments.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i> Pengiriman
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell"></i> Layanan
            </a>
            <a href="{{ route('admin.blog.index') }}" class="nav-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Blog
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fas fa-star"></i> Testimoni
            </a>

            <div class="nav-group-label">Konten</div>

            <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Pesan Masuk
                @php $unread = \App\Models\Contact::unread()->count(); @endphp
                @if($unread > 0)
                    <span class="badge bg-danger ms-auto">{{ $unread }}</span>
                @endif
            </a>
            <a href="{{ route('admin.team.index') }}" class="nav-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Tim Kami
            </a>
            <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Pengaturan
            </a>

            <div class="nav-group-label">Akun</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item w-100 text-start border-0 bg-transparent text-danger">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main" id="adminMain">
        <!-- Top Bar -->
        <div class="admin-topbar">
            <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="breadcrumb-area">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
            <div class="ms-auto d-flex align-items-center gap-2">
                <span class="text-muted small">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
        </div>

        <!-- Content -->
        <div class="admin-content">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('adminSidebar').classList.toggle('collapsed');
            document.getElementById('adminMain').classList.toggle('expanded');
        });

        // Auto-close alert after 4s
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(el);
                bsAlert.close();
            });
        }, 4000);

        // Confirm delete
        document.querySelectorAll('[data-confirm]').forEach(el => {
            el.addEventListener('click', function(e) {
                if (!confirm(this.dataset.confirm || 'Yakin ingin menghapus?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
