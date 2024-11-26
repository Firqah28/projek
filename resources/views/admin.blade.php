<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Daftar Barang Outdoor</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($outdoorItems->isEmpty())
            <p class="text-center text-gray-600">Belum ada barang yang ditambahkan.</p>
        @else
            <div class="flex flex-wrap gap-4 mt-6 justify-center">
                @foreach ($outdoorItems as $item)
                    <div class="w-60 bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Gambar -->
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}" 
                             class="w-full h-40 object-cover">
                        
                        <!-- Informasi Barang -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800 truncate">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600 mt-2">Harga: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Stok: {{ $item->stok }}</p>
                        </div>

                        <!-- Tombol Edit dan Delete -->
                        <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.outdoor-items.edit', $item->id) }}" 
                               class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                               Edit
                            </a>

                            <!-- Tombol Delete -->
                            <form action="{{ route('admin.outdoor-items.destroy', $item->id) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        
    </div>

</x-app-layout>
