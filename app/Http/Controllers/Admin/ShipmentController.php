<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentHistory;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('tracking_number', 'like', "%{$s}%")
                  ->orWhere('sender_name', 'like', "%{$s}%")
                  ->orWhere('receiver_name', 'like', "%{$s}%");
            });
        }

        $shipments = $query->paginate(15);
        return view('admin.shipments.index', compact('shipments'));
    }

    public function create()
    {
        $tracking_number = Shipment::generateTrackingNumber();
        return view('admin.shipments.create', compact('tracking_number'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tracking_number'   => 'required|unique:shipments',
            'sender_name'       => 'required|string|max:150',
            'sender_address'    => 'required|string',
            'sender_phone'      => 'nullable|string|max:20',
            'receiver_name'     => 'required|string|max:150',
            'receiver_address'  => 'required|string',
            'receiver_phone'    => 'nullable|string|max:20',
            'description'       => 'nullable|string|max:255',
            'weight'            => 'required|numeric|min:0.01',
            'origin_city'       => 'required|string|max:100',
            'destination_city'  => 'required|string|max:100',
            'status'            => 'required|in:pending,picked_up,in_transit,out_for_delivery,delivered,failed,returned',
            'estimated_delivery'=> 'nullable|date|after_or_equal:today',
            'shipping_cost'     => 'nullable|numeric|min:0',
            'notes'             => 'nullable|string',
        ]);

        $shipment = Shipment::create($validated);

        // Auto create first history
        ShipmentHistory::create([
            'shipment_id' => $shipment->id,
            'status'      => 'pending',
            'location'    => $shipment->origin_city,
            'description' => 'Paket diterima di gudang origin ' . $shipment->origin_city,
        ]);

        return redirect()->route('admin.shipments.show', $shipment)->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    public function show(Shipment $shipment)
    {
        $shipment->load(['histories' => fn ($q) => $q->orderBy('created_at')]);
        return view('admin.shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'sender_name'       => 'required|string|max:150',
            'sender_address'    => 'required|string',
            'sender_phone'      => 'nullable|string|max:20',
            'receiver_name'     => 'required|string|max:150',
            'receiver_address'  => 'required|string',
            'receiver_phone'    => 'nullable|string|max:20',
            'description'       => 'nullable|string|max:255',
            'weight'            => 'required|numeric|min:0.01',
            'origin_city'       => 'required|string|max:100',
            'destination_city'  => 'required|string|max:100',
            'status'            => 'required|in:pending,picked_up,in_transit,out_for_delivery,delivered,failed,returned',
            'estimated_delivery'=> 'nullable|date',
            'shipping_cost'     => 'nullable|numeric|min:0',
            'notes'             => 'nullable|string',
        ]);

        $shipment->update($validated);

        return redirect()->route('admin.shipments.show', $shipment)->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->histories()->delete();
        $shipment->delete();
        return redirect()->route('admin.shipments.index')->with('success', 'Data pengiriman berhasil dihapus.');
    }

    public function addHistory(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'status'      => 'required|string|max:50',
            'location'    => 'required|string|max:150',
            'description' => 'nullable|string|max:500',
        ]);

        $validated['shipment_id'] = $shipment->id;
        ShipmentHistory::create($validated);

        // Update shipment status
        $shipment->update(['status' => $validated['status']]);

        if ($validated['status'] === 'delivered') {
            $shipment->update(['actual_delivery' => now()]);
        }

        return redirect()->route('admin.shipments.show', $shipment)->with('success', 'Riwayat pengiriman berhasil ditambahkan.');
    }
}
