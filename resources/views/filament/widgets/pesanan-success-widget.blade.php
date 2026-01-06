<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Tingkat Keberhasilan Pesanan
        </x-slot>

        <x-slot name="description">
            Statistik keseluruhan pesanan berdasarkan status penyelesaian
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Total Pesanan -->
            <div class=" from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-blue-800">Total Pesanan</h3>
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-blue-700">{{ number_format($totalPesanan) }}</p>
                <p class="text-xs text-blue-600 mt-2">Total semua pesanan</p>
            </div>

            <!-- Pesanan Selesai -->
            <div class=" from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-green-800">Pesanan Selesai</h3>
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ number_format($pesananSelesai) }}</p>
                <p class="text-xs text-green-600 mt-2">Berhasil diselesaikan</p>
            </div>

            <!-- Pesanan Dalam Proses -->
            <div class=" from-yellow-50 to-yellow-100 border-l-4 border-yellow-500 rounded-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-yellow-800">Dalam Proses</h3>
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-yellow-700">{{ number_format($pesananProses) }}</p>
                <p class="text-xs text-yellow-600 mt-2">Sedang diproses</p>
            </div>

            <!-- Pesanan Batal -->
            <div class=" from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-red-800">Pesanan Batal</h3>
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-red-700">{{ number_format($pesananBatal) }}</p>
                <p class="text-xs text-red-600 mt-2">Dibatalkan</p>
            </div>
        </div>

        <!-- Progress Bar Success Rate -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tingkat Keberhasilan Pesanan</h3>
            <div class="mb-2 flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Success Rate</span>
                <span class="text-sm font-bold text-blue-600">{{ number_format($successRate, 1) }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class=" from-blue-500 to-green-500 h-4 rounded-full transition-all duration-500" style="width: {{ $successRate }}%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2">{{ $pesananSelesai }} dari {{ $totalPesanan }} pesanan berhasil diselesaikan</p>
        </div>

        <!-- Status Distribution -->
        <div class="mt-6">
            <h4 class="text-md font-semibold text-gray-800 mb-4">Distribusi Status Pesanan</h4>
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center">
                    <div class="relative w-24 h-24 mx-auto">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#e5e7eb" stroke-width="2"/>
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#10b981" stroke-width="2"
                                  stroke-dasharray="{{ ($pesananSelesai / max($totalPesanan, 1)) * 100 }}, 100"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-lg font-bold text-green-600">{{ number_format(($pesananSelesai / max($totalPesanan, 1)) * 100, 0) }}%</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Selesai</p>
                </div>

                <div class="text-center">
                    <div class="relative w-24 h-24 mx-auto">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#e5e7eb" stroke-width="2"/>
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#f59e0b" stroke-width="2"
                                  stroke-dasharray="{{ ($pesananProses / max($totalPesanan, 1)) * 100 }}, 100"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-lg font-bold text-yellow-600">{{ number_format(($pesananProses / max($totalPesanan, 1)) * 100, 0) }}%</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Proses</p>
                </div>

                <div class="text-center">
                    <div class="relative w-24 h-24 mx-auto">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#e5e7eb" stroke-width="2"/>
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#ef4444" stroke-width="2"
                                  stroke-dasharray="{{ ($pesananBatal / max($totalPesanan, 1)) * 100 }}, 100"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-lg font-bold text-red-600">{{ number_format(($pesananBatal / max($totalPesanan, 1)) * 100, 0) }}%</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Batal</p>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
