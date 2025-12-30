@extends('layouts.app')
@vite('resources/css/app.css', 'resources/js/app.js')

@section('content')
<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-[#0B1320] border-gray-200 px-2 sm:px-4 py-2.5 transition-all duration-300">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <!-- Logo - always visible -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/1.jpg') }}" class="h-10 mr-3" alt="Fresh Kicks Logo" />
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center justify-between w-full md:w-auto md:order-1">
            <ul class="flex flex-row space-x-8 text-sm font-medium text-white">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 pl-3 pr-4 text-white bg-[#374151] rounded md:bg-transparent md:text-white md:p-0" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('services') }}" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white md:p-0">Services</a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white md:p-0">Gallery</a>
                </li>
                <li>
                    <a href="{{ route('contactus') }}" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white md:p-0">Contact Us</a>
                </li>
            </ul>
        </div>

        <!-- Auth buttons - desktop only -->
        <div class="hidden md:flex md:order-2">
            <a href="{{ route('filament.customer.auth.login') }}" class="text-white bg-[#374151] hover:bg-[#111827] focus:ring-4 focus:outline-none focus:ring-[#111827] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</a>
            <a href="{{ route('filament.customer.auth.register') }}" class="text-[#333333] bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 ml-3">Sign Up</a>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</nav>

<!-- Mobile Sidebar -->
<div id="mobile-sidebar" class="fixed top-0 right-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-[#0B1320] border-l border-gray-700" tabindex="-1" aria-labelledby="drawer-navigation-label">
    <div class="border-b border-gray-700 pb-4 flex items-center">
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('images/fav-admin-kecil.png') }}" class="h-8 w-8" alt="Fresh Kicks Logo" />
            <span class="self-center text-lg font-semibold whitespace-nowrap text-white">Feast.id</span>
        </a>
        <button type="button" id="sidebar-close-button" class="text-gray-300 bg-transparent hover:text-white hover:bg-gray-700 rounded-lg w-9 h-9 absolute top-2.5 end-2.5 flex items-center justify-center">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>
    <div class="py-5 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('home') }}" class="flex items-center px-2 py-1.5 text-white bg-[#374151] rounded-lg hover:bg-gray-700 group" aria-current="page">
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                    <span class="ms-3">Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery') }}" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                    <span class="ms-3">Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('contactus') }}" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                    <span class="ms-3">Contact Us</span>
                </a>
            </li>
        </ul>
        <div class="pt-4 mt-4 space-y-2 border-t border-gray-700">
            <a href="{{ route('filament.customer.auth.login') }}" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                <span class="ms-3">Login</span>
            </a>
            <a href="{{ route('filament.customer.auth.register') }}" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                <span class="ms-3">Sign Up</span>
            </a>
        </div>
    </div>
</div>

<!-- Sidebar overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden"></div>

<!-- Hero Carousel -->
<div class="relative h-screen overflow-hidden">
    <div id="default-carousel" class="relative w-full h-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-full overflow-hidden">
            <!-- Item 1 -->
            <div class="duration-700 ease-in-out h-full" data-carousel-item>
                <img src="{{ asset('images/herocb1.jpg') }}" class="absolute block w-full h-full object-cover" alt="Hero Image">
                <div class="absolute inset-0 bg-opacity-10 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h1 class="text-6xl font-bold mb-4">Faster Cleaning</h1>
                        <p class="text-xl mb-8">Professional Shoe Cleaning Service</p>
                        <a href="{{ route('filament.customer.auth.register') }}" class="bg-dark text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#111827] transition duration-300">Get Started</a>
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                <img src="{{ asset('images/herocb2.jpg') }}" class="absolute block w-full h-full object-cover" alt="Hero Image 2">
                <div class="absolute inset-0 b bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h1 class="text-6xl font-bold mb-4">YOUR SHOES DESERVE THE BEST</h1>
                        <p class="text-xl mb-8">Expert care for all your favorite footwear</p>
                        <a href="{{ route('filament.customer.auth.register') }}" class="bg-dark text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#111827] transition duration-300">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div>

