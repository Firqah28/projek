<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('About') }}
        </h2>
    </x-slot>

    <!-- Background Image -->
    <div class="relative min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('img/background.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-30"></div> <!-- Overlay for better text contrast -->

        <!-- Content Section -->
        <div class="relative z-10 max-w-4xl mx-auto py-16 px-6 lg:px-8 text-white">
            <h1 class="text-3xl font-bold text-center">Tentang Kami</h1>
            <p class="mt-8 text-lg leading-relaxed text-center">
                Selamat datang di website penyewaan alat outdoor di Makassar! Kami menyediakan berbagai alat pendukung kegiatan outdoor seperti tenda, sleeping bag, jaket, dan perlengkapan camping lainnya. Dengan kualitas alat terbaik, kami berusaha untuk menunjang petualangan Anda agar lebih nyaman dan menyenangkan.
            </p>


            <!-- Decorative Images -->
             <br>
            <h3 class="text-2xl font-bold text-center">Penawaran Terbaik</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
    <div class="relative">
        <!-- Gambar dengan Navigasi -->
        <a href="{{ route('sewa') }}">
            <img src="{{ asset('img/paket1.jpg') }}" alt="Tenda Camping" class="w-full h-full object-cover rounded-lg shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
        </a>
    </div>
    <div class="relative">
        <!-- Gambar dengan Navigasi -->
        <a href="{{ route('sewa') }}">
            <img src="{{ asset('img/paket2.jpg') }}" alt="Sleeping Bag" class="w-full h-full object-cover rounded-lg shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
        </a>
    </div>
    <div class="relative">
        <!-- Gambar dengan Navigasi -->
        <a href="{{ route('sewa') }}">
            <img src="{{ asset('img/paket3.jpg') }}" alt="Jaket Outdoor" class="w-full h-full object-cover rounded-lg shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
        </a>
    </div>
    <div class="relative">
        <!-- Gambar dengan Navigasi -->
        <a href="{{ route('sewa') }}">
            <img src="{{ asset('img/paket4.jpg') }}" alt="Perlengkapan Camping" class="w-full h-full object-cover rounded-lg shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out">
        </a>
    </div>
</div>

                    <div class="text-center mt-8">
                        <a href="/sewa" class="bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-yellow-700">
                        Produk Selengkapnya!
                        </a>
                    </div>
            <div class="mt-12">
            <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.4653935749834!2d119.42193887474228!3d-5.189281894788247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30596ed003d%3A0x24bfd67d41822e2!2sSetia%20Outdoor%20Dg.%20Tata%203!5e0!3m2!1sid!2sid!4v1730969141778!5m2!1sid!2sid" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    class="rounded-lg shadow-lg" 
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>

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
                <a href="/kontak" class="hover:text-yellow-500">| @SetiaOutdoor</a>
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
