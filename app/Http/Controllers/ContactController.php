<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'message' => 'required|max:1000',
        ]);

        // sementara hanya simulasi kirim pesan
        // nanti bisa kirim ke email / database / admin panel

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
