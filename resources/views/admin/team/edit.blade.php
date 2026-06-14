@extends('layouts.admin')
@section('title', 'Edit Anggota Tim')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Tim</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit text-orange me-2"></i>Edit: {{ $team->name }}</h4>
    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="form-card">
    <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}" required>
            </div>
            <div class="col-md-6"><label class="form-label">Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $team->position) }}" required>
            </div>
            <div class="col-12"><label class="form-label">Bio Singkat</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio', $team->bio) }}</textarea>
            </div>
            <div class="col-md-4"><label class="form-label">Foto Baru</label>
                @if($team->photo)<img src="{{ Storage::url($team->photo) }}" class="d-block mb-2 rounded-circle" style="width:60px;height:60px;object-fit:cover;">@endif
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4"><label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $team->linkedin) }}">
            </div>
            <div class="col-md-4"><label class="form-label">Twitter URL</label>
                <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $team->twitter) }}">
            </div>
            <div class="col-md-4"><label class="form-label">Urutan Tampil</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $team->order) }}" min="0">
            </div>
            <div class="col-md-8 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-600">Tampilkan di Website</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Update</button>
            <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
