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
                    <a href="/" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white md:p-0">Home</a>
                </li>
                <li>
                    <a href="#about" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white md:p-0">About Us</a>
                </li>
                <li>
                    <a href="{{ route('services') }}" class="block py-2 pl-3 pr-4 text-white bg-[#374151] rounded md:bg-transparent md:text-white md:p-0" aria-current="page">Services</a>
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
            <img src="{{ asset('images/1.jpg') }}" class="h-8 w-8" alt="Fresh Kicks Logo" />
            <span class="self-center text-lg font-semibold whitespace-nowrap text-white">Feasst.id</span>
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
                <a href="/" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="#about" class="flex items-center px-2 py-1.5 text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group">
                    <span class="ms-3">About Us</span>
                </a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="flex items-center px-2 py-1.5 text-white bg-[#374151] rounded-lg hover:bg-gray-700 group" aria-current="page">
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

<!-- Services Section -->
<section class="bg-[#444444] py-16 pt-24">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <div class="border-2 border-white rounded-full px-6 py-3 inline-block mb-8">
                    <h1 class="text-4xl font-bold text-white uppercase">OUR SERVICES</h1>
                </div>
            </div>

            <!-- DEEP CLEANING Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-16">
                <div class="bg-white px-16 py-5 border-b">
                    <h2 class="text-2xl font-bold text-gray-800 uppercase text-center">DEEP CLEANING</h2>
                </div>

                <!-- Service Items -->
                <div class="p-8 space-y-6">
                    <!-- 1 PASANG SEPATU -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">1 PASANG SEPATU</h3>
                            <p class="text-gray-600 text-sm">Deep clean jenis dan bahan sandal/sepatu (kecuali boots)</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">85K</span>
                        </div>
                    </div>

                    <!-- 2-3 PASANG SEPATU -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">2-3 PASANG SEPATU (HARGA PER PASANG)</h3>
                            <p class="text-gray-600 text-sm">Deep clean semua jenis dan bahan sandal/sepatu (kecuali boots)</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">80K</span>
                        </div>
                    </div>

                    <!-- 4+ PASANG SEPATU -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">4+ PASANG SEPATU (HARGA PER PASANG)</h3>
                            <p class="text-gray-600 text-sm">Deep clean semua jenis dan bahan sandal/sepatu (kecuali boots)</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">75K</span>
                        </div>
                    </div>

                    <!-- 1 PASANG SEPATU BOOTS -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">1 PASANG SEPATU BOOTS / HIGH BOOTS</h3>
                            <p class="text-gray-600 text-sm">Deep clean semua jenis dan bahan sepatu boots</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">95K / 105K</span>
                        </div>
                    </div>

                    <!-- 2+ PASANG SEPATU BOOTS -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">2+ PASANG SEPATU BOOTS / HIGH BOOTS</h3>
                            <p class="text-gray-600 text-sm">Deep clean semua jenis dan bahan sepatu boots</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">@90K / @100K</span>
                        </div>
                    </div>

                    <!-- LEATHER TREATMENT -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">LEATHER TREATMENT SEPATU / BOOTS KULIT</h3>
                            <p class="text-gray-600 text-sm">Special polished treatment dari Saphir Medaille D'or Paris</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">+10K / +15K</span>
                        </div>
                    </div>

                    <!-- SEPATU ANAK -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">SEPATU ANAK</h3>
                            <p class="text-gray-600 text-sm">Deep clean semua jenis dan bahan sepatu anak (maksimal size 33)</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">60K</span>
                        </div>
                    </div>

                    <!-- BAG -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">BAG</h3>
                            <p class="text-gray-600 text-sm">Let's clean your backpack, totebag, sling bag, etc!</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">150-300K</span>
                        </div>
                    </div>

                    <!-- ONE DAY SERVICE -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">ONE DAY SERVICE SEPATU DEWASA / ANAK</h3>
                            <p class="text-gray-600 text-sm">Drop your shoes today & get them cleaned by tomorrow!</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">100K / 75K</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADDITIONAL CARE Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-16">
                <div class="bg-white px-16 py-5 border-b">
                    <h2 class="text-2xl font-bold text-gray-800 uppercase text-center">ADDITIONAL CARE</h2>
                </div>

                <!-- Service Items -->
                <div class="p-8 space-y-6">
                    <!-- UNYELLOWING MIDSOLE -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">UNYELLOWING MIDSOLE</h3>
                            <p class="text-gray-600 text-sm">Get rid of the yellow shoes midsole (exclude cleaning).</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">95K</span>
                        </div>
                    </div>

                    <!-- REPAIR SOLE LEPAS -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">REPAIR SOLE LEPAS</h3>
                            <p class="text-gray-600 text-sm">Repair untuk midsole/outsole sepatu yang lepas</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">105K</span>
                        </div>
                    </div>

                    <!-- REPAIR LAINNYA -->
                    <div class="flex justify-between items-center py-4 border-b border-gray-200">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">REPAIR LAINNYA (SEPATU & TAS)</h3>
                            <p class="text-gray-600 text-sm">Seperti pergantian karet, sole/dll (silakan dikonsultasikan dahulu)</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">185k - 295k</span>
                        </div>
                    </div>

                    <!-- REPAINT -->
                    <div class="flex justify-between items-center py-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">REPAINT</h3>
                            <p class="text-gray-600 text-sm">Restoring color and vibrancy to your worn-out shoes.</p>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-800">150-300K</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="bg-[#5E5E5E] rounded-lg p-8">
                    <h3 class="text-2xl font-bold text-white mb-4">READY TO GET YOUR SHOES CLEANED?</h3>
                    <p class="text-white mb-6">Contact us today to schedule your shoe cleaning service!</p>
                    <a href="{{ route('contactus') }}" class="bg-white text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                        Contact Us Now
                    </a>
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