<!-- About Section -->
<section id="about" class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2" data-aos="fade-right">
                <div class="border-2 border-white rounded-full px-6 py-3 inline-block mb-8" data-aos="zoom-in" data-aos-delay="200">
                    <h2 class="text-3xl font-bold text-white uppercase text-center">DISCOVER US</h2>
                </div>
                <div class="text-white">
                    <p class="text-lg leading-relaxed mb-6" data-aos="fade-up" data-aos-delay="400">
                        Didirikan dengan keyakinan bahwa setiap sepatu favorit layak mendapatkan perawatan terbaik, Feast.id hadir dengan layanan cleaning profesional untuk semua jenis alas kaki. Tim ahli kami menggunakan teknik dan produk premium untuk mengatasi mulai dari kotoran sehari-hari hingga noda membandel, tanpa merusak bahan atau warna sepatumu.
                    </p>
                    <p class="text-lg leading-relaxed" data-aos="fade-up" data-aos-delay="600">
                        Mau itu sneakers kesayangan, sepatu formal andalan, atau boots yang sudah menemani banyak langkah, kami siap membuatnya tampak seperti baru lagi. Feast.id — bikin sepatu selalu bersih, wangi, dan siap tampil percaya diri di setiap langkahmu!
                    </p>
                </div>
            </div>
            <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="300">
                <img src="{{ asset('images/aboutus.jpg') }}" alt="About Us" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4" data-aos="zoom-in" data-aos-delay="400">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2 uppercase">Perawatan Profesional</h3>
                <p class="text-white">Layanan cleaning profesional dengan teknik dan produk premium untuk hasil maksimal.</p>
            </div>

            <!-- Service 2 -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4" data-aos="zoom-in" data-aos-delay="600">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2 uppercase">Layanan Antar-Jemput Gratis</h3>
                <p class="text-white">Kami jemput dan antar sepatu Anda langsung ke lokasi tanpa biaya tambahan.</p>
            </div>

            <!-- Service 3 -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="600">
                <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4" data-aos="zoom-in" data-aos-delay="800">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2 uppercase">Konsultasi Dukungan Pelanggan</h3>
                <p class="text-white">Tim support kami siap membantu Anda dengan pertanyaan dan konsultasi kapan saja.</p>
            </div>
        </div>
    </div>
</section>

<!-- Shoe Materials Section -->
<section id="materials" class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-down">
            <div class="border-2 border-white rounded-full px-6 py-3 inline-block" data-aos="zoom-in" data-aos-delay="200">
                <h2 class="text-3xl font-bold text-white uppercase">CARE FOR ALL SHOE MATERIALS</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Nubuck -->
            <div class="relative group cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('images/nubuck.jpg') }}" alt="Nubuck" class="w-full h-64 object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center rounded-lg">
                    <h3 class="text-white text-2xl font-bold uppercase">NUBUCK</h3>
                </div>
            </div>

            <!-- Fabric -->
            <div class="relative group cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                <img src="{{ asset('images/fabric.jpg') }}" alt="Fabric" class="w-full h-64 object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center rounded-lg">
                    <h3 class="text-white text-2xl font-bold uppercase">FABRIC</h3>
                </div>
            </div>

            <!-- Leather -->
            <div class="relative group cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                <img src="{{ asset('images/leather.jpg') }}" alt="Leather" class="w-full h-64 object-cover rounded-lg">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center rounded-lg">
                    <h3 class="text-white text-2xl font-bold uppercase">LEATHER</h3>
                </div>
            </div>

            <!-- Suede -->
            <div class="relative group cursor-pointer" data-aos="fade-up" data-aos-delay="600">
                <img src="{{ asset('images/suede.jpg') }}" alt="Suede" class="w-full h-64 object-cover rounded-lg shadow-lg">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center rounded-lg">
                    <h3 class="text-white text-2xl font-bold uppercase">SUEDE</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Branch Locations -->
<section id="locations" class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-down">
            <div class="border-2 border-white rounded-full px-6 py-3 inline-block" data-aos="zoom-in" data-aos-delay="200">
                <h2 class="text-3xl font-bold text-white uppercase">BRANCH LOCATIONS</h2>
            </div>
        </div>

        <div class="bg-[#EEF9FF] rounded-lg p-8" data-aos="fade-up" data-aos-delay="300">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div data-aos="fade-right" data-aos-delay="400">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">SIDOARJO</h3>
                    <p class="text-gray-600 mb-6">Feast.id Cuci Sepatu Kilat, Jl. Jatisari 3 No.44, Pepelegi, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256</p>
                    <div class="mb-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Jam Operasional:</h4>
                        <ul class="text-gray-600 text-sm space-y-1">
                            <li><strong>Senin - Jumat:</strong> 08:00 - 17:00</li>
                            <li><strong>Sabtu:</strong> 08:00 - 15:00</li>
                            <li><strong>Minggu:</strong> Tutup</li>
                        </ul>
                    </div>
                    <div class="flex gap-4">
                        <a href="https://wa.me/6281234567890" class="bg-white border border-gray-300 text-gray-800 px-6 py-2 rounded-full hover:bg-gray-50 transition duration-300">
                            WhatsApp
                        </a>
                        <a href="https://maps.app.goo.gl/VbfEmekgdUCTWkFo8" class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition duration-300">
                            Google Maps
                        </a>
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-delay="500">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2028458.4159055245!2d108.52008822500001!3d-6.790184978923435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb8a85ba549f%3A0xe345db2214716827!2sFeasst.id!5e0!3m2!1sid!2sid!4v1767110611423!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg"></iframe>
                </div>
        </div>
    </div>
