@extends('layouts.app')


@section('content')
<x-navbar currentPage="services" />

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
        </div>
    </div>
</section>

<x-footer />

<!-- Flowbite JS -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> --}}
@endsection
