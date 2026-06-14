<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings'        => 'array',
            'settings.*'      => 'nullable|string',
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
