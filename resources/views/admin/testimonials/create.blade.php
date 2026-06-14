@extends('layouts.admin')
@section('title', 'Tambah Testimoni')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimoni</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus text-orange me-2"></i>Tambah Testimoni</h4>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="form-card">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3"><label class="form-label">Perusahaan</label>
                <input type="text" name="company" class="form-control" value="{{ old('company') }}">
            </div>
            <div class="col-md-3"><label class="form-label">Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}">
            </div>
            <div class="col-12"><label class="form-label">Testimoni <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4" required>{{ old('content') }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4"><label class="form-label">Rating (1-5) <span class="text-danger">*</span></label>
                <select name="rating" class="form-select" required>
                    @for($i=5;$i>=1;$i--)<option value="{{ $i }}" {{ old('rating','5')==$i?'selected':'' }}>{{ $i }} Bintang</option>@endfor
                </select>
            </div>
            <div class="col-md-4"><label class="form-label">Foto</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label fw-600">Tampilkan di Website</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Simpan</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
