@extends('layouts.app')
{{-- @vite('resources/css/app.css', 'resources/js/app.js') --}}

@section('content')
<x-navbar currentPage="gallery" />

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
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/1.jpg') }}" alt="Before Cleaning">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/2.jpg') }}" alt="After Cleaning">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/3.jpg') }}" alt="White Sneakers Before">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/4.jpg') }}" alt="After Cleaning">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/5.jpg') }}" alt="Running Shoes Before">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/6.jpg') }}" alt="Kids Shoes After">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/7.jpg') }}" alt="Leather Boots Before">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/8.jpg') }}" alt="White Sneakers After">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/9.jpg') }}" alt="Formal Shoes Before">
                    </div>
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/10.jpg') }}" alt="Running Shoes After">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/11.jpg') }}" alt="Kids Shoes Before">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg hover:scale-105 transition-transform duration-300" src="{{ asset('images/galleries/1.jpg') }}" alt="Formal Shoes After">
                    </div>
                </div>
            </div>

            <!-- Service Categories -->
            {{-- <div class="bg-[#5E5E5E] rounded-lg p-8 mb-16">
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
            </div> --}}

            <!-- Call to Action -->
            {{-- <div class="text-center">
                <div class="bg-[#5E5E5E] rounded-lg p-8">
                    <h3 class="text-2xl font-bold text-white mb-4">READY TO SEE YOUR SHOES TRANSFORMED?</h3>
                    <p class="text-white mb-6">Experience the Feast.id difference. Book your cleaning service today!</p>
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
    </div> --}}
</section>

<x-footer />

<!-- Flowbite JS -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}
@endsection
