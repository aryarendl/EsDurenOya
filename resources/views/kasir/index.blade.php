@extends('layouts.app')

@section('title', 'Sistem Kasir')

@section('content')
<section style="padding: 120px 0 60px; background: var(--soft); min-height: 100vh;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: var(--primary-dark); font-weight: 700;">Sistem Kasir</h2>
            <a href="{{ route('kasir.laporan') }}" class="btn btn-outline-custom">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan Penjualan
            </a>
        </div>

        <div class="row g-4">
            <!-- Kiri: Daftar Menu -->
            <div class="col-md-7">
                <div class="bg-white p-4 shadow-sm" style="border-radius: 15px;">
                    <h5 class="mb-3 border-bottom pb-2">Pilih Menu</h5>
                    <div class="row g-3">
                        @forelse($menus as $menu)
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm menu-item" 
                                 onclick="addToCart({{ $menu->id }}, '{{ addslashes($menu->nama) }}', {{ $menu->harga }}, {{ $menu->stok }})"
                                 style="border-radius: 10px; cursor: pointer; transition: 0.2s;"
                                 onmouseover="this.style.transform='scale(1.02)'" 
                                 onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">{{ $menu->nama }}</h6>
                                    <span class="text-success fw-bold small">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                    <div class="text-muted small mt-1">Stok tersedia: <strong>{{ $menu->stok }}</strong></div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">Tidak ada menu yang tersedia (semua habis).</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Kanan: Keranjang & Pembayaran -->
            <div class="col-md-5">
                <div class="bg-white p-4 shadow-sm" style="border-radius: 15px;">
                    <h5 class="mb-3 border-bottom pb-2">Pesanan</h5>
                    <div id="cart-list" style="max-height: 300px; overflow-y: auto;">
                        <p class="text-muted text-center my-3" id="empty-cart">Belum ada pesanan.</p>
                    </div>
                    
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                        <span>Total:</span>
                        <span id="total-display" class="text-success">Rp 0</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran</label>
                        <select id="metode_pembayaran" class="form-select" onchange="togglePembayaran()">
                            <option value="cash">Tunai (Cash)</option>
                            <option value="qris">QRIS / Transfer</option>
                        </select>
                    </div>

                     <div id="qris-area" class="mb-3 text-center d-none">
                        <div class="alert alert-info py-2">
                            <i class="bi bi-info-circle-fill"></i> Pembayaran via QRIS / Transfer
                        </div>
                        <h4 class="fw-bold text-success mt-3" id="qris-nominal"></h4>
                        <p class="text-muted small">Silakan lakukan pembayaran sesuai nominal di atas.</p>
                    </div>

                    <div class="mb-3" id="input-cash">
                        <label class="form-label fw-bold">Uang Diterima (Rp)</label>
                        <input type="number" id="nominal_bayar" class="form-control" oninput="hitungKembalian()" placeholder="Masukkan nominal...">
                    </div>

                    <div class="mb-3 d-flex justify-content-between text-primary fw-bold d-none" id="kembalian-display">
                        <span>Kembalian:</span>
                        <span id="nominal-kembalian">Rp 0</span>
                    </div>

                    <button class="btn btn-primary-custom w-100 mt-2 py-3" onclick="prosesTransaksi()" id="btn-bayar" disabled>
                        <i class="bi bi-check-circle"></i> Proses Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    let cart = [];
    let total = 0;

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    function addToCart(id, nama, harga, stok) {
        const existing = cart.find(item => item.id === id);
        if (existing) {
            if (existing.jumlah < stok) {
                existing.jumlah++;
            } else {
                alert('Stok tidak mencukupi!');
            }
        } else {
            if (stok > 0) {
                cart.push({ id, nama, harga, jumlah: 1, stok: stok });
            } else {
                alert('Stok habis!');
            }
        }
        renderCart();
    }

    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        renderCart();
    }

    function reduceQty(id) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.jumlah--;
            if (item.jumlah <= 0) removeFromCart(id);
            else renderCart();
        }
    }

    function renderCart() {
        const container = document.getElementById('cart-list');
        const emptyText = document.getElementById('empty-cart');
        container.innerHTML = '';
        total = 0;

        if (cart.length === 0) {
            container.appendChild(emptyText);
            document.getElementById('total-display').innerText = 'Rp 0';
            document.getElementById('btn-bayar').disabled = true;
            if(document.getElementById('metode_pembayaran').value === 'qris') {
                document.getElementById('qris-area').classList.add('d-none');
            }
            return;
        }

        cart.forEach(item => {
            const subtotal = item.harga * item.jumlah;
            total += subtotal;
            
            const disablePlus = item.jumlah >= item.stok ? 'disabled' : '';
            
            container.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <div>
                        <div class="fw-bold">${item.nama}</div>
                        <div class="text-muted small">${formatRupiah(item.harga)} x ${item.jumlah}</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-danger" onclick="reduceQty(${item.id})">-</button>
                        <span class="fw-bold">${item.jumlah}</span>
                        <button class="btn btn-sm btn-outline-success" onclick="addToCart(${item.id}, '${item.nama}', ${item.harga}, ${item.stok})" ${disablePlus}>+</button>
                    </div>
                </div>
            `;
        });

        document.getElementById('total-display').innerText = formatRupiah(total);
        
        // Cek metode pembayaran saat update keranjang
        if(document.getElementById('metode_pembayaran').value === 'qris') {
            updateQRIS();
            document.getElementById('btn-bayar').disabled = false; 
        } else {
            hitungKembalian();
        }
    }

    function togglePembayaran() {
        const metode = document.getElementById('metode_pembayaran').value;
        const inputCash = document.getElementById('input-cash');
        const qrisArea = document.getElementById('qris-area');
        const btnBayar = document.getElementById('btn-bayar');

        if (metode === 'cash') {
            inputCash.classList.remove('d-none');
            qrisArea.classList.add('d-none');
            hitungKembalian();
        } else {
            inputCash.classList.add('d-none');
            document.getElementById('kembalian-display').classList.add('d-none');
            qrisArea.classList.remove('d-none');
            updateQRIS(); 
            
            btnBayar.disabled = cart.length === 0; 
        }
    }

    function updateQRIS() {
        if (total > 0) {
            document.getElementById('qris-nominal').innerText = `Total Tagihan: ${formatRupiah(total)}`;

        } else {
            document.getElementById('qris-nominal').innerText = '';
                }
        }

    function hitungKembalian() {
        const metode = document.getElementById('metode_pembayaran').value;
        if (metode !== 'cash') return;

        const nominal = parseInt(document.getElementById('nominal_bayar').value) || 0;
        const kembalian = nominal - total;
        const kembalianDisplay = document.getElementById('kembalian-display');
        const btnBayar = document.getElementById('btn-bayar');

        if (nominal >= total && cart.length > 0) {
            kembalianDisplay.classList.remove('d-none');
            document.getElementById('nominal-kembalian').innerText = formatRupiah(kembalian);
            btnBayar.disabled = false;
        } else {
            kembalianDisplay.classList.add('d-none');
            btnBayar.disabled = true;
        }
    }

    function prosesTransaksi() {
        const metode = document.getElementById('metode_pembayaran').value;
        const nominal = metode === 'cash' ? parseInt(document.getElementById('nominal_bayar').value) : total;
        
        const data = {
            _token: '{{ csrf_token() }}',
            items: cart,
            total_harga: total,
            nominal_bayar: nominal,
            metode_pembayaran: metode
        };

        const btn = document.getElementById('btn-bayar');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
        btn.disabled = true;

        fetch('{{ route('kasir.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.success) {
                alert('Transaksi Berhasil!');
                window.location.reload();
            } else {
                alert(res.message || 'Terjadi kesalahan');
                btn.innerHTML = '<i class="bi bi-check-circle"></i> Proses Pembayaran';
            }
        })
        .catch(err => {
            alert('Gagal memproses transaksi');
            console.error(err);
            btn.innerHTML = '<i class="bi bi-check-circle"></i> Proses Pembayaran';
        });
    }
</script>
@endpush