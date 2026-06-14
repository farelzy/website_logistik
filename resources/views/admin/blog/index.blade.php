@extends('layouts.admin')
@section('title', 'Blog')
@section('breadcrumb')
<li class="breadcrumb-item active">Blog</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-newspaper text-orange me-2"></i>Manajemen Blog</h4>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-orange"><i class="fas fa-plus me-1"></i> Tambah Artikel</a>
</div>

<div class="admin-table">
    <table class="table table-hover mb-0">
        <thead><tr><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Views</th><th>Status</th><th>Tgl Publish</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($posts as $p)
            <tr>
                <td>
                    <div class="fw-600 text-navy">{{ Str::limit($p->title, 50) }}</div>
                    <div class="text-muted small">{{ $p->slug }}</div>
                </td>
                <td><span class="badge bg-secondary">{{ $p->category }}</span></td>
                <td>{{ $p->author?->name ?? 'Admin' }}</td>
                <td>{{ $p->views }}</td>
                <td>
                    @if($p->is_published) <span class="badge bg-success">Terbit</span>
                    @else <span class="badge bg-warning text-dark">Draft</span>
                    @endif
                </td>
                <td><small>{{ $p->published_at?->format('d/m/Y') ?? '-' }}</small></td>
                <td>
                    <a href="{{ route('admin.blog.edit', $p) }}" class="btn btn-action btn-outline-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.blog.destroy', $p) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-action btn-outline-danger" data-confirm="Hapus artikel ini?"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted py-4">Belum ada artikel</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $posts->links() }}</div>
</div>
@endsection
