<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jayusman Mart - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a3c5e 0%, #2d6a9f 100%);
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 20px;
            z-index: 100;
        }

        .sidebar .brand {
            color: white;
            font-size: 1.3rem;
            font-weight: bold;
            padding: 10px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 10px;
        }

        .sidebar a {
            color: rgba(255,255,255,0.85);
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left: 3px solid #f0a500;
        }

        .sidebar a i { width: 22px; }

        .main-content {
            margin-left: 250px;
            padding: 25px;
        }

        .topbar {
            background: white;
            padding: 12px 25px;
            margin-left: 250px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .card-header { border-radius: 12px 12px 0 0 !important; }

        .stat-card {
            border-radius: 12px;
            color: white;
            padding: 20px;
        }
        .stat-card .number { font-size: 2rem; font-weight: bold; }
        .stat-card .label  { font-size: 0.9rem; opacity: 0.9; }
        .stat-card i       { font-size: 2.5rem; opacity: 0.4; }

        .badge-role {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="brand">
        <i class="fas fa-store me-2"></i> Jayusman Mart
    </div>

    @auth
        @if(auth()->user()->isOwner())
            <a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="{{ route('owner.cabang.index') }}" class="{{ request()->routeIs('owner.cabang*') ? 'active' : '' }}">
                <i class="fas fa-store"></i> Kelola Cabang
            </a>
            <a href="{{ route('owner.laporan') }}" class="{{ request()->routeIs('owner.laporan*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan Semua Cabang
            </a>

        @elseif(auth()->user()->isManajer())
            <a href="{{ route('manajer.dashboard') }}"><i class="fas fa-chart-bar"></i> Dashboard</a>
            <a href="{{ route('manajer.transaksi.index') }}"><i class="fas fa-receipt"></i> Monitor Transaksi</a>
            <a href="{{ route('manajer.stok.index') }}"><i class="fas fa-boxes"></i> Monitor Stok</a>
            <a href="{{ route('manajer.barang.index') }}"><i class="fas fa-box"></i> Kelola Barang</a>
            <a href="{{ route('manajer.laporan') }}"><i class="fas fa-file-alt"></i> Laporan</a>

        @elseif(auth()->user()->isSupervisor())
            <a href="{{ route('supervisor.dashboard') }}"><i class="fas fa-eye"></i> Dashboard</a>
            <a href="{{ route('supervisor.transaksi.index') }}"><i class="fas fa-receipt"></i> Monitor Transaksi</a>
            <a href="{{ route('supervisor.stok.index') }}"><i class="fas fa-boxes"></i> Monitor Stok</a>
            <a href="{{ route('supervisor.stok.riwayat') }}"><i class="fas fa-history"></i> Riwayat Stok</a>

        @elseif(auth()->user()->isKasir())
            <a href="{{ route('kasir.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('kasir.transaksi.index') }}"><i class="fas fa-receipt"></i> Transaksi</a>
            <a href="{{ route('kasir.transaksi.create') }}"><i class="fas fa-plus-circle"></i> Transaksi Baru</a>

        @elseif(auth()->user()->isGudang())
            <a href="{{ route('gudang.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('gudang.stok.index') }}"><i class="fas fa-boxes"></i> Kelola Stok</a>
            <a href="{{ route('gudang.stok.riwayat') }}"><i class="fas fa-history"></i> Riwayat Stok</a>
        @endif

        <hr style="border-color: rgba(255,255,255,0.2);">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background:none; border:none; width:100%; text-align:left;">
                <a href="#" onclick="this.closest('form').submit()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </button>
        </form>
    @endauth
</div>

{{-- TOPBAR --}}
<div class="topbar">
    <div>
        <strong>@yield('title', 'Dashboard')</strong>
    </div>
    @auth
    <div class="d-flex align-items-center gap-3">
        @if(auth()->user()->cabang)
            <span class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->cabang->nama_cabang }}</span>
        @endif
        <span class="badge bg-primary badge-role">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</span>
        <strong>{{ auth()->user()->name }}</strong>
    </div>
    @endauth
</div>

{{-- MAIN CONTENT --}}
<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>