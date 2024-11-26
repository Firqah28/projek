<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selamat datang, ') }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <!-- Main Content Section -->
    <div class="relative py-12 min-h-screen">
        <!-- Background Image -->
        <img src="{{ asset('img/gambarbg.jpg') }}" class="absolute inset-0 w-full h-full object-cover -z-10" alt="">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="text-center text-gray-100">
                <h1 class="text-5xl font-bold mb-2">Selamat Datang di Setia Outdoor</h1>
                <h2 class="text-3xl font-bold mb-10">Penyewaan Alat Outdoor Makassar</h2>
                <p class="text-xl mb-10 mx-20">
                    Kami menyediakan berbagai alat outdoor untuk kebutuhan camping, hiking, dan petualangan alam Anda. 
                    Temukan produk-produk berkualitas yang siap menunjang kegiatan luar ruangan Anda.
                </p>
            </div>

            <div class="bg-black bg-opacity-40 shadow-sm sm:rounded-lg p-6 text-white relative z-10">
                <h3 class="text-3xl font-bold text-center mb-8">Produk Kami</h3>

                <!-- Image Slider -->
                <div class="relative">
                    <div class="flex items-center">
                        <button onclick="prevImage()" class="absolute left-0 bg-yellow-600 px-4 py-2 rounded-full hover:bg-yellow-700 z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                        </svg>  <!-- Left arrow icon -->
                        </button>

                        <!-- Slider Images Container -->
                        <div id="slider-container" class="overflow-hidden w-full relative">
                            <!-- Slider Images -->
                            <div id="slider" class="flex transition-transform duration-500 ease-in-out" style="width: 300%;">
                            <div class="w-1/3 flex-none text-center">
                                    <img src="{{ asset('img/carrie.png') }}" class="mx-auto rounded-lg shadow-lg" alt="Tenda Camping">
                                    <p class="mt-4 text-lg font-semibold">Carrie</p>
                                </div>
                                <div class="w-1/3 flex-none text-center">
                                    <img src="{{ asset('img/jaket3.png') }}" class="mx-auto rounded-lg shadow-lg" alt="Jaket Outdoor">
                                    <p class="mt-4 text-lg font-semibold">Jaket Outdoor</p>
                                </div>
                                <div class="w-1/3 flex-none text-center">
                                    <img src="{{ asset('img/kompor.png') }}" class="mx-auto rounded-lg shadow-lg" alt="Kompor Portable">
                                    <p class="mt-4 text-lg font-semibold">Kompor Portable</p>
                                </div>
                                <div class="w-1/3 flex-none text-center">
                                    <img src="{{ asset('img/nesting.png') }}" class="mx-auto rounded-lg shadow-lg" alt="Tenda Camping">
                                    <p class="mt-4 text-lg font-semibold">Nesting</p>
                                </div>
                                <div class="w-1/3 flex-none text-center">
                                    <img src="{{ asset('img/sb1.png') }}" class="mx-auto rounded-lg shadow-lg" alt="Tenda Camping">
                                    <p class="mt-4 text-lg font-semibold">Sleeping Bag</p>
                                </div>
                                <div class="w-1/3 flex-none text-center">
                                    <img src="{{ asset('img/tenda.png') }}" class="mx-auto rounded-lg shadow-lg" alt="Tenda Camping">
                                    <p class="mt-4 text-lg font-semibold">Tenda</p>
                                </div>
                            </div>
                        </div>

                        <button onclick="nextImage()" class="absolute right-0 bg-yellow-600 px-4 py-2 rounded-full hover:bg-yellow-700 z-20">
                      <!-- Right arrow icon -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Detail Produk Button -->
                    <div class="text-center mt-8">
                        <a href="/sewa" class="bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-yellow-700">
                            Produk Selengkapnya!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Slider Functionality -->
    <script>
        let currentIndex = 0;
        const totalImages = document.querySelectorAll('#slider > div').length;

        function showImage(index) {
            const slider = document.getElementById('slider');
            slider.style.transform = `translateX(-${index * (200 / totalImages)}%)`;
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % totalImages;
            showImage(currentIndex);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            showImage(currentIndex);
        }
    </script>

    <!-- Footer Section -->
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

</x-app-layout>