</section>

<!-- Customer Reviews -->
<section class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-down">
            <div class="border-2 border-white rounded-full px-6 py-3 inline-block" data-aos="zoom-in" data-aos-delay="200">
                <h2 class="text-3xl font-bold text-white uppercase">CUSTOMER REVIEWS</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Review 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/human1.jpg') }}" alt="Jaka" class="w-10 h-10 rounded-full ring-2 mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">JAKA</h4>
                        <div class="flex text-yellow-400 mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"Puass pekerjaannyaaa"</p>
                <p class="text-gray-400 text-sm mt-2">1 year ago</p>
            </div>

            <!-- Review 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/putriana-profile.png') }}" alt="Putriana Hudiyanti" class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Putriana Hudiyanti</h4>
                        <div class="flex text-yellow-400 mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"bersih bgt kaget, padahal udh hopeless gabakal bisa dibersihin insolenya karna nyoba sikat sendiri di rumah gaada hasil 🙃"</p>
                <p class="text-gray-400 text-sm mt-2">1 year ago</p>
            </div>

            <!-- Review 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="500">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/vita-profile.png') }}" alt="Vita Aruben" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Vita Aruben</h4>
                        <div class="flex text-yellow-400 mt-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"Excellent service! I spilled coffee to my converse, and not hoping much for it to be clean ever again. Fresh Kicks cleaned it, and the end result is so amazing and smells good…"</p>
                <p class="text-gray-400 text-sm mt-2">1 year ago</p>
            </div>
        </div>
    </div>
</section>

