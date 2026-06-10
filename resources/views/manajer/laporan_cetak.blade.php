<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Toko - {{ auth()->user()->cabang->nama_cabang }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; }
        .header { background: #1a3c5e; color: white; padding: 20px; text-align: center; margin-bottom: 20px; }
        .header h2 { font-size: 20px; margin-bottom: 4px; }
        .header p  { font-size: 11px; opacity: 0.85; }
        .info-box  { border: 1px solid #ddd; padding: 12px 16px; margin-bottom: 16px; background: #f9f9f9; }
        .info-box table { width: 100%; }
        .info-box td { padding: 3px 6px; }
        .info-box td:first-child { width: 140px; font-weight: bold; color: #555; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #1a3c5e; color: white; padding: 8px 10px; text-align: left; font-size: 11px; }
        table.data td { padding: 7px 10px; border-bottom: 1px solid #eee; font-size: 11px; }
        table.data tr:nth-child(even) { background: #f9f9f9; }
        .badge-penjualan { background: #27ae60; color: white; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .badge-pembelian  { background: #2980b9; color: white; padding: 2px 8px; border-radius: 10px; font-size: 10px; }
        .total-row td { font-weight: bold; background: #eaf4ff; border-top: 2px solid #1a3c5e; }
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #aaa; }
        .ttd { margin-top: 50px; text-align: right; }
        .ttd p { margin-bottom: 50px; }
    </style>
</head>
<body>
<div class="header">
    <h2>LAPORAN TRANSAKSI TOKO</h2>
    <p>{{ auth()->user()->cabang->nama_cabang }} &mdash; {{ auth()->user()->cabang->kota }}</p>
    <p>Periode: {{ $periode }}</p>
</div>

<div class="info-box">
    <table>
        <tr>
            <td>Manajer</td>
            <td>: {{ auth()->user()->name }}</td>
            <td>Tanggal Cetak</td>
            <td>: {{ now()->format('d F Y, H:i') }}</td>
        </tr>
        <tr>
            <td>Cabang</td>
            <td>: {{ auth()->user()->cabang->nama_cabang }}</td>
            <td>Total Data</td>
            <td>: {{ $transaksi->count() }} transaksi</td>
        </tr>
    </table>
</div>

<table style="width:100%; margin-bottom:16px; border-collapse:separate; border-spacing:8px 0;">
    <tr>
        <td style="background:#eafaf1; border:1px solid #27ae60; padding:10px; text-align:center; width:33%">
            <div style="font-size:15px; font-weight:bold; color:#27ae60;">
                Rp {{ number_format($transaksi->where('jenis','penjualan')->sum('total_harga'), 0, ',', '.') }}
            </div>
            <div style="font-size:10px; color:#888;">Total Penjualan</div>
        </td>
        <td style="background:#eaf4ff; border:1px solid #2980b9; padding:10px; text-align:center; width:33%">
            <div style="font-size:15px; font-weight:bold; color:#2980b9;">
                Rp {{ number_format($transaksi->where('jenis','pembelian')->sum('total_harga'), 0, ',', '.') }}
            </div>
            <div style="font-size:10px; color:#888;">Total Pembelian</div>
        </td>
        <td style="background:#eef0f7; border:1px solid #1a3c5e; padding:10px; text-align:center; width:33%">
            <div style="font-size:15px; font-weight:bold; color:#1a3c5e;">
                {{ $transaksi->count() }}
            </div>
            <div style="font-size:10px; color:#888;">Total Transaksi</div>
        </td>
    </tr>
</table>

<table class="data">
    <thead>
        <tr>
            <th>#</th>
            <th>No Transaksi</th>
            <th>Kasir</th>
            <th>Jenis</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaksi as $i => $t)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $t->no_transaksi }}</td>
            <td>{{ $t->user->name }}</td>
            <td>
                @if($t->jenis === 'penjualan')
                    <span class="badge-penjualan">Penjualan</span>
                @else
                    <span class="badge-pembelian">Pembelian</span>
                @endif
            </td>
            <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
            <td>{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center; padding:20px; color:#aaa;">Tidak ada data</td>
        </tr>
        @endforelse
        <tr class="total-row">
            <td colspan="4" style="text-align:right;">TOTAL</td>
            <td>Rp {{ number_format($transaksi->sum('total_harga'), 0, ',', '.') }}</td>
            <td></td>
        </tr>
    </tbody>
</table>

<div class="ttd">
    <p>{{ now()->format('d F Y') }}</p>
    <p>Manajer Toko,</p>
    <br><br><br>
    <p><strong>{{ auth()->user()->name }}</strong></p>
</div>

<div class="footer">
    Dicetak pada {{ now()->format('d F Y H:i:s') }} &mdash; Jayusman Mart Management System
</div>
</body>
</html>