@extends('layouts.admin')
@section('title', 'Tambah Artikel')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus text-orange me-2"></i>Tambah Artikel</h4>
    <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="form-card">
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category', 'Berita') }}" list="category-list" required>
                <datalist id="category-list">
                    <option>Berita</option><option>Tips & Trik</option><option>Edukasi</option><option>Promo</option>
                </datalist>
            </div>
            <div class="col-12">
                <label class="form-label">Ringkasan</label>
                <textarea name="excerpt" class="form-control" rows="2" placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                <textarea name="content" id="contentEditor" class="form-control @error('content') is-invalid @enderror" rows="12">{{ old('content') }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Gambar Thumbnail</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6 d-flex align-items-end gap-3">
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                    <label class="form-check-label fw-600" for="is_published">Terbitkan Sekarang</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Simpan Artikel</button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
