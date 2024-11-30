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
            'items' => 'required|array', // Item yang dipilih
            'quantities' => 'required|array', // Kuantitas tiap item
            'phone' => 'required|string|max:20', // Nomor telepon
            'alamat' => 'required|string|max:255', // Alamat
            'metode_pembayaran' => 'required|string|in:Transfer Bank,Tunai', // Metode pembayaran
            'total_harga' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi bukti pembayaran
            'tanggal_pemesanan' => 'required|date', // Tanggal pemesanan
            'jaminan' => 'required|string', // Validasi untuk jaminan
            'tanggal_pengembalian' => 'required|date', // Tanggal pengembalian
        ]);

        $userId = auth()->id(); // Automatically fetch authenticated user ID

        $buktiPembayaranPath = null;
        if ($request->metode_pembayaran === 'Transfer Bank' && $request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->move(
                public_path('uploads/bukti_pembayaran'),
                $request->file('bukti_pembayaran')->getClientOriginalName()
            );
            $buktiPembayaranPath = 'uploads/bukti_pembayaran/' . $request->file('bukti_pembayaran')->getClientOriginalName();
        }


        DB::transaction(function () use ($validated, $userId , $buktiPembayaranPath) {
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
                    'total_harga' => $validated['total_harga'],
                    'bukti_pembayaran' => $buktiPembayaranPath, // Path file bukti pembayaran
                    'tanggal_pemesanan' => $validated['tanggal_pemesanan'], // Save tanggal pemesanan
                    'tanggal_pengembalian' => $validated['tanggal_pengembalian'], // Save tanggal pengembalian
                    'jaminan' => $validated['jaminan'], // Menambahkan jaminan ke dalam tabel
                ]);
            }
        });
        
        
        return redirect()->back()->with('success', 'Order placed successfully!');
    }

    public function history()
    {
        $userId = auth()->id(); // Ambil ID pengguna yang sedang login

        $orders = DB::table('sewa')
            ->join('outdoor_items', 'sewa.id_barang', '=', 'outdoor_items.id')
            ->select(
                'sewa.*',
                'outdoor_items.name as item_name',
                'outdoor_items.price as item_price'
            )
            ->where('sewa.id_user', $userId) // Hanya riwayat untuk pengguna saat ini
            ->orderBy('sewa.created_at', 'desc')
            ->get();

        return view('history', compact('orders'));
    }

    public function showOutdoorItemsCategory()
    {
        // Ambil semua barang dan kelompokkan berdasarkan kategori
    $groupedItems = OutdoorItem::all()->groupBy('kategori');

    // Kirim data ke view
    return view('sewa', compact('groupedItems'));
    }
    
    
}