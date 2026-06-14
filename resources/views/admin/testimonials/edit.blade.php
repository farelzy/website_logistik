@extends('layouts.admin')
@section('title', 'Edit Testimoni')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimoni</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit text-orange me-2"></i>Edit Testimoni: {{ $testimonial->name }}</h4>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="form-card">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
            </div>
            <div class="col-md-3"><label class="form-label">Perusahaan</label>
                <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}">
            </div>
            <div class="col-md-3"><label class="form-label">Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $testimonial->position) }}">
            </div>
            <div class="col-12"><label class="form-label">Testimoni</label>
                <textarea name="content" class="form-control" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
            </div>
            <div class="col-md-4"><label class="form-label">Rating</label>
                <select name="rating" class="form-select">
                    @for($i=5;$i>=1;$i--)<option value="{{ $i }}" {{ old('rating',$testimonial->rating)==$i?'selected':'' }}>{{ $i }} Bintang</option>@endfor
                </select>
            </div>
            <div class="col-md-4"><label class="form-label">Foto Baru</label>
                @if($testimonial->photo)<img src="{{ Storage::url($testimonial->photo) }}" class="d-block mb-2 rounded-circle" style="width:50px;height:50px;object-fit:cover;">@endif
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active',$testimonial->is_active)?'checked':'' }}>
                    <label class="form-check-label fw-600">Tampilkan di Website</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Update</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
