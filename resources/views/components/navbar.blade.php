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
                    <a href="{{ route('home') }}" class="block py-2 pl-3 pr-4 {{ $currentPage == 'home' ? 'text-white bg-[#374151] rounded md:bg-transparent md:text-white' : 'text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white' }} md:p-0" {{ $currentPage == 'home' ? 'aria-current="page"' : '' }}>Home</a>
                </li>
                <li>
                    <a href="{{ route('services') }}" class="block py-2 pl-3 pr-4 {{ $currentPage == 'services' ? 'text-white bg-[#374151] rounded md:bg-transparent md:text-white' : 'text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white' }} md:p-0" {{ $currentPage == 'services' ? 'aria-current="page"' : '' }}>Services</a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}" class="block py-2 pl-3 pr-4 {{ $currentPage == 'gallery' ? 'text-white bg-[#374151] rounded md:bg-transparent md:text-white' : 'text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white' }} md:p-0" {{ $currentPage == 'gallery' ? 'aria-current="page"' : '' }}>Gallery</a>
                </li>
                <li>
                    <a href="{{ route('contactus') }}" class="block py-2 pl-3 pr-4 {{ $currentPage == 'contactus' ? 'text-white bg-[#374151] rounded md:bg-transparent md:text-white' : 'text-gray-300 rounded hover:bg-[#374151] md:hover:bg-transparent md:hover:text-white' }} md:p-0" {{ $currentPage == 'contactus' ? 'aria-current="page"' : '' }}>Contact Us</a>
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
                <a href="{{ route('home') }}" class="flex items-center px-2 py-1.5 {{ $currentPage == 'home' ? 'text-white bg-[#374151] rounded-lg hover:bg-gray-700 group' : 'text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group' }}" {{ $currentPage == 'home' ? 'aria-current="page"' : '' }}>
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="flex items-center px-2 py-1.5 {{ $currentPage == 'services' ? 'text-white bg-[#374151] rounded-lg hover:bg-gray-700 group' : 'text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group' }}" {{ $currentPage == 'services' ? 'aria-current="page"' : '' }}>
                    <span class="ms-3">Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery') }}" class="flex items-center px-2 py-1.5 {{ $currentPage == 'gallery' ? 'text-white bg-[#374151] rounded-lg hover:bg-gray-700 group' : 'text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group' }}" {{ $currentPage == 'gallery' ? 'aria-current="page"' : '' }}>
                    <span class="ms-3">Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('contactus') }}" class="flex items-center px-2 py-1.5 {{ $currentPage == 'contactus' ? 'text-white bg-[#374151] rounded-lg hover:bg-gray-700 group' : 'text-gray-300 rounded-lg hover:bg-[#374151] hover:text-white group' }}" {{ $currentPage == 'contactus' ? 'aria-current="page"' : '' }}>
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
