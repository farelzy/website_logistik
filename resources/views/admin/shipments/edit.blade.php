@extends('layouts.admin')
@section('title', 'Edit Pengiriman')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.shipments.index') }}">Pengiriman</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit text-orange me-2"></i>Edit Pengiriman: {{ $shipment->tracking_number }}</h4>
    <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>

<div class="form-card">
    <form action="{{ route('admin.shipments.update', $shipment) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Resi</label>
                <input type="text" class="form-control fw-700 bg-light" value="{{ $shipment->tracking_number }}" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    @foreach(['pending'=>'Menunggu','picked_up'=>'Diambil','in_transit'=>'Dalam Perjalanan','out_for_delivery'=>'Kota Tujuan','delivered'=>'Terkirim','failed'=>'Gagal','returned'=>'Dikembalikan'] as $val => $label)
                    <option value="{{ $val }}" {{ old('status', $shipment->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Berat (kg) <span class="text-danger">*</span></label>
                <input type="number" name="weight" class="form-control" value="{{ old('weight', $shipment->weight) }}" step="0.01" min="0.01" required>
            </div>

            <div class="col-12"><h6 class="fw-700 text-navy border-bottom pb-2">Data Pengirim</h6></div>
            <div class="col-md-4">
                <label class="form-label">Nama Pengirim</label>
                <input type="text" name="sender_name" class="form-control" value="{{ old('sender_name', $shipment->sender_name) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="sender_phone" class="form-control" value="{{ old('sender_phone', $shipment->sender_phone) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kota Asal</label>
                <input type="text" name="origin_city" class="form-control" value="{{ old('origin_city', $shipment->origin_city) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Alamat Pengirim</label>
                <textarea name="sender_address" class="form-control" rows="2" required>{{ old('sender_address', $shipment->sender_address) }}</textarea>
            </div>

            <div class="col-12"><h6 class="fw-700 text-navy border-bottom pb-2">Data Penerima</h6></div>
            <div class="col-md-4">
                <label class="form-label">Nama Penerima</label>
                <input type="text" name="receiver_name" class="form-control" value="{{ old('receiver_name', $shipment->receiver_name) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="receiver_phone" class="form-control" value="{{ old('receiver_phone', $shipment->receiver_phone) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kota Tujuan</label>
                <input type="text" name="destination_city" class="form-control" value="{{ old('destination_city', $shipment->destination_city) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Alamat Penerima</label>
                <textarea name="receiver_address" class="form-control" rows="2" required>{{ old('receiver_address', $shipment->receiver_address) }}</textarea>
            </div>

            <div class="col-md-4">
                <label class="form-label">Deskripsi Barang</label>
                <input type="text" name="description" class="form-control" value="{{ old('description', $shipment->description) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Estimasi Tiba</label>
                <input type="date" name="estimated_delivery" class="form-control" value="{{ old('estimated_delivery', $shipment->estimated_delivery?->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Ongkos Kirim</label>
                <input type="number" name="shipping_cost" class="form-control" value="{{ old('shipping_cost', $shipment->shipping_cost) }}" min="0">
            </div>
            <div class="col-12">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="2">{{ old('notes', $shipment->notes) }}</textarea>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-orange px-4 rounded-pill"><i class="fas fa-save me-1"></i> Update</button>
            <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
