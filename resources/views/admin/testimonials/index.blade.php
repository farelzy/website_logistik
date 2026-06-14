@extends('layouts.admin')
@section('title', 'Testimoni')
@section('breadcrumb')
<li class="breadcrumb-item active">Testimoni</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-star text-orange me-2"></i>Manajemen Testimoni</h4>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-orange"><i class="fas fa-plus me-1"></i> Tambah Testimoni</a>
</div>
<div class="admin-table">
    <table class="table table-hover mb-0">
        <thead><tr><th>#</th><th>Pelanggan</th><th>Perusahaan</th><th>Rating</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($testimonials as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><div class="fw-600">{{ $t->name }}</div><div class="text-muted small">{{ $t->position }}</div></td>
                <td>{{ $t->company ?? '-' }}</td>
                <td>
                    @for($i=1;$i<=5;$i++)<i class="fa{{ $i<=$t->rating?'s':'r' }} fa-star text-warning" style="font-size:0.8rem;"></i>@endfor
                </td>
                <td>@if($t->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
                <td>
                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-action btn-outline-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-action btn-outline-danger" data-confirm="Hapus testimoni ini?"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data testimoni</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $testimonials->links() }}</div>
</div>
@endsection
