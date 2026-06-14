@extends('layouts.admin')
@section('title', 'Pengaturan Situs')
@section('breadcrumb')
<li class="breadcrumb-item active">Pengaturan</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-cog text-orange me-2"></i>Pengaturan Situs</h4>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf

    @foreach($settings as $group => $groupSettings)
    <div class="form-card mb-4">
        <h5 class="fw-700 text-navy mb-4 text-capitalize border-bottom pb-3">
            <i class="fas fa-{{ $group === 'general' ? 'building' : ($group === 'contact' ? 'phone' : 'share-alt') }} text-orange me-2"></i>
            {{ $group === 'general' ? 'Informasi Umum' : ($group === 'contact' ? 'Informasi Kontak' : 'Media Sosial') }}
        </h5>
        <div class="row g-3">
            @foreach($groupSettings as $setting)
            <div class="{{ in_array($setting->key, ['company_about']) ? 'col-12' : 'col-md-6' }}">
                <label class="form-label">{{ $setting->label ?? $setting->key }}</label>
                @if(in_array($setting->key, ['company_about']))
                    <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="4">{{ $setting->value }}</textarea>
                @else
                    <input type="text" name="settings[{{ $setting->key }}]" class="form-control" value="{{ $setting->value }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-orange px-4 rounded-pill">
            <i class="fas fa-save me-1"></i> Simpan Semua Pengaturan
        </button>
    </div>
</form>
@endsection
