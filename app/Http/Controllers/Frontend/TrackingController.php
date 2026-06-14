<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('frontend.tracking');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string|max:20',
        ], [
            'tracking_number.required' => 'Nomor resi wajib diisi.',
        ]);

        $tracking_number = strtoupper(trim($request->tracking_number));
        $shipment = Shipment::with(['histories' => function ($q) {
            $q->orderBy('created_at', 'asc');
        }])->where('tracking_number', $tracking_number)->first();

        return view('frontend.tracking', compact('shipment', 'tracking_number'));
    }
}
