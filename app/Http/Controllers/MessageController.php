<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pesan Anda berhasil dikirim! Tim SMARTEDU akan segera merespons.'
            ]);
        }

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.');
    }
}
