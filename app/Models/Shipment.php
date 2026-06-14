<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number', 'sender_name', 'sender_address', 'sender_phone',
        'receiver_name', 'receiver_address', 'receiver_phone',
        'description', 'weight', 'origin_city', 'destination_city',
        'status', 'estimated_delivery', 'actual_delivery', 'notes', 'shipping_cost',
    ];

    protected $casts = [
        'estimated_delivery' => 'date',
        'actual_delivery'    => 'datetime',
        'weight'             => 'decimal:2',
        'shipping_cost'      => 'decimal:2',
    ];

    public function histories()
    {
        return $this->hasMany(ShipmentHistory::class)->latest();
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'           => 'Menunggu Pickup',
            'picked_up'         => 'Sudah Diambil',
            'in_transit'        => 'Dalam Pengiriman',
            'out_for_delivery'  => 'Dalam Kota Tujuan',
            'delivered'         => 'Terkirim',
            'failed'            => 'Gagal Kirim',
            'returned'          => 'Dikembalikan',
            default             => 'Unknown',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'           => 'secondary',
            'picked_up'         => 'info',
            'in_transit'        => 'primary',
            'out_for_delivery'  => 'warning',
            'delivered'         => 'success',
            'failed'            => 'danger',
            'returned'          => 'dark',
            default             => 'secondary',
        };
    }

    public static function generateTrackingNumber(): string
    {
        do {
            $number = 'SWL' . strtoupper(substr(uniqid(), -7)) . rand(10, 99);
        } while (self::where('tracking_number', $number)->exists());
        return $number;
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
