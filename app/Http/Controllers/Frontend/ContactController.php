<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'subject.required' => 'Subjek wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min'      => 'Pesan minimal 10 karakter.',
        ]);

        Contact::create($validated);

        return redirect()->route('contact')->with('success', 'Pesan Anda telah terkirim! Kami akan menghubungi Anda segera.');
    }
}
