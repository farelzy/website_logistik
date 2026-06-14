@extends('layouts.admin')
@section('title', 'Tambah Pengiriman')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.shipments.index') }}">Pengiriman</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus text-orange me-2"></i>Tambah Pengiriman Baru</h4>
    <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>

<div class="form-card">
    <form action="{{ route('admin.shipments.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Resi <span class="text-danger">*</span></label>
                <input type="text" name="tracking_number" class="form-control fw-700 @error('tracking_number') is-invalid @enderror"
                    value="{{ old('tracking_number', $tracking_number) }}" required readonly>
                @error('tracking_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    @foreach(['pending'=>'Menunggu','picked_up'=>'Diambil','in_transit'=>'Dalam Perjalanan','out_for_delivery'=>'Kota Tujuan','delivered'=>'Terkirim','failed'=>'Gagal','returned'=>'Dikembalikan'] as $val => $label)
                    <option value="{{ $val }}" {{ old('status', 'pending') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Berat (kg) <span class="text-danger">*</span></label>
                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', '1') }}" step="0.01" min="0.01" required>
                @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><h6 class="fw-700 text-navy border-bottom pb-2">Data Pengirim</h6></div>
            <div class="col-md-4">
                <label class="form-label">Nama Pengirim <span class="text-danger">*</span></label>
                <input type="text" name="sender_name" class="form-control @error('sender_name') is-invalid @enderror" value="{{ old('sender_name') }}" required>
                @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">No. Telepon Pengirim</label>
                <input type="text" name="sender_phone" class="form-control" value="{{ old('sender_phone') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kota Asal <span class="text-danger">*</span></label>
                <input type="text" name="origin_city" class="form-control @error('origin_city') is-invalid @enderror" value="{{ old('origin_city') }}" required>
                @error('origin_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Alamat Pengirim <span class="text-danger">*</span></label>
                <textarea name="sender_address" class="form-control @error('sender_address') is-invalid @enderror" rows="2" required>{{ old('sender_address') }}</textarea>
                @error('sender_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><h6 class="fw-700 text-navy border-bottom pb-2">Data Penerima</h6></div>
            <div class="col-md-4">
                <label class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                <input type="text" name="receiver_name" class="form-control @error('receiver_name') is-invalid @enderror" value="{{ old('receiver_name') }}" required>
                @error('receiver_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">No. Telepon Penerima</label>
                <input type="text" name="receiver_phone" class="form-control" value="{{ old('receiver_phone') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kota Tujuan <span class="text-danger">*</span></label>
                <input type="text" name="destination_city" class="form-control @error('destination_city') is-invalid @enderror" value="{{ old('destination_city') }}" required>
                @error('destination_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Alamat Penerima <span class="text-danger">*</span></label>
                <textarea name="receiver_address" class="form-control @error('receiver_address') is-invalid @enderror" rows="2" required>{{ old('receiver_address') }}</textarea>
                @error('receiver_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><h6 class="fw-700 text-navy border-bottom pb-2">Detail Paket</h6></div>
            <div class="col-md-4">
                <label class="form-label">Deskripsi Barang</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Misal: Elektronik, Dokumen">
            </div>
            <div class="col-md-4">
                <label class="form-label">Estimasi Tiba</label>
                <input type="date" name="estimated_delivery" class="form-control" value="{{ old('estimated_delivery') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Ongkos Kirim (Rp)</label>
                <input type="number" name="shipping_cost" class="form-control" value="{{ old('shipping_cost', 0) }}" min="0">
            </div>
            <div class="col-12">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Simpan</button>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
