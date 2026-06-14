@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Pesan Masuk</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-envelope-open text-orange me-2"></i>Detail Pesan</h4>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5 class="fw-700 text-navy mb-1">{{ $contact->subject }}</h5>
                    <div class="text-muted small">{{ $contact->created_at->locale('id')->isoFormat('D MMMM Y, HH:mm') }}</div>
                </div>
                <span class="badge {{ $contact->is_read ? 'bg-success' : 'bg-danger' }}">{{ $contact->is_read ? 'Dibaca' : 'Baru' }}</span>
            </div>
            <div class="p-3 bg-light rounded-3 mb-4">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="text-muted small">Dari:</div>
                        <div class="fw-700">{{ $contact->name }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Email:</div>
                        <div><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>
                    </div>
                    @if($contact->phone)
                    <div class="col-md-6">
                        <div class="text-muted small">Telepon:</div>
                        <div>{{ $contact->phone }}</div>
                    </div>
                    @endif
                </div>
            </div>
            <h6 class="fw-700 text-navy mb-2">Isi Pesan:</h6>
            <div class="p-4 bg-light rounded-3" style="white-space:pre-wrap;line-height:1.8;">{{ $contact->message }}</div>

            <div class="mt-4 d-flex gap-2">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-orange rounded-pill px-4">
                    <i class="fas fa-reply me-1"></i> Balas via Email
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4" data-confirm="Hapus pesan ini?">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
