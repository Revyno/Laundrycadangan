<nav class="bg-[#0B1320] fixed w-full z-50 top-0 start-0 border-b border-gray-800">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
 <a href="/" class="flex items-center">
            <img src="{{ asset('images/1.jpg') }}" class="h-10 mr-3" alt="Fresh Kicks Logo" />
        </a>
  <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <div class="hidden md:flex gap-2">
          <a href="{{ route('filament.customer.auth.login') }}" class="text-white bg-[#374151] hover:bg-gray-800 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">Login</a>
          <a href="{{ route('filament.customer.auth.register') }}" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">Sign Up</a>
      </div>
       <!-- Mobile Auth Buttons (visible in menu, here just toggle) -->
      <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600" aria-controls="navbar-cta" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-700 rounded-lg bg-[#111827] md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent">
      <li>
        <a href="{{ route('home') }}" class="block py-2 px-3 md:p-0 {{ $currentPage == 'home' ? 'text-white bg-gray-700 rounded md:bg-transparent md:bg-gray-800' : 'text-gray-400 rounded hover:bg-gray-700 md:hover:bg-transparent md:hover:text-white' }}" aria-current="page">Home</a>
      </li>
      <li>
        <a href="{{ route('services') }}" class="block py-2 px-3 md:p-0 {{ $currentPage == 'services' ? 'text-white bg-gray-700 rounded md:bg-transparent md:bg-gray-800' : 'text-gray-400 rounded hover:bg-gray-700 md:hover:bg-transparent md:hover:text-white' }}">Services</a>
      </li>
      <li>
        <a href="{{ route('gallery') }}" class="block py-2 px-3 md:p-0 {{ $currentPage == 'gallery' ? 'text-white bg-gray-700 rounded md:bg-transparent md:bg-gray-800' : 'text-gray-400 rounded hover:bg-gray-700 md:hover:bg-transparent md:hover:text-white' }}">Gallery</a>
      </li>
      <li>
        <a href="{{ route('contactus') }}" class="block py-2 px-3 md:p-0 {{ $currentPage == 'contactus' ? 'text-white bg-gray-700 rounded md:bg-transparent md:bg-gray-800' : 'text-gray-400 rounded hover:bg-gray-700 md:hover:bg-transparent md:hover:text-white' }}">Contact Us</a>
      </li>
        <!-- Mobile Auth Links -->
       <li class="md:hidden mt-2 pt-2 border-t border-gray-700">
           <a href="{{ route('filament.customer.auth.login') }}" class="block py-2 px-3 text-gray-400 rounded hover:bg-gray-700">Login</a>
       </li>
       <li class="md:hidden">
           <a href="{{ route('filament.customer.auth.register') }}" class="block py-2 px-3 text-white font-bold rounded hover:bg-gray-700">Sign Up</a>
       </li>
    </ul>
  </div>
  </div>
</nav>
