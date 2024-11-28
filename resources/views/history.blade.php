<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pemesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-white mb-4">Riwayat Pemesanan</h3>

                <table class="min-w-full table-auto bg-gray-900 text-white border border-gray-700">
                    <thead>
                        <tr class="text-left bg-gray-700">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Barang</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2">Total Harga</th>
                            <th class="px-4 py-2">Metode Pembayaran</th>
                            <th class="px-4 py-2">Bukti Pembayaran</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $order->item_name }} (Rp{{ number_format($order->item_price, 0, ',', '.') }})</td>
                                <td class="px-4 py-2">{{ $order->jumlah_barang }}</td>
                                <td class="px-4 py-2">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">{{ $order->metode_pembayaran }}</td>
                                <td class="px-4 py-2">
                                    @if ($order->metode_pembayaran == 'Transfer Bank' && $order->bukti_pembayaran)
                                        <a href="{{ asset('uploads/bukti_pembayaran/' . $order->bukti_pembayaran) }}" target="_blank" class="text-yellow-500 underline">Lihat Bukti</a>
                                    @else
                                        Tidak Ada Bukti
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $order->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center">Belum ada riwayat pemesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>