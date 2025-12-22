@extends('layouts.app')
@vite('resources/css/app.css', 'resources/js/app.js')

@section('content')
<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-[#0B1320] border-gray-200 px-2 sm:px-4 py-2.5 transition-all duration-300">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/1.jpg') }}" class="h-10 mr-3" alt="Fresh Kicks Logo" />
        </a>
        <div class="flex md:order-2">
            <a href="{{ route('filament.customer.auth.login') }}" class="text-white bg-[#374151] hover:bg-[#111827] focus:ring-4 focus:outline-none focus:ring-[#111827] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</a>
            <a href="{{ route('filament.customer.auth.register') }}" class="text-[#333333] bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 ml-3">Sign Up</a>
        </div>
        <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-[#0B1320] text-white">
                <li>
                    <a href="/" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-white md:p-0">Home</a>
                </li>
                <li>
                    <a href="#about" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-white md:p-0">About Us</a>
                </li>
                <li>
                    <a href="{{ route('services') }}" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-white md:p-0">Services</a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-white md:p-0" aria-current="page">Gallery</a>
                </li>
                <li>
                    <a href="{{ route('contactus') }}" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-white md:p-0">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Gallery Section -->
<section class="bg-[#444444] py-16 pt-24">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <div class="border-2 border-white rounded-full px-6 py-3 inline-block mb-8">
                    <h1 class="text-4xl font-bold text-white uppercase">OUR GALLERY</h1>
                </div>
                <p class="text-white text-lg max-w-3xl mx-auto">
                    See the transformation! Before and after photos of our professional shoe cleaning services.
                    From everyday sneakers to luxury boots, we restore your shoes to their original glory.
                </p>
            </div>

            <!-- Gallery Grid - Masonry Layout -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-1-before.jpg') }}" alt="Before Cleaning">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-2-after.jpg') }}" alt="After Cleaning">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-3-before.jpg') }}" alt="White Sneakers Before">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-1-after.jpg') }}" alt="After Cleaning">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-4-before.jpg') }}" alt="Running Shoes Before">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-5-after.jpg') }}" alt="Kids Shoes After">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-2-before.jpg') }}" alt="Leather Boots Before">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-3-after.jpg') }}" alt="White Sneakers After">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-6-before.jpg') }}" alt="Formal Shoes Before">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-4-after.jpg') }}" alt="Running Shoes After">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-5-before.jpg') }}" alt="Kids Shoes Before">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/gallery-6-after.jpg') }}" alt="Formal Shoes After">
                    </div>
                </div>
            </div>

            <!-- Service Categories -->
            <div class="bg-[#5E5E5E] rounded-lg p-8 mb-16">
                <h2 class="text-2xl font-bold text-white text-center mb-8 uppercase">Service Categories</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sneakers</h3>
                        <p class="text-white text-sm">Casual and athletic shoes</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 010 2h3a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 010-2h2V5h-2a1 1 0 010-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Boots</h3>
                        <p class="text-white text-sm">High boots and work boots</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Formal</h3>
                        <p class="text-white text-sm">Dress shoes and loafers</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-[#0B1320] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Kids</h3>
                        <p class="text-white text-sm">Children's shoes & sandals</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="bg-[#5E5E5E] rounded-lg p-8">
                    <h3 class="text-2xl font-bold text-white mb-4">READY TO SEE YOUR SHOES TRANSFORMED?</h3>
                    <p class="text-white mb-6">Experience the Feasst.id difference. Book your cleaning service today!</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('services') }}" class="bg-white text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            View Services
                        </a>
                        <a href="{{ route('contactus') }}" class="bg-[#0B1320] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#111827] transition duration-300">
                            Contact Us
                        </a>
                    </div>
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
                <p class="text-gray-300 mb-4">Feasst.id Cuci Sepatu Kilat, Jl. Jatisari 3 No.44, Pepelegi, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256</p>
                <p class="text-gray-300">© FEASST.ID 2025</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-300 hover:text-white">Home</a></li>
                    <li><a href="#about" class="text-gray-300 hover:text-white">About Us</a></li>
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
<a href="https://wa.me/6281234567890?text=Halo%20Feasst.id,%20saya%20ingin%20bertanya%20tentang%20layanan%20cuci%20sepatu"
   class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 animate-pulse"
   target="_blank"
   title="Hubungi via WhatsApp">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
    </svg>
</a>

<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
@endsection
