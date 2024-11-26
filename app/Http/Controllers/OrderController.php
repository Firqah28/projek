<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $validated = $request->validate([
            'items' => 'required|array',          // Barang yang dipilih
            'phone' => 'required|string|max:15', // Nomor telepon
            'address' => 'required|string|max:255', // Alamat
            'message' => 'nullable|string',      // Pesan (opsional)
        ]);



        // Simpan data ke database
        Order::create([
            'items' => json_encode($validated['items']), // Barang disimpan sebagai JSON
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'message' => $validated['message'],
        ]);

        // Redirect ke halaman sewa dengan pesan sukses
        return redirect()->back()->with('success', 'Pesanan berhasil dikirim.');
    }

    
}
    