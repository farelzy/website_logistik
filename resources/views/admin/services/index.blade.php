@extends('layouts.admin')
@section('title', 'Layanan')
@section('breadcrumb')
<li class="breadcrumb-item active">Layanan</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-concierge-bell text-orange me-2"></i>Manajemen Layanan</h4>
    <a href="{{ route('admin.services.create') }}" class="btn btn-orange">
        <i class="fas fa-plus me-1"></i> Tambah Layanan
    </a>
</div>

<div class="admin-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr><th>#</th><th>Layanan</th><th>Icon</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($services as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="fw-600 text-navy">{{ $s->title }}</div>
                    <div class="text-muted small">{{ Str::limit($s->short_description, 60) }}</div>
                </td>
                <td><i class="{{ $s->icon ?? 'fas fa-truck' }} fs-5 text-orange"></i></td>
                <td>{{ $s->order }}</td>
                <td>
                    @if($s->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-action btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.services.destroy', $s) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-action btn-outline-danger" data-confirm="Yakin ingin menghapus layanan ini?"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data layanan</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $services->links() }}</div>
</div>
@endsection
