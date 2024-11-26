<x-app-layout>
    <!-- Formulir Tambah Barang -->
    <div class="max-w-lg mx-auto bg-gray-700 bg-opacity-60 backdrop-blur-sm p-9 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-semibold text-white mb-6 text-center">Tambah Barang Baru</h2>
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-white font-semibold mb-2">Nama Barang:</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-white font-semibold mb-2">Deskripsi:</label>
                <textarea name="description" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"></textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-white font-semibold mb-2">Harga:</label>
                <input type="number" name="price" required step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label for="stok" class="block text-white font-semibold mb-2">Stock:</label>
                <input type="number" name="stok" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-white font-semibold mb-2">Upload Gambar:</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200">Tambah Barang</button>
            </div>
        </form>


        <div>
            <p>Riwayat pemesanan</p>

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
                    <a href="https://wa.me/6282347940790" target="_blank" class="hover:text-yellow-500" aria-label="WhatsApp">
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
