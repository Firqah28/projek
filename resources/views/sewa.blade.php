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

        <!-- Heading -->
        <h3 class="text-center text-3xl font-bold text-white mb-8">Barang yang tersedia</h3>


        <!-- Product Categories and Items -->
        <div class="container mx-auto p-4">
            @foreach ($groupedItems as $kategori => $items)
                <!-- Display Category -->
                <h3 class="text-2xl font-bold mb-4 text-center text-white">Kategori: {{ $kategori }}</h3>
                
                <!-- Display Products in Category -->
                <div class="flex flex-wrap gap-4 justify-center">
                    @foreach ($items as $item)
                        <div class="w-64 rounded-lg shadow-md p-4">
                            <!-- Product Image -->
                            <div class="relative group w-full h-48 overflow-hidden rounded-md">
                                <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}" 
                                     alt="{{ $item->name }}" 
                                     class="w-full h-full object-cover rounded-md cursor-pointer group-hover:scale-105 transition-transform duration-300"
                                     onclick="openModal('{{ $item->id }}')">
                            </div>
                            
                            <!-- Product Information -->
                            <div class="mt-4">
                                <h4 class="text-lg font-bold text-white text-center">{{ $item->name }}</h4>
                                <p class="text-sm text-white mt-2 text-center">Harga: Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                <p class="text-sm text-white mt-2 text-center">Stok: {{ $item->stok }}</p>
                            </div>
                        </div>

                         <!-- Modal Detail Produk -->
                         <div id="modal-{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
                                <!-- Close Button -->
                                <button onclick="closeModal('{{ $item->id }}')" 
                                        class="absolute top-2 right-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-1 px-2 rounded-full">
                                    &times;
                                </button>
                                
                                <!-- Product Details -->
                                <h3 class="text-lg font-bold mb-4 text-center">{{ $item->name }}</h3>
                                <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                                <p class="text-sm text-gray-700 mb-2"><strong>Deskripsi:</strong> {{ $item->description }}</p>
                                <p class="text-sm text-gray-700 mb-2"><strong>Harga:</strong> Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-700 mb-4"><strong>Stok:</strong> {{ $item->stok }}</p>
                                
                                <!-- Close Button -->
                                <button onclick="closeModal('{{ $item->id }}')" 
                                        class="w-full bg-yellow-500 text-white py-2 rounded-md font-semibold hover:bg-yellow-600 transition-colors duration-300">
                                    Tutup
                                </button>
                            </div>
                        </div>

                        
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <!-- Contact Us Section -->
    <div class="relative py-12 bg-cover bg-center" style="background-image: url('{{ asset('img/background.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 max-w-7xl mx-auto py-16 px-6 lg:px-8 text-white">
            <h1 class="text-3xl font-bold text-center mb-6">Sewa Kebutuhan Outdoor Kamu Sekarang!</h1>
            <p class="text-lg text-center mb-8">
                Jika Anda mau menyewa untuk kebutuhan outdoor, silakan hubungi kami dan mengisi formulir pemesanan di bawah ini atau kunjungi kami di lokasi kami.
            </p>

            <!-- Order Form -->
            <div class="w-full bg-gray-900 bg-opacity-75 p-8 rounded-lg shadow-lg">
            <form id="orderForm" method="POST" action="{{ route('outdoor.placeOrder') }}" enctype="multipart/form-data" id="orderForm">
    @csrf
    <p class="text-2xl text-center mb-6">Form Pemesanan</p>

    <!-- Select Items -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-white mb-2">Pilih Barang</label>
        <div>
            <small class="text-gray-400">Centang barang yang ingin Anda pilih.</small>
        </div>
        <div class="space-y-6">
            @foreach ($groupedItems as $kategori => $items)
                <!-- Kategori -->
                <div>
                    <h3 class="text-lg font-bold text-yellow-500 mb-4">{{ $kategori }}</h3>
                    <!-- Barang dalam kategori -->
                    <div class="space-y-2">
                        @foreach ($items as $item)
                        @if ($item->stok > 0) <!-- Tampilkan hanya barang dengan stok lebih dari 0 -->
                        <div class="flex items-center">
                            <!-- Checkbox untuk barang -->
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
                    @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="w-full bg-gray-900 p-8 rounded-lg shadow-lg">
        <!-- No HP -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="phone">No HP</label>
            <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none" placeholder="Masukkan Nomor Telepon Anda" required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none" placeholder="Alamat Anda" required>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="metode_pembayaran">Metode Pembayaran</label>
            <select id="metode_pembayaran" name="metode_pembayaran"
                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                <option value="" disabled selected hidden>Pilih Metode Pembayaran</option>
                <option value="Transfer Bank">Transfer Bank - BRI 7312097540997</option>
                <option value="Tunai">Tunai</option>
            </select>

            <div class="mb-4" id="bukti-pembayaran-container" style="display: none;">
                <label for="bukti_pembayaran" class="block text-sm font-medium text-white">Unggah Bukti Pembayaran</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="w-full bg-gray-800 text-white" accept="image/*">
            </div>
        </div>

        <!-- Tanggal Pemesanan -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="tanggal_pemesanan">Tanggal Pemesanan</label>
            <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none" required>
        </div>

        <!-- Tanggal Pengembalian -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg focus:outline-none" required>
        </div>

        <!-- Jaminan -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="jaminan">Jaminan</label>
            <select id="jaminan" name="jaminan" 
                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                <option value="" disabled selected hidden>Pilih Jaminan</option>
                <option value="KTP">KTP</option>
                <option value="SIM">SIM</option>
                <option value="Paspor">Paspor</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <!-- Total Harga -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-white mb-1" for="total_price_display">Total Harga</label>
            <input
                type="text"
                id="total_price_display"
                readonly
                class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded-lg focus:outline-none"
                placeholder="Total Harga"
            />
            <input type="hidden" id="total_price" name="total_harga" />
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="w-full bg-yellow-600 text-white py-2 rounded-lg font-semibold hover:bg-yellow-700 transition-colors duration-300">
            Kirim Pesanan
        </button>
    </div>