<!-- How to Order Timeline -->
<section class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-down">
            <div class="border-2 border-white rounded-full px-6 py-3 inline-block" data-aos="zoom-in" data-aos-delay="200">
                <h2 class="text-3xl font-bold text-white uppercase">HOW TO ORDER</h2>
            </div>
            <p class="text-white mt-4 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                Follow these simple steps to get your shoes professionally cleaned and ready to shine!
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <ol class="relative border-l border-gray-400">
                <!-- Step 1: Register/Login -->
                <li class="mb-10 ml-6" data-aos="fade-right" data-aos-delay="400">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -left-4 ring-4 ring-[#5E5E5E]">
                        <svg class="w-3.5 h-3.5 text-[#0B1320]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                        </svg>
                    </span>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                            <span class="bg-[#0B1320] text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded">1</span>
                            Register or Login
                        </h3>
                        <p class="mb-4 text-base font-normal text-gray-700">
                            Create an account or log in to access our customer dashboard where you can place orders, track progress, and manage your services.
                        </p>
                        <div class="flex gap-3">
                            <a href="{{ route('filament.customer.auth.register') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#0B1320] hover:bg-[#374151] rounded-lg">
                                Sign Up
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            <a href="{{ route('filament.customer.auth.login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#0B1320] bg-white border border-gray-300 hover:bg-gray-50 rounded-lg">
                                Login
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Step 2: Choose Services -->
                <li class="mb-10 ml-6" data-aos="fade-right" data-aos-delay="500">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -left-4 ring-4 ring-[#5E5E5E]">
                        <svg class="w-3.5 h-3.5 text-[#0B1320]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.507a1 1 0 0 1 .507-1.94 4.5 4.5 0 0 1 7.975 0 1 1 0 0 1-.507 1.94A6.5 6.5 0 0 1 3.014 13.507Z"/>
                        </svg>
                    </span>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                            <span class="bg-[#0B1320] text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded">2</span>
                            Choose Your Services
                        </h3>
                        <p class="mb-4 text-base font-normal text-gray-700">
                            Browse our professional cleaning services. Select the type of cleaning that best fits your shoes' condition and material.
                        </p>
                        <a href="{{ route('services') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#0B1320] hover:bg-[#374151] rounded-lg">
                            View Services
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </li>

                <!-- Step 3: Place Order -->
                <li class="mb-10 ml-6" data-aos="fade-right" data-aos-delay="600">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -left-4 ring-4 ring-[#5E5E5E]">
                        <svg class="w-3.5 h-3.5 text-[#0B1320]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M17 9a1 1 0 0 0-1 1 6.994 6.994 0 0 1-6.192 6.951A1 1 0 0 0 9 18v1a1 1 0 1 1-2 0v-1a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 0-1-1 6.994 6.994 0 0 1-6.192-6.951A1 1 0 0 0 1 9a1 1 0 1 1 2 0 6.994 6.994 0 0 1 6.192 6.951A1 1 0 0 0 11 15.937V13a3 3 0 0 1 3-3h1a1 1 0 1 1 0 2h-1a1 1 0 0 0-1 1v2.937A1 1 0 0 0 14 16.93a6.994 6.994 0 0 1 3.192-6.951A1 1 0 0 0 17 9Z"/>
                        </svg>
                    </span>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                            <span class="bg-[#0B1320] text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded">3</span>
                            Place Your Order
                        </h3>
                        <p class="mb-4 text-base font-normal text-gray-700">
                            Fill in your order details including shoe type, quantity, condition, and upload photos. Choose pickup or delivery options.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                                Upload Photos
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"/>
                                </svg>
                                Free Delivery
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Step 4: Make Payment -->
                <li class="mb-10 ml-6" data-aos="fade-right" data-aos-delay="700">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -left-4 ring-4 ring-[#5E5E5E]">
                        <svg class="w-3.5 h-3.5 text-[#0B1320]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z"/>
                            <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2Z"/>
                        </svg>
                    </span>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                            <span class="bg-[#0B1320] text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded">4</span>
                            Make Payment
                        </h3>
                        <p class="mb-4 text-base font-normal text-gray-700">
                            Complete your payment securely through our system. We accept various payment methods for your convenience.
                        </p>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            Secure Payment
                        </div>
                    </div>
                </li>

                <!-- Step 5: Track & Receive -->
                <li class="ml-6" data-aos="fade-right" data-aos-delay="800">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -left-4 ring-4 ring-[#5E5E5E]">
                        <svg class="w-3.5 h-3.5 text-[#0B1320]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2ZM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2Z"/>
                        </svg>
                    </span>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                            <span class="bg-[#0B1320] text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded">5</span>
                            Track & Receive Your Shoes
                        </h3>
                        <p class="mb-4 text-base font-normal text-gray-700">
                            Monitor your order status in real-time through your dashboard. Receive your professionally cleaned shoes ready to wear!
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                Real-time Tracking
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Quality Guarantee
                            </div>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</section>

<!-- Fresh Updates -->
<section class="bg-[#5E5E5E] py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-down">
            <div class="border-2 border-white rounded-full px-6 py-3 inline-block" data-aos="zoom-in" data-aos-delay="200">
                <h2 class="text-3xl font-bold text-white uppercase">FRESH UPDATES</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Post 1 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('images/shoes1.jpg') }}" alt="Post 1" class="w-full h-64 object-cover">
                <div class="p-6">
                    <p class="text-gray-600">Sepatu aja butuh Self healing, makanya kita kasi deep clean. Biar GK stresss liat Noda 😉🤔</p>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg" data-aos="fade-up" data-aos-delay="400">
                <img src="{{ asset('images/shoes2.jpg') }}" alt="Post 2" class="w-full h-64 object-cover">
                <div class="p-6">
                    <p class="text-gray-600">Kalau manusia rawat tubuh pakai skincare, kalau sepatu pakai @feast.id shoes care. Biar badan sepatumu tetep glowing ✨"</p>
                </div>
            </div>

            <!-- Post 3 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-lg" data-aos="fade-up" data-aos-delay="500">
                <img src="{{ asset('images/shoes3.jpg') }}" alt="Post 3" class="w-full h-64 object-cover">
                <div class="p-6">
                    <p class="text-gray-600">Siap tampil bersih setiap hari nya</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#0B1320] text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <img src="{{ asset('images/1.jpg') }}" alt="Fresh Kicks Logo" class="h-12 mb-4">
                <p class="text-gray-300 mb-4">Feast.id Cuci Sepatu Kilat, Jl. Jatisari 3 No.44, Pepelegi, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256</p>
                <p class="text-gray-300">© FEAST.ID 2025</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-white">Services</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-gray-300 hover:text-white">Gallery</a></li>
                    <li><a href="{{ route('contactus') }}" class="text-gray-300 hover:text-white">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.749.097.118.112.221.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001.012.017z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.749.097.118.112.221.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001.012.017z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6281234567890?text=Halo%20Feast.id,%20saya%20ingin%20bertanya%20tentang%20layanan%20cuci%20sepatu"
   class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 animate-pulse"
   target="_blank"
   title="Hubungi via WhatsApp">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
    </svg>
</a>

<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

<!-- Page Loading Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simulate loading time
        setTimeout(function() {
            document.body.classList.add('loaded');
        }, 1500); // 1.5 seconds loading simulation
    });
</script>
@endsection
