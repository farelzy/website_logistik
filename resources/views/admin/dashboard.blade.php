@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="page-header">
    <h4><i class="fas fa-tachometer-alt text-orange me-2"></i>Dashboard</h4>
    <span class="text-muted small">Selamat datang, {{ auth()->user()->name }}</span>
</div>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    @php
    $statCards = [
        ['label' => 'Total Pengiriman',   'value' => $stats['shipments'],       'icon' => 'fas fa-box',          'color' => '#F4A025', 'bg' => '#FFF8EB'],
        ['label' => 'Terkirim',           'value' => $stats['delivered'],        'icon' => 'fas fa-check-circle', 'color' => '#198754', 'bg' => '#E8F5E9'],
        ['label' => 'Dalam Proses',       'value' => $stats['in_transit'],       'icon' => 'fas fa-shipping-fast','color' => '#0D6EFD', 'bg' => '#E8F0FF'],
        ['label' => 'Total Layanan',      'value' => $stats['services'],         'icon' => 'fas fa-concierge-bell','color' => '#6F42C1', 'bg' => '#F3EEFF'],
        ['label' => 'Artikel Blog',       'value' => $stats['blog_posts'],       'icon' => 'fas fa-newspaper',   'color' => '#0DCAF0', 'bg' => '#E8F9FC'],
        ['label' => 'Pesan Masuk',        'value' => $stats['contacts'],         'icon' => 'fas fa-envelope',    'color' => '#DC3545', 'bg' => '#FEE8EA'],
        ['label' => 'Belum Dibaca',       'value' => $stats['unread_contacts'],  'icon' => 'fas fa-bell',        'color' => '#FD7E14', 'bg' => '#FFF1E8'],
        ['label' => 'Testimoni',          'value' => $stats['testimonials'],     'icon' => 'fas fa-star',        'color' => '#20C997', 'bg' => '#E6FAF5'],
    ];
    @endphp

    @foreach($statCards as $card)
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-card-icon" style="background:{{ $card['bg'] }}; color:{{ $card['color'] }};">
                <i class="{{ $card['icon'] }}"></i>
            </div>
            <div class="stat-card-number">{{ $card['value'] }}</div>
            <div class="stat-card-label">{{ $card['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4">
    <!-- Recent Shipments -->
    <div class="col-lg-7">
        <div class="admin-table">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-700 text-navy mb-0"><i class="fas fa-box text-orange me-2"></i>Pengiriman Terbaru</h6>
                <a href="{{ route('admin.shipments.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Lihat Semua</a>
            </div>
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No. Resi</th>
                        <th>Pengirim</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_shipments as $s)
                    <tr>
                        <td><a href="{{ route('admin.shipments.show', $s) }}" class="fw-600 text-navy">{{ $s->tracking_number }}</a></td>
                        <td>{{ Str::limit($s->sender_name, 20) }}</td>
                        <td>{{ $s->destination_city }}</td>
                        <td><span class="badge bg-{{ $s->status_color }}">{{ $s->status_label }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data pengiriman</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-lg-5">
        <div class="admin-table">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-700 text-navy mb-0"><i class="fas fa-envelope text-orange me-2"></i>Pesan Terbaru</h6>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Lihat Semua</a>
            </div>
            @forelse($recent_contacts as $c)
            <div class="p-3 border-bottom d-flex gap-3 align-items-start {{ !$c->is_read ? 'bg-warning bg-opacity-10' : '' }}">
                <div style="width:36px;height:36px;background:var(--navy);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--orange);font-weight:700;font-size:0.8rem;flex-shrink:0;">
                    {{ strtoupper(substr($c->name, 0, 2)) }}
                </div>
                <div class="flex-grow-1 min-w-0">
                    <div class="d-flex justify-content-between">
                        <div class="fw-600 text-navy small">{{ $c->name }}</div>
                        @if(!$c->is_read)<span class="badge bg-danger" style="font-size:0.65rem;">Baru</span>@endif
                    </div>
                    <div class="text-muted" style="font-size:0.78rem;">{{ Str::limit($c->subject, 35) }}</div>
                    <div class="text-muted" style="font-size:0.72rem;">{{ $c->created_at->diffForHumans() }}</div>
                </div>
                <a href="{{ route('admin.contacts.show', $c) }}" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:0.75rem;">Baca</a>
            </div>
            @empty
            <div class="p-4 text-center text-muted small">Belum ada pesan masuk</div>
            @endforelse
        </div>
    </div>
</div>

@endsection
