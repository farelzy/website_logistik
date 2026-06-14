@extends('layouts.admin')
@section('title', 'Tim Kami')
@section('breadcrumb')
<li class="breadcrumb-item active">Tim Kami</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-users text-orange me-2"></i>Manajemen Tim</h4>
    <a href="{{ route('admin.team.create') }}" class="btn btn-orange"><i class="fas fa-plus me-1"></i> Tambah Anggota</a>
</div>
<div class="admin-table">
    <table class="table table-hover mb-0">
        <thead><tr><th>Urutan</th><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($members as $m)
            <tr>
                <td>{{ $m->order }}</td>
                <td>
                    <div style="width:40px;height:40px;border-radius:50%;background:var(--navy);display:flex;align-items:center;justify-content:center;color:var(--orange);font-weight:700;overflow:hidden;">
                        @if($m->photo)<img src="{{ Storage::url($m->photo) }}" style="width:100%;height:100%;object-fit:cover;">
                        @else {{ strtoupper(substr($m->name,0,2)) }}@endif
                    </div>
                </td>
                <td class="fw-600">{{ $m->name }}</td>
                <td class="text-muted">{{ $m->position }}</td>
                <td>@if($m->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
                <td>
                    <a href="{{ route('admin.team.edit', $m) }}" class="btn btn-action btn-outline-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.team.destroy', $m) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-action btn-outline-danger" data-confirm="Hapus anggota tim ini?"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada anggota tim</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $members->links() }}</div>
</div>
@endsection
