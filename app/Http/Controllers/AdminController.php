<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutdoorItem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        return view('admin'); // Pastikan ada file 'admin.blade.php'
    }

    // Menampilkan form untuk menambah barang
    public function create()
    {
        return view('admin_create'); // Pastikan ada file 'admin_create.blade.php'
    }

    // Menyimpan data barang
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        // Mengunggah dan menyimpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storePublicly('', 'public');
        }

        // Menyimpan data ke dalam database
        OutdoorItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stok' => $request->stok,
            'image' => $imagePath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    // Menampilkan semua barang outdoor
    public function showOutdoorItems()
    {
        $outdoorItems = OutdoorItem::all(); // Mengambil semua barang dari database
        return view('admin', compact('outdoorItems')); // Mengembalikan view admin dengan data barang
    }

    // Menampilkan form untuk edit barang
    public function editOutdoorItem($id)
    {
        $item = OutdoorItem::findOrFail($id); // Cari barang berdasarkan ID
        return view('admin.edit-outdoor-item', compact('item')); // Return view edit dengan data barang
    }

    // Memperbarui barang
    public function updateOutdoorItem(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Temukan item berdasarkan ID
        $item = OutdoorItem::findOrFail($id);

        // Update data
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stok = $request->stok;

        // Jika ada gambar baru, proses upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $item->image = $imagePath;
        }

        // Simpan perubahan
        $item->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.outdoor-items')->with('success', 'Barang berhasil diperbarui!');
    }

    // Menghapus barang
    public function destroyOutdoorItem($id)
    {
        $item = OutdoorItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.outdoor-items')->with('success', 'Barang berhasil dihapus');
    
    }

    public function storeOrder(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'items' => 'required|array',
        'phone' => 'required|string|max:15',
        'alamat' => 'required|string',
        'message' => 'nullable|string',
    ]);

    // Simpan data order (contoh: simpan ke database)
    Order::create([
        'items' => json_encode($validated['items']), // Simpan item dalam bentuk JSON
        'phone' => $validated['phone'],
        'alamat' => $validated['alamat'],
        'message' => $validated['message'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Pesanan berhasil dikirim ke admin.');
}

public function showSewa()
{
    // Fetch data from the sewa table along with related outdoor_items and users
    $sewaData = DB::table('sewa')
        ->join('outdoor_items', 'sewa.id_barang', '=', 'outdoor_items.id')
        ->join('users', 'sewa.id_user', '=', 'users.id')
        ->select(
            'sewa.*',
            'outdoor_items.name as item_name',
            'outdoor_items.price as item_price',
            'users.name as user_name',
            'users.email as user_email'
        )
        ->get();

    // Pass data to the admin view
    return view('admin.sewa', ['sewaData' => $sewaData]);
}


}
