@extends('layouts.admin')
@section('title', 'Tambah Layanan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Layanan</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus text-orange me-2"></i>Tambah Layanan</h4>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="form-card">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Icon (Font Awesome class)</label>
                <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', 'fas fa-truck') }}" placeholder="fas fa-truck">
                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                <input type="text" name="short_description" class="form-control @error('short_description') is-invalid @enderror" value="{{ old('short_description') }}" maxlength="255">
                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi Lengkap <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-600" for="is_active">Aktif / Tampil di Website</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill">
                <i class="fas fa-save me-1"></i> Simpan Layanan
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