</form>

        </div>

            <!-- Map (Bagian Bawah) -->
            <div class="w-full">
                <div class="flex justify-center items-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.4653935749834!2d119.42193887474228!3d-5.189281894788247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30596ed003d%3A0x24bfd67d41822e2!2sSetia%20Outdoor%20Dg.%20Tata%203!5e0!3m2!1sid!2sid!4v1730969141778!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-lg shadow-lg"></iframe>
                </div>
            </div>
        </div>


    <script>
   document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const quantityInput = document.querySelector(`#quantity-${this.value}`);
        if (this.checked) {
            quantityInput.disabled = false; // Aktifkan input jumlah barang
            quantityInput.value = 1; // Isi otomatis dengan angka 1
        } else {
            quantityInput.disabled = true; // Nonaktifkan input jumlah barang
            quantityInput.value = ''; // Reset nilai jika checkbox tidak dicentang
        }

        updateTotalPrice(); // Hitung ulang total harga
    });
});

document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', updateTotalPrice); // Perbarui total harga saat jumlah barang berubah
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

    // Perbarui tampilan total harga
    document.querySelector('#total_price_display').value = totalPrice.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });

    // Perbarui input tersembunyi untuk total harga
    document.querySelector('#total_price').value = totalPrice;
}

document.querySelector('#metode_pembayaran').addEventListener('change', function () {
    const container = document.querySelector('#bukti-pembayaran-container');
    if (this.value === 'Transfer Bank') {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
});

// Fungsi untuk membuka modal
function openModal(id) {
    document.getElementById(`modal-${id}`).classList.remove('hidden');
}

// Fungsi untuk menutup modal
function closeModal(id) {
    document.getElementById(`modal-${id}`).classList.add('hidden');
}

document.getElementById('orderForm').addEventListener('submit', function (e) {
    let isValid = true;

    // Validasi kolom wajib
    const requiredInputs = document.querySelectorAll('#orderForm [required]');
    requiredInputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;

            // Tambahkan border merah untuk input kosong
            input.classList.add('border-red-500');
            input.classList.remove('border-gray-700');
        } else {
            // Kembali ke border normal jika diisi
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-700');
        }
    });

    // Validasi barang (checkbox harus dicentang)
    const checkedItems = document.querySelectorAll('input[type="checkbox"]:checked');
    if (checkedItems.length === 0) {
        isValid = false;
        alert('Anda harus memilih setidaknya satu barang untuk disewa.');
    }

    // Jika tidak valid, cegah submit
    if (!isValid) {
        e.preventDefault();
        return;
    }
});

document.querySelector('#metode_pembayaran').addEventListener('change', function () {
    const buktiPembayaranContainer = document.getElementById('bukti-pembayaran-container');
    if (this.value === 'Transfer Bank') {
        buktiPembayaranContainer.style.display = 'block';
    } else {
        buktiPembayaranContainer.style.display = 'none';
    }
});

document.getElementById('orderForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Cegah pengiriman form langsung

        // Tampilkan konfirmasi menggunakan SweetAlert2
        Swal.fire({
            title: 'Konfirmasi Pesanan',
            text: 'Apakah Anda yakin ingin mengirim pesanan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Pesanan Diproses',
                    text: 'Pesanan Anda sedang diproses.',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                });

                // Kirim form setelah konfirmasi
                this.submit();
            } else {
                Swal.fire({
                    title: 'Pesanan Dibatalkan',
                    text: 'Anda membatalkan pengiriman pesanan.',
                    icon: 'info',
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
        });
    });

    document.getElementById('tanggal_pemesanan').addEventListener('change', updateTotalPrice);
    document.getElementById('tanggal_pengembalian').addEventListener('change', updateTotalPrice);

    function updateTotalPrice() {
        const tanggalPemesanan = document.getElementById('tanggal_pemesanan').value;
        const tanggalPengembalian = document.getElementById('tanggal_pengembalian').value;
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceInput = document.getElementById('total_price');

        if (tanggalPemesanan && tanggalPengembalian) {
            // Hitung selisih hari
            const date1 = new Date(tanggalPemesanan);
            const date2 = new Date(tanggalPengembalian);
            const timeDifference = date2 - date1;
            const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

            

            // Ambil harga per hari dari data barang (misalnya Rp 15.000)
            const basePrice = 15000; // Anda dapat menyesuaikan nilai ini
            const totalPrice = daysDifference * basePrice;

            // Update tampilan harga
            totalPriceDisplay.value = totalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
            totalPriceInput.value = totalPrice;
        }
    }

    </script>

</x-app-layout>


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
                <a href="Kontak Kami" class="hover:text-yellow-500">| @SetiaOutdoor</a>
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
                <a href="/terms-and-conditions" class="hover:text-yellow-500">Syarat & Ketentuan</a>
            </div>
            <!-- Copyright -->
            <div class="text-center md:text-right">
                &copy; 2024 Setia Outdoor. All rights reserved.
            </div>
        </div>
    </div>
</footer>