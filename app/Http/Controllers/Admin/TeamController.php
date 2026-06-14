<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'position'  => 'required|string|max:100',
            'bio'       => 'nullable|string|max:500',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'linkedin'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $validated['order'] ?? 0;
        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'position'  => 'required|string|max:100',
            'bio'       => 'nullable|string|max:500',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'linkedin'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order']     = $validated['order'] ?? 0;
        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Anggota tim berhasil dihapus.');
    }
}
