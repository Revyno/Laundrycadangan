<div class="space-y-6">
    <div>
        <h3 class="text-lg font-semibold mb-3">Detail Pesanan</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Layanan:</p>
                <p class="font-medium">{{ $record->layanan->nama_layanan ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Jenis Sepatu:</p>
                <p class="font-medium">{{ $record->jenisSepatu->nama_jenis ?? 'N/A' }} - {{ $record->jenisSepatu->merek ?? '' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Jumlah Pasang:</p>
                <p class="font-medium">{{ $record->jumlah_pasang }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Kondisi Sepatu:</p>
                <p class="font-medium capitalize">{{ $record->kondisi_sepatu }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-3">Foto Sebelum</h3>
            @if($record->foto_sebelum)
                <div class="border rounded-lg p-4 bg-gray-50">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($record->foto_sebelum) }}" 
                         alt="Foto Sebelum" 
                         class="w-full h-auto rounded-lg shadow-md">
                </div>
            @else
                <div class="border rounded-lg p-8 bg-gray-50 text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Belum ada foto</p>
                </div>
            @endif
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-3">Foto Sesudah</h3>
            @if($record->foto_sesudah)
                <div class="border rounded-lg p-4 bg-gray-50">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($record->foto_sesudah) }}" 
                         alt="Foto Sesudah" 
                         class="w-full h-auto rounded-lg shadow-md">
                </div>
            @else
                <div class="border rounded-lg p-8 bg-gray-50 text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Belum ada foto</p>
                </div>
            @endif
        </div>
    </div>

    @if($record->catatan_khusus)
        <div>
            <h3 class="text-lg font-semibold mb-2">Catatan Khusus</h3>
            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $record->catatan_khusus }}</p>
        </div>
    @endif
</div>

