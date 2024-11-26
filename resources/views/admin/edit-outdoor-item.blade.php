<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Barang Outdoor') }}
        </h2>
    </x-slot>

    <div class="relative py-12 min-h-screen">
        <!-- Background Image -->
        <img src="{{ asset('img/gambarbg.jpg') }}" class="absolute inset-0 w-full h-full object-cover -z-10" alt="">

        <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-40 p-6">
            <div class="w-full max-w-lg bg-white bg-opacity-80 shadow-md rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Barang: {{ $item->name }}</h2>

                <!-- Formulir Edit Barang -->
                <form action="{{ route('admin.outdoor-items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 text-center">Nama Barang</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" 
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 text-center">Harga</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" 
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-medium text-gray-700 text-center">Stok</label>
                        <input type="number" id="stok" name="stok" value="{{ old('stok', $item->stok) }}" 
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Gambar (jika ada) -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 text-center">Gambar Barang</label>
                        <input type="file" id="image" name="image" 
                               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-800 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @if($item->image)
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">Gambar saat ini:</p>
                                <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}" class="w-32 h-32 object-cover rounded-md shadow-md mx-auto">
                            </div>
                        @endif
                    </div>

                    <!-- Tombol Update -->
                    <div>
                        <button type="submit" 
                                class="w-full px-6 py-2 bg-blue-600 text-white rounded-md font-medium shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Update
                        </button>
                    </div>
                </form>
            </div>
            

        </div>
    </div>

    <footer class="bg-gray-800 text-gray-100 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Footer Content -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-6 md:space-y-0">
                <!-- Business Description -->
                <div>
                    <h4 class="text-lg font-semibold">Setia Outdoor</h4>
                    <p class="text-gray-400 mt-4 max-w-xs"> 
                        Temukan perlengkapan terbaik untuk petualangan luar ruangan bersama kami.
                    </p>
                </div>

                <!-- Navigation Links -->
                <div class="flex flex-col space-y-1 md:space-y-0 md:space-x-2 md:flex-row">
                    <a href="/dashboard" class="hover:text-yellow-500">Home</a>
                    <a href="/about" class="hover:text-yellow-500">About</a>
                    <a href="/sewa" class="hover:text-yellow-500">Sewa</a>
                    <a href="">| @SetiaOutdoor</a>
                </div>

                <!-- Social Media Links -->
                <div class="flex space-x-5">
                    <a href="https://wa.me/1234567890" target="_blank" class="hover:text-yellow-500" aria-label="WhatsApp">
                        <img src="/img/whatpp.png" alt="WhatsApp" class="w-9 h-9">
                    </a>
                    <a class="mt-2">WhatsApp</a>
                    <a href="https://instagram.com/setiaoutdoor" target="_blank" class="hover:text-yellow-500" aria-label="Instagram">
                        <img src="/img/instagram.png" alt="Instagram" class="w-9 h-9">
                    </a>
                    <a class="mt-2">Instagram</a>
                </div>
            </div>

            <!-- Policies and Copyright -->
            <div class="flex flex-col md:flex-row justify-between items-center mt-8 text-sm text-gray-500 space-y-4 md:space-y-0">
                <!-- Privacy Policy and Terms -->
                <div class="flex space-x-4">
                    <a href="/privacy-policy" class="hover:text-yellow-500">Kebijakan Privasi</a>
                    <span>|</span>
                    <a href="/terms-and-conditions" class="hover:text-yellow-500">Syarat & Ketentan</a>
                </div>
                <!-- Copyright -->
                <div class="text-center md:text-right">
                    &copy; 2024 Setia Outdoor. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>
