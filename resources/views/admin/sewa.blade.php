<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Sewa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 bg-opacity-50 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-white mb-4">Tabel Data Sewa</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto bg-gray-900 bg-opacity-70 text-white border border-gray-700 rounded-lg">
                        <thead>
                            <tr class="text-left bg-gray-700">
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Nama User</th>
                                <th class="border px-4 py-2">Barang</th>
                                <th class="border px-4 py-2">Jumlah</th>
                                <th class="border px-4 py-2">Total Harga</th>
                                <th class="border px-4 py-2">No HP</th>
                                <th class="border px-4 py-2">Alamat</th>
                                <th class="border px-4 py-2">Metode Pembayaran</th>
                                <th class="border px-4 py-2">Tanggal Pemesanan</th>
                                <th class="border px-4 py-2">Tanggal Pengembalian</th>
                                <th class="border px-4 py-2">Jaminan</th>
                                <th class="border px-4 py-2">Bukti Pembayaran</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sewaData as $index => $sewa)
                                <tr class="border-b border-gray-700 hover:bg-gray-800">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $sewa->user_name }}</td>
                                    <td class="px-4 py-3">{{ $sewa->item_name }} (Rp{{ number_format($sewa->item_price, 0, ',', '.') }})</td>
                                    <td class="px-4 py-3">{{ $sewa->jumlah_barang }}</td>
                                    <td class="px-4 py-3">Rp{{ number_format($sewa->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">{{ $sewa->no_hp }}</td>
                                    <td class="px-4 py-3">{{ $sewa->alamat }}</td>
                                    <td class="px-4 py-3">{{ $sewa->metode_pembayaran }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($sewa->tanggal_pemesanan)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($sewa->tanggal_pengembalian)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3">{{ $sewa->jaminan }}</td>
                                    <td class="px-4 py-3">
                                        @if ($sewa->metode_pembayaran == 'Transfer Bank' && $sewa->bukti_pembayaran)
                                            <a href="{{ asset($sewa->bukti_pembayaran) }}" target="_blank" class="text-yellow-500 underline">Lihat Bukti</a>
                                        @else
                                            <span class="text-gray-400">Tidak Ada Bukti</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <form method="POST" action="{{ route('update.status', $sewa->id_sewa) }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="px-2 py-1 bg-gray-700 text-white rounded focus:ring-2 focus:ring-yellow-500">
                                                <option value="Proses" {{ $sewa->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="Selesai" {{ $sewa->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="Batal" {{ $sewa->status === 'Batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3">
                                        <form action="{{ route('sewa.destroy', $sewa->id_sewa) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="px-4 py-3 text-center text-gray-400">Tidak ada data sewa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
