<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:200',
            'short_description' => 'required|string|max:255',
            'description'       => 'required|string',
            'icon'              => 'nullable|string|max:100',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'             => 'nullable|integer|min:0',
            'is_active'         => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug']      = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $validated['order'] ?? 0;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:200',
            'short_description' => 'required|string|max:255',
            'description'       => 'required|string',
            'icon'              => 'nullable|string|max:100',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order'             => 'nullable|integer|min:0',
            'is_active'         => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug']      = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['order']     = $validated['order'] ?? 0;

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
