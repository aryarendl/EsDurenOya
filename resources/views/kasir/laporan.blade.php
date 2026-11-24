@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<section style="padding: 120px 0 60px; background: var(--soft); min-height: 100vh;">
    <div class="container">
        
        {{-- Tombol Navigasi (Tidak tampil saat print) --}}
        <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
            <h2 style="color: var(--primary-dark); font-weight: 700;">Laporan Penjualan</h2>
            <div>
                <button onclick="window.print()" class="btn btn-primary-custom me-2">
                    <i class="bi bi-printer"></i> Cetak / Simpan PDF
                </button>
                <a href="{{ route('kasir.index') }}" class="btn btn-outline-custom">
                    <i class="bi bi-arrow-left"></i> Kembali ke Kasir
                </a>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- 1. TAMPILAN WEB (Di layar saja, tidak dicetak) --}}
        {{-- ========================================== --}}
        <div class="d-print-none">
            <!-- Filter Tanggal -->
            <div class="bg-white p-3 shadow-sm mb-4" style="border-radius: 15px;">
                <form action="{{ route('kasir.laporan') }}" method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                    <label class="fw-bold mb-0">Pilih Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control w-auto" value="{{ $tanggal }}">
                    <button type="submit" class="btn btn-primary-custom">Tampilkan</button>
                </form>
            </div>

            <!-- Ringkasan Web -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="bg-white p-4 shadow-sm text-center" style="border-radius: 15px; border-left: 5px solid var(--primary);">
                        <h6 class="text-muted">Total Pendapatan</h6>
                        <h3 class="fw-bold text-success">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white p-4 shadow-sm text-center" style="border-radius: 15px; border-left: 5px solid #0d6efd;">
                        <h6 class="text-muted">Pendapatan Tunai (Cash)</h6>
                        <h4 class="fw-bold text-primary">Rp {{ number_format($total_cash, 0, ',', '.') }}</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white p-4 shadow-sm text-center" style="border-radius: 15px; border-left: 5px solid #6f42c1;">
                        <h6 class="text-muted">Pendapatan QRIS/Transfer</h6>
                        <h4 class="fw-bold" style="color: #6f42c1;">Rp {{ number_format($total_qris, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>

            <!-- Konten Web -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-white p-4 shadow-sm h-100" style="border-radius: 15px;">
                        <h5 class="mb-3 border-bottom pb-2">Top 5 Menu Terlaris</h5>
                        @if($menu_terlaris->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($menu_terlaris as $menu)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                {{ $menu->nama_menu }}
                                <span class="badge bg-success rounded-pill">{{ $menu->total_terjual }} Porsi</span>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p class="text-muted mb-0">Belum ada penjualan hari ini.</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="bg-white p-4 shadow-sm h-100" style="border-radius: 15px;">
                        <h5 class="mb-3 border-bottom pb-2">Daftar Transaksi</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Jam</th>
                                        <th>Pesanan</th>
                                        <th>Total</th>
                                        <th>Metode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->created_at->format('H:i') }}</td>
                                        <td>
                                            <ul class="list-unstyled mb-0 small">
                                                @foreach($order->items as $item)
                                                <li>{{ $item->jumlah }}x {{ $item->nama_menu }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="fw-bold text-success">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($order->metode_pembayaran == 'cash')
                                            <span class="badge bg-primary">Tunai</span>
                                            @else
                                            <span class="badge" style="background-color: #6f42c1; color: white;">QRIS</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Tidak ada transaksi.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- 2. TAMPILAN PRINT (Hanya muncul saat dicetak) --}}
        {{-- ========================================== --}}
        <div class="d-none d-print-block">
            <div class="text-center mb-4">
                <h3 class="fw-bold mb-1" style="color: #000; margin: 0;">Es Duren Oya</h3>
                <h5 class="fw-bold" style="color: #000; margin: 0;">Laporan Penjualan Harian</h5>
                <p class="text-muted" style="font-size: 12pt; margin: 5px 0;">
                    Tanggal: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                </p>
            </div>

            {{-- Ringkasan Sejajar dengan Garis Pemisah --}}
            <div class="row mb-4 text-center">
                <div class="col-4" style="border-right: 1px solid #ccc;">
                    <div class="text-muted small">Total Pendapatan</div>
                    <div class="fw-bold fs-5" style="color: #000;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="col-4" style="border-right: 1px solid #ccc;">
                    <div class="text-muted small">Tunai (Cash)</div>
                    <div class="fw-bold fs-6" style="color: #000;">Rp {{ number_format($total_cash, 0, ',', '.') }}</div>
                </div>
                <div class="col-4">
                    <div class="text-muted small">QRIS / Transfer</div>
                    <div class="fw-bold fs-6" style="color: #000;">Rp {{ number_format($total_qris, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="mb-4">
                <span class="fw-bold me-2" style="font-size: 11pt; color: #000;">Menu Terlaris:</span>
                @forelse($menu_terlaris as $menu)
                    <span class="badge bg-light text-dark border me-1" style="font-weight: 500;">
                        {{ $menu->nama_menu }} ({{ $menu->total_terjual }})
                    </span>
                @empty
                    <span class="text-muted small">Belum ada.</span>
                @endforelse
            </div>

            {{-- Tabel Garis Minimalis (Sesuai Foto 2) --}}
            <table class="table align-middle" style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr style="border-bottom: 2px solid #000;">
                        <th class="py-2 px-1 fw-bold" style="color: #000; border: none; text-align: left;">Jam</th>
                        <th class="py-2 px-1 fw-bold" style="color: #000; border: none; text-align: left;">Pesanan</th>
                        <th class="py-2 px-1 fw-bold text-end" style="color: #000; border: none;">Total</th>
                        <th class="py-2 px-1 fw-bold text-center" style="color: #000; border: none;">Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td class="py-2 px-1" style="border: none;">{{ $order->created_at->format('H:i') }}</td>
                        <td class="py-2 px-1" style="border: none;">
                            @foreach($order->items as $item)
                                {{ $item->jumlah }}x {{ $item->nama_menu }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td class="py-2 px-1 fw-bold text-end" style="border: none;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="py-2 px-1 text-center" style="border: none;">
                            {{ $order->metode_pembayaran == 'cash' ? 'Tunai' : 'QRIS' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3" style="border: none;">Tidak ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</section>
@endsection

