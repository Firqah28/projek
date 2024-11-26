<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\OutdoorItem;

class OutdoorController extends Controller
{
    //
    public function index()
    {
        $outdoorItems = OutdoorItem::where('stok', '>', 0)->get();
        return view('sewa', compact('outdoorItems'));
    }

    public function placeOrder(Request $request)
        {
            // Validate inputs
            $validated = $request->validate([
                'items' => 'required|array', // Array of selected item IDs
                'quantities' => 'required|array', // Quantities for each item
                'phone' => 'required|string|max:20', // Phone number validation
                'alamat' => 'required|string|max:255', // Address validation
                'metode_pembayaran' => 'required|string|in:Transfer Bank,Tunai',
                'total_harga' => 'required|numeric|min:0', // Total harga validation
            ]);

            $userId = auth()->id(); // Automatically fetch authenticated user ID

            DB::transaction(function () use ($validated, $userId) {
                foreach ($validated['items'] as $itemId) {
                    $quantity = $validated['quantities'][$itemId] ?? 0;

                    // Fetch the item from the database
                    $outdoorItem = OutdoorItem::findOrFail($itemId);

                    // Check if stock is sufficient
                    if ($outdoorItem->stok < $quantity) {
                        throw new \Exception("Stock insufficient for item: " . $outdoorItem->name);
                    }

                    // Reduce stock
                    $outdoorItem->stok -= $quantity;
                    $outdoorItem->save();

                    // Insert order data into sewa table
                    DB::table('sewa')->insert([
                        'id_user' => $userId,
                        'id_barang' => $itemId,
                        'jumlah_barang' => $quantity,
                        'no_hp' => $validated['phone'],
                        'alamat' => $validated['alamat'],
                        'metode_pembayaran' => $validated['metode_pembayaran'], // Save payment method
                        'total_harga' => $validated['total_harga'], // Save total harga
                    ]);
                }
            });

            return redirect()->back()->with('success', 'Order placed successfully! Total Harga: Rp' . number_format($validated['total_harga'], 0, ',', '.'));
        }
    
    
    
}
