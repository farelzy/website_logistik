@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('breadcrumb')
<li class="breadcrumb-item active">Pesan Masuk</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-envelope text-orange me-2"></i>Pesan Masuk</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.contacts.index', ['status'=>'unread']) }}" class="btn btn-sm {{ request('status')==='unread' ? 'btn-orange' : 'btn-outline-secondary' }} rounded-pill px-3">Belum Dibaca</a>
        <a href="{{ route('admin.contacts.index', ['status'=>'read']) }}" class="btn btn-sm {{ request('status')==='read' ? 'btn-orange' : 'btn-outline-secondary' }} rounded-pill px-3">Sudah Dibaca</a>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-navy' : 'btn-outline-secondary' }} rounded-pill px-3">Semua</a>
    </div>
</div>

<div class="admin-table">
    <table class="table table-hover mb-0">
        <thead><tr><th>Pengirim</th><th>Email</th><th>Subjek</th><th>Telepon</th><th>Diterima</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($contacts as $c)
            <tr class="{{ !$c->is_read ? 'fw-600' : '' }}">
                <td>{{ $c->name }}</td>
                <td class="text-muted small">{{ $c->email }}</td>
                <td>{{ Str::limit($c->subject, 40) }}</td>
                <td class="text-muted small">{{ $c->phone ?? '-' }}</td>
                <td class="text-muted small">{{ $c->created_at->diffForHumans() }}</td>
                <td>@if(!$c->is_read)<span class="badge bg-danger">Baru</span>@else<span class="badge bg-success">Dibaca</span>@endif</td>
                <td>
                    <a href="{{ route('admin.contacts.show', $c) }}" class="btn btn-action btn-outline-primary"><i class="fas fa-eye"></i></a>
                    <form action="{{ route('admin.contacts.destroy', $c) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-action btn-outline-danger" data-confirm="Hapus pesan ini?"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada pesan</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $contacts->links() }}</div>
</div>
@endsection
