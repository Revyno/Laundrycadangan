<x-filament-panels::page>
    <div class="print-container" id="printable">
        <!-- Header Invoice -->
        <div class="mb-6 text-center border-b-2 border-gray-300 pb-4">
            <h1 class="text-3xl font-bold text-gray-800">INVOICE PEMBAYARAN</h1>
            <p class="text-sm text-gray-600 mt-2">FEAST ID</p>
            <p class="text-sm text-gray-600">No. Invoice: {{ $record->id }}</p>
        </div>

        <!-- Informasi Invoice -->
        <div class="mb-6 grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Informasi Customer</h3>
                <div class="text-sm">
                    <p><strong>Nama:</strong> {{ $record->pesanan->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $record->pesanan->customer->email }}</p>
                    <p><strong>Telepon:</strong> {{ $record->pesanan->customer->phone }}</p>
                    <p><strong>Alamat:</strong> {{ $record->pesanan->customer->address }}</p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-2">Detail Invoice</h3>
                <div class="text-sm">
                    <p><strong>No. Invoice:</strong> {{ $record->id }}</p>
                    <p><strong>Kode Pesanan:</strong> {{ $record->pesanan->kode_pesanan }}</p>
                    <p><strong>Tanggal Pembayaran:</strong> {{ $record->tanggal_pembayaran->format('d/m/Y') }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($record->metode_pembayaran) }}</p>
                    @if($record->nomor_referensi)
                    <p><strong>No. Referensi:</strong> {{ $record->nomor_referensi }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-3">Detail Pesanan</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="b">
                        <th class="border  p-3 text-left">Layanan</th>
                        <th class="border  p-3 text-center">Jenis Sepatu</th>
                        <th class="border  p-3 text-center">Jumlah</th>
                        <th class="border  p-3 text-right">Harga Satuan</th>
                        <th class="border  p-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($record->pesanan->detailPesanans as $detail)
                    <tr>
                        <td class="border  p-3">{{ $detail->layanan->nama_layanan }}</td>
                        <td class="border  p-3 text-center">{{ $detail->jenisSepatu->nama_jenis }}</td>
                        <td class="border  p-3 text-center">{{ $detail->jumlah_pasang }} pasang</td>
                        <td class="border  p-3 text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="border  p-3 text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="">
                        <td colspan="4" class="border border-gray-300 p-3 text-right font-semibold">Total Pesanan</td>
                        <td class="border border-gray-300 p-3 text-right font-semibold">{{ $record->pesanan->total_pasang }} pasang</td>
                    </tr>
                    <tr class="">
                        <td colspan="4" class="border border-gray-300 p-3 text-right font-semibold">Jumlah Dibayar</td>
                        <td class="border border-gray-300 p-3 text-right font-semibold">Rp {{ number_format($record->jumlah_dibayar, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Status Pembayaran -->
        <div class="mb-6">
            <div class="inline-block px-4 py-2 rounded-lg {{ $record->status_pembayaran === 'paid' ? 'bg-green-100 text-green-800' : ($record->status_pembayaran === 'partial' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                <strong>Status Pembayaran:</strong> {{ ucfirst($record->status_pembayaran) }}
            </div>
        </div>

        @if($record->catatan)
        <!-- Catatan -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Catatan</h3>
            <p class="text-sm border p-3 rounded">{{ $record->catatan }}</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="mt-8 text-center text-sm text-gray-600 border-t-2 border-gray-300 pt-4">
            <p>Terima kasih telah menggunakan layanan laundry kami!</p>
            <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <!-- Print Button -->
    <div class="mt-6 text-center no-print">
        <x-filament::button
            color="primary"
            icon="heroicon-o-printer"
            onclick="window.print()"
        >
            Cetak Invoice
        </x-filament::button>
    </div>

    <style>
        @media print {
            .no-print {
                display: none;
            }
            .print-container {
                padding: 10px;
                font-size: 10px;
                line-height: 1.2;
            }
            .print-container h1 {
                font-size: 18px;
                margin-bottom: 5px;
            }
            .print-container h3 {
                font-size: 12px;
                margin-bottom: 3px;
            }
            .print-container p {
                margin: 2px 0;
            }
            .print-container table {
                font-size: 9px;
            }
            .print-container .mb-6 {
                margin-bottom: 8px;
            }
            .print-container .mb-3 {
                margin-bottom: 5px;
            }
            .print-container .p-3 {
                padding: 4px;
            }
            .print-container .pb-4 {
                padding-bottom: 8px;
            }
            .print-container .pt-4 {
                padding-top: 8px;
            }
            .print-container .mt-8 {
                margin-top: 10px;
            }
            .print-container .gap-6 {
                gap: 10px;
            }
            .print-container .gap-4 {
                gap: 8px;
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
        }
        table {
            font-size: 10px;
        }
        .print-container {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
</x-filament-panels::page>
