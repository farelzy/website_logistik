@extends('layouts.admin')
@section('title', 'Pengiriman')
@section('breadcrumb')
<li class="breadcrumb-item active">Pengiriman</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-box text-orange me-2"></i>Manajemen Pengiriman</h4>
    <a href="{{ route('admin.shipments.create') }}" class="btn btn-orange">
        <i class="fas fa-plus me-1"></i> Tambah Pengiriman
    </a>
</div>

<!-- Filter -->
<div class="form-card mb-4 py-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari resi, pengirim, penerima..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                @foreach(['pending','picked_up','in_transit','out_for_delivery','delivered','failed','returned'] as $st)
                <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$st)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-navy rounded-pill px-3"><i class="fas fa-search me-1"></i> Filter</button>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary rounded-pill px-3">Reset</a>
        </div>
    </form>
</div>

<div class="admin-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr><th>Resi</th><th>Pengirim</th><th>Penerima</th><th>Rute</th><th>Berat</th><th>Status</th><th>Tgl Dibuat</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($shipments as $s)
            <tr>
                <td><a href="{{ route('admin.shipments.show', $s) }}" class="fw-700 text-navy">{{ $s->tracking_number }}</a></td>
                <td>{{ Str::limit($s->sender_name, 18) }}</td>
                <td>{{ Str::limit($s->receiver_name, 18) }}</td>
                <td><small class="text-muted">{{ $s->origin_city }} → {{ $s->destination_city }}</small></td>
                <td>{{ $s->weight }} kg</td>
                <td><span class="badge bg-{{ $s->status_color }}">{{ $s->status_label }}</span></td>
                <td><small>{{ $s->created_at->format('d/m/Y') }}</small></td>
                <td>
                    <a href="{{ route('admin.shipments.show', $s) }}" class="btn btn-action btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('admin.shipments.edit', $s) }}" class="btn btn-action btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.shipments.destroy', $s) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-action btn-outline-danger" data-confirm="Hapus data pengiriman {{ $s->tracking_number }}?"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pengiriman</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $shipments->withQueryString()->links() }}</div>
</div>
@endsection
