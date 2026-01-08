<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laundry</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }
        
        .container {
            padding: 15px;
            max-width: 100%;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #2563eb;
        }
        
        .logo {
            margin-bottom: 10px;
        }
        
        .logo img {
            height: 50px;
            width: auto;
        }
        
        .header h1 {
            font-size: 22px;
            color: #1e40af;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .header .periode {
            font-size: 11px;
            color: #666;
        }
        
        /* Summary Cards */
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .summary-row {
            display: table-row;
        }
        
        .summary-card {
            display: table-cell;
            width: 25%;
            padding: 10px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            vertical-align: top;
        }
        
        .summary-card h3 {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .summary-card .value {
            font-size: 16px;
            font-weight: bold;
        }
        
        .summary-card .value.success {
            color: #059669;
        }
        
        .summary-card .value.danger {
            color: #dc2626;
        }
        
        .summary-card .value.primary {
            color: #2563eb;
        }
        
        /* Statistics Section */
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .stats-grid {
            display: table;
            width: 100%;
        }
        
        .stats-row {
            display: table-row;
        }
        
        .stats-card {
            display: table-cell;
            width: 33.33%;
            padding: 8px;
            border: 1px solid #e5e7eb;
            text-align: center;
            background-color: #fafafa;
        }
        
        .stats-card .label {
            font-size: 9px;
            color: #6b7280;
            margin-bottom: 3px;
        }
        
        .stats-card .value {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
        }
        
        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        table thead {
            background-color: #2563eb;
            color: white;
        }
        
        table th {
            padding: 8px 6px;
            font-size: 10px;
            font-weight: 600;
            text-align: left;
            border: 1px solid #1e40af;
        }
        
        table th.center {
            text-align: center;
        }
        
        table th.right {
            text-align: right;
        }
        
        table td {
            padding: 6px;
            font-size: 10px;
            border: 1px solid #e5e7eb;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        table tbody tr:hover {
            background-color: #f3f4f6;
        }
        
        table td.center {
            text-align: center;
        }
        
        table td.right {
            text-align: right;
        }
        
        /* Footer */
        .footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }
        
        .footer p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('images/1.jpg') }}" alt="Logo">
            </div>
            <h1>LAPORAN LAUNDRY</h1>
            <p class="periode">
                Periode: {{ $record->periode_awal->format('d/m/Y') }} - {{ $record->periode_akhir->format('d/m/Y') }}
            </p>
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-card">
                    <h3>Total Pendapatan</h3>
                    <div class="value success">Rp {{ number_format($record->total_pendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="summary-card">
                    <h3>Total Pengeluaran</h3>
                    <div class="value danger">Rp {{ number_format($record->total_pengeluaran, 0, ',', '.') }}</div>
                </div>
                <div class="summary-card">
                    <h3>Total Profit</h3>
                    <div class="value {{ $record->total_profit >= 0 ? 'success' : 'danger' }}">
                        Rp {{ number_format($record->total_profit, 0, ',', '.') }}
                    </div>
                </div>
                <div class="summary-card">
                    <h3>Total Pesanan</h3>
                    <div class="value primary">{{ $record->total_pesanan }}</div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="section">
            <h2 class="section-title">Statistik Pesanan</h2>
            <div class="stats-grid">
                <div class="stats-row">
                    <div class="stats-card">
                        <div class="label">Total Sepatu</div>
                        <div class="value">{{ $record->total_sepatu }} Pasang</div>
                    </div>
                    <div class="stats-card">
                        <div class="label">Pesanan Selesai</div>
                        <div class="value" style="color: #059669;">{{ $record->pesanan_selesai }}</div>
                    </div>
                    <div class="stats-card">
                        <div class="label">Pesanan Batal</div>
                        <div class="value" style="color: #dc2626;">{{ $record->pesanan_batal }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Services -->
        @if($record->layanan_terpopuler)
        <div class="section">
            <h2 class="section-title">Layanan Terpopuler</h2>
            <table>
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th class="center">Jumlah</th>
                        <th class="right">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($record->layanan_terpopuler as $layanan)
                    <tr>
                        <td>{{ $layanan['layanan'] }}</td>
                        <td class="center">{{ $layanan['jumlah'] }}</td>
                        <td class="right">Rp {{ number_format($layanan['pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Dibuat oleh:</strong> {{ $record->user->name }}</p>
            <p><strong>Tanggal cetak:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
