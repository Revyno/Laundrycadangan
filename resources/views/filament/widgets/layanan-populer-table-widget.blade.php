<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Statistik Layanan Populer
        </x-slot>

        <x-slot name="description">
            Daftar layanan berdasarkan jumlah pesanan dan total pemasukan
        </x-slot>

        @if($layananPopuler->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Nama Layanan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Total Pesanan
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Total Pasang
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Total Pemasukan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($layananPopuler as $layanan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $layanan->nama_layanan }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $kategoriLabels = [
                                            'basic' => 'Basic Clean',
                                            'premium' => 'Premium Clean',
                                            'deep' => 'Deep Clean',
                                            'unyellowing' => 'Unyellowing',
                                            'repaint' => 'Repaint',
                                            'repair' => 'Repair',
                                        ];
                                        $kategoriColors = [
                                            'basic' => 'gray',
                                            'premium' => 'blue',
                                            'deep' => 'indigo',
                                            'unyellowing' => 'yellow',
                                            'repaint' => 'purple',
                                            'repair' => 'red',
                                        ];
                                        $label = $kategoriLabels[$layanan->kategori_layanan] ?? ucfirst($layanan->kategori_layanan);
                                        $color = $kategoriColors[$layanan->kategori_layanan] ?? 'gray';
                                    @endphp
                                    @php
                                        $colorClasses = [
                                            'gray' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
                                            'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                            'indigo' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
                                            'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                            'purple' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                            'red' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                        ];
                                        $colorClass = $colorClasses[$color] ?? $colorClasses['gray'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ number_format($layanan->total_pesanan) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ number_format($layanan->total_pasang) }} pasang
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm font-semibold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($layanan->total_pendapatan, 0, ',', '.') }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada data layanan</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data akan muncul setelah ada pembayaran yang dikonfirmasi</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>

