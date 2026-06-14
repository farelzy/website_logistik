@extends('layouts.admin')
@section('title', 'Detail Pengiriman')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.shipments.index') }}">Pengiriman</a></li>
<li class="breadcrumb-item active">{{ $shipment->tracking_number }}</li>
@endsection
@section('content')
<div class="page-header">
    <h4><i class="fas fa-search text-orange me-2"></i>Detail Pengiriman: {{ $shipment->tracking_number }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.shipments.edit', $shipment) }}" class="btn btn-outline-primary rounded-pill px-3"><i class="fas fa-edit me-1"></i> Edit</a>
        <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Info Card -->
        <div class="form-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="text-muted small">Nomor Resi</div>
                    <h4 class="fw-800 text-navy">{{ $shipment->tracking_number }}</h4>
                </div>
                <span class="badge bg-{{ $shipment->status_color }} fs-6 px-3 py-2 rounded-pill">{{ $shipment->status_label }}</span>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <div class="text-muted small fw-600 mb-1">PENGIRIM</div>
                        <div class="fw-700">{{ $shipment->sender_name }}</div>
                        <div class="text-muted small">{{ $shipment->sender_address }}</div>
                        @if($shipment->sender_phone)<div class="text-muted small"><i class="fas fa-phone me-1"></i>{{ $shipment->sender_phone }}</div>@endif
                        <div class="fw-600 text-orange small mt-1">{{ $shipment->origin_city }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3">
                        <div class="text-muted small fw-600 mb-1">PENERIMA</div>
                        <div class="fw-700">{{ $shipment->receiver_name }}</div>
                        <div class="text-muted small">{{ $shipment->receiver_address }}</div>
                        @if($shipment->receiver_phone)<div class="text-muted small"><i class="fas fa-phone me-1"></i>{{ $shipment->receiver_phone }}</div>@endif
                        <div class="fw-600 text-orange small mt-1">{{ $shipment->destination_city }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Barang</div>
                    <div class="fw-600">{{ $shipment->description ?? '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Berat</div>
                    <div class="fw-600">{{ $shipment->weight }} kg</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Ongkos Kirim</div>
                    <div class="fw-600">Rp {{ number_format($shipment->shipping_cost, 0, ',', '.') }}</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Estimasi Tiba</div>
                    <div class="fw-600">{{ $shipment->estimated_delivery?->locale('id')->isoFormat('D MMMM Y') ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- History Timeline -->
        <div class="form-card">
            <h6 class="fw-700 text-navy mb-4"><i class="fas fa-route text-orange me-2"></i>Riwayat Pengiriman</h6>
            @if($shipment->histories->count())
            <div class="admin-timeline">
                @foreach($shipment->histories as $h)
                <div class="admin-timeline-item">
                    <div class="fw-700 text-navy">{{ $h->location }}</div>
                    <div class="text-muted small">{{ $h->description }}</div>
                    <div class="text-muted" style="font-size:0.75rem;">{{ $h->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') }}</div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-muted">Belum ada riwayat pengiriman.</p>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Add History -->
        <div class="form-card">
            <h6 class="fw-700 text-navy mb-3"><i class="fas fa-plus-circle text-orange me-2"></i>Tambah Update Status</h6>
            <form action="{{ route('admin.shipments.history', $shipment) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Status Baru</label>
                    <select name="status" class="form-select" required>
                        @foreach(['pending'=>'Menunggu','picked_up'=>'Diambil Kurir','in_transit'=>'Dalam Perjalanan','out_for_delivery'=>'Di Kota Tujuan','delivered'=>'Terkirim','failed'=>'Gagal Kirim','returned'=>'Dikembalikan'] as $val => $label)
                        <option value="{{ $val }}" {{ $shipment->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                    <input type="text" name="location" class="form-control" placeholder="Misal: Hub Jakarta Selatan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat update..."></textarea>
                </div>
                <button type="submit" class="btn btn-orange w-100 rounded-pill"><i class="fas fa-plus me-1"></i> Tambah Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
