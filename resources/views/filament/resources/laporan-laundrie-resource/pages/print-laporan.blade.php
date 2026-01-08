<x-filament-panels::page>
    <div class="print-container" id="printable">
        <!-- Header Laporan -->
        <div class="mb-6 text-center border-b-4 border-primary-600 pb-4">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/1.jpg') }}" alt="Feastid Logo" class="h-20 w-auto">
            </div>
            <h1 class="text-3xl font-bold text-primary-700">LAPORAN LAUNDRY</h1>
            <p class="text-sm text-gray-600 mt-2">
                Periode: {{ $record->periode_awal->format('d/m/Y') }} - {{ $record->periode_akhir->format('d/m/Y') }}
            </p>
        </div>

        <!-- Informasi Umum -->
        <div class="mb-6 grid grid-cols-2 gap-4">
            <div class="rounded-lg border p-4">
                <h3 class="mb-2 font-semibold">Total Pendapatan</h3>
                <p class="text-2xl font-bold text-success-600">Rp {{ number_format($record->total_pendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="rounded-lg border p-4">
                <h3 class="mb-2 font-semibold">Total Pengeluaran</h3>
                <p class="text-2xl font-bold text-danger-600">Rp {{ number_format($record->total_pengeluaran, 0, ',', '.') }}</p>
            </div>
            <div class="rounded-lg border p-4">
                <h3 class="mb-2 font-semibold">Total Profit</h3>
                <p class="text-2xl font-bold {{ $record->total_profit >= 0 ? 'text-success-600' : 'text-danger-600' }}">
                    Rp {{ number_format($record->total_profit, 0, ',', '.') }}
                </p>
            </div>
            <div class="rounded-lg border p-4">
                <h3 class="mb-2 font-semibold">Total Pesanan</h3>
                <p class="text-2xl font-bold">{{ $record->total_pesanan }}</p>
            </div>
        </div>

        <!-- Statistik Pesanan -->
        <div class="mb-6">
            <h3 class="mb-3 text-lg font-semibold">Statistik Pesanan</h3>
            <div class="grid grid-cols-3 gap-4">
                <div class="rounded-lg border p-4 text-center">
                    <p class="text-sm text-gray-600">Total Sepatu</p>
                    <p class="text-xl font-bold">{{ $record->total_sepatu }} Pasang</p>
                </div>
                <div class="rounded-lg border p-4 text-center">
                    <p class="text-sm text-gray-600">Pesanan Selesai</p>
                    <p class="text-xl font-bold text-success-600">{{ $record->pesanan_selesai }}</p>
                </div>
                <div class="rounded-lg border p-4 text-center">
                    <p class="text-sm text-gray-600">Pesanan Batal</p>
                    <p class="text-xl font-bold text-danger-600">{{ $record->pesanan_batal }}</p>
                </div>
            </div>
        </div>

        <!-- Layanan Terpopuler -->
        @if($record->layanan_terpopuler)
        <div class="mb-6">
            <h3 class="mb-3 text-lg font-semibold">Layanan Terpopuler</h3>
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="">
                        <th class="border p-2 text-left">Layanan</th>
                        <th class="border p-2 text-center">Jumlah</th>
                        <th class="border p-2 text-right">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($record->layanan_terpopuler as $layanan)
                    <tr>
                        <td class="border p-2">{{ $layanan['layanan'] }}</td>
                        <td class="border p-2 text-center">{{ $layanan['jumlah'] }}</td>
                        <td class="border p-2 text-right">Rp {{ number_format($layanan['pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Footer -->
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>Dibuat oleh: {{ $record->user->name }}</p>
            <p>Tanggal cetak: {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex justify-center gap-4 no-print">
        <x-filament::button
            color="primary"
            icon="heroicon-o-printer"
            onclick="window.print()"
        >
            Cetak Laporan
        </x-filament::button>
        
        <x-filament::button
            color="success"
            icon="heroicon-o-arrow-down-tray"
            wire:click="downloadPdf"
        >
            Download PDF
        </x-filament::button>
    </div>

    <style>
        @media print {
            .no-print {
                display: none;
            }
            .print-container {
                padding: 20px;
            }
        }
    </style>
</x-filament-panels::page>
