<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setia Outdoor') }}
        </h2>
    </x-slot>

    <!-- Main Content Section -->
    <div class="relative py-12 min-h-screen">
        <!-- Background Image -->
        <img src="{{ asset('img/gambarbg.jpg') }}" class="absolute inset-0 w-full h-full object-cover -z-10" alt="">
        <h3 class="text-center text-3xl font-bold text-white mb-8">Barang yang tersedia</h3>

        <!-- Jaket Items Grid -->
        <div class="flex flex-wrap gap-4 mt-12 justify-center">
            <!-- Item -->
            @foreach ($outdoorItems as $item)
                <div class="w-48">
                    <div class="relative group w-full overflow-hidden rounded-lg hover:scale-105 transition-transform duration-300">
                        <!-- Gambar -->
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}" 
                            class="w-full h-full object-cover rounded-md group-hover:blur-sm transition duration-300">

                        <!-- Overlay -->
                        <div class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-30 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-lg font-bold text-center">{{ $item->name }}</p>
                            <p class="mt-2 text-sm text-center">Harga: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="mt-1 text-sm text-center">Stok: {{ $item->stok }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br>

        <!-- Contact Us Section -->
        <div class="relative py-12 bg-cover bg-center" style="background-image: url('{{ asset('img/background.jpg') }}');">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative z-10 max-w-7xl mx-auto py-16 px-6 lg:px-8 text-white">
                <h1 class="text-3xl font-bold text-center mb-6">Kontak Kami</h1>
                <p class="text-lg text-center mb-8">
                    Jika Anda memiliki pertanyaan atau ingin menyewa alat outdoor kami, silakan hubungi kami melalui formulir kontak di bawah ini atau kunjungi kami di lokasi kami.
                </p>
                <div class="flex flex-col lg:flex-row gap-8 items-center">
                    <!-- Map -->
                    <div class="w-full lg:w-1/2">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.4653935749834!2d119.42193887474228!3d-5.189281894788247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30596ed003d%3A0x24bfd67d41822e2!2sSetia%20Outdoor%20Dg.%20Tata%203!5e0!3m2!1sid!2sid!4v1730969141778!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-lg shadow-lg" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="w-full lg:w-1/2 bg-gray-900 p-8 rounded-lg shadow-lg">
                        <form method="POST" action="{{ route('outdoor.placeOrder') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-2">Pilih Barang</label>
                                <div class="space-y-2">
                                    @foreach ($outdoorItems as $item)
                                        <div class="flex items-center">
                                            <!-- Checkbox untuk memilih barang -->
                                            <input 
                                                type="checkbox" 
                                                id="item-{{ $item->id }}" 
                                                name="items[]" 
                                                value="{{ $item->id }}" 
                                                data-price="{{ $item->price }}" 
                                                class="w-4 h-4 text-yellow-600 bg-gray-800 border-gray-700 rounded focus:ring-yellow-500">
                                            
                                            <!-- Label untuk barang -->
                                            <label for="item-{{ $item->id }}" class="ml-2 text-sm text-white">
                                                {{ $item->name }} (Stok: {{ $item->stok }}) (Rp{{ number_format($item->price, 0, ',', '.') }})
                                            </label>
                                        


                                            <!-- Input jumlah barang -->
                                            <input 
                                                type="number" 
                                                id="quantity-{{ $item->id }}" 
                                                name="quantities[{{ $item->id }}]" 
                                                min="1" 
                                                max="{{ $item->stok }}" 
                                                class="ml-4 w-16 px-2 py-1 bg-gray-800 text-white rounded-lg focus:outline-none" 
                                                placeholder="Num" 
                                                disabled>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-gray-400">Centang barang yang ingin Anda pilih.</small>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-1" for="phone">No HP</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none" placeholder="Masukkan Nomor Telepon Anda">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-1" for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none" placeholder="Alamat Anda">
                            </div>
                            <div class="mb-4">
                            <div class="mb-4">
                            <div class="mb-4">
                            <label class="block text-sm font-medium text-white mb-1" for="payment_method">Metode Pembayaran</label>
                            <select id="payment_method" name="metode_pembayaran"
                                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="" disabled selected class="text-gray-400">Pilih Metode Pembayaran</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="Tunai">Tunai</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white mb-1" for="total_price_display">Total Harga</label>
                            <input type="text" id="total_price_display" readonly 
                                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:outline-none" placeholder="Total Harga">
                            <!-- Hidden input untuk mengirim total harga ke server -->
                            <input type="hidden" id="total_price" name="total_harga">
                        </div>


                            
                            <button type="submit" class="w-full bg-yellow-600 text-white py-2 rounded-lg font-semibold hover:bg-yellow-700 transition-colors duration-300">Kirim Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const quantityInput = document.querySelector(`#quantity-${this.value}`);
            quantityInput.disabled = !this.checked;

            if (!this.checked) {
                quantityInput.value = ''; // Reset the value
            }

            updateTotalPrice(); // Recalculate the total price
        });
    });

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', updateTotalPrice); // Update total price when quantity changes
    });

    function updateTotalPrice() {
        let totalPrice = 0;

        document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
            const itemId = checkbox.value;
            const quantityInput = document.querySelector(`#quantity-${itemId}`);
            const quantity = parseInt(quantityInput.value) || 0;
            const price = parseFloat(checkbox.dataset.price) || 0;

            totalPrice += quantity * price;
        });

        // Update the total price display
        document.querySelector('#total_price_display').value = totalPrice.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

        // Update the hidden total price input (sent to the server)
        document.querySelector('#total_price').value = totalPrice;
    }
    </script>

</x-app-layout>
