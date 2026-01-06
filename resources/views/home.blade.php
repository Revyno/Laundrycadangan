@extends('layouts.app')
{{-- @vite('resources/css/app.css', 'resources/js/app.js') --}}

@section('content')
<x-navbar currentPage="home" />

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
                        Mau itu sneakers kesayangan, sepatu formal andalan, atau boots yang sudah menemani banyak langkah, kami siap membuatnya tampak seperti baru lagi. Feast.id  bikin sepatu selalu bersih, wangi, dan siap tampil percaya diri di setiap langkahmu!
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
                    <p class="text-gray-600 mb-6">Jl. Aryo Bebangah No.54, Dusun Bangah Barat, Bangah, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254</p>
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
                    <img src="{{ asset('images/human1.jpg') }}" alt="Jaka" class="w-12 h-12 rounded-full object-cover ring-2 mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Mawar Jaka</h4>
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
                    <img src="{{ asset('images/pp1.jpg') }}" alt="Putriana Hudiyanti" class="w-12 h-12 rounded-full object-cover ring-2 mr-4">
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
                    <img src="{{ asset('images/pp2.jpg') }}" alt="Vita Aruben" class="w-12 h-12 rounded-full object-cover ring-2 mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Denis Cool</h4>
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

<x-footer />

<!-- Flowbite JS -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}

<!-- Page Loading Script -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simulate loading time
        setTimeout(function() {
            document.body.classList.add('loaded');
        }, 1500);
    });
</script> --}}
@endsection
