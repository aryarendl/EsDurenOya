@extends('layouts.app')

@section('title', 'Es Duren Oya - Olahan Durian Segar Cimahi')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero" id="beranda">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge-owner mb-3 d-inline-block">
                    <i class="bi bi-geo-alt-fill"></i> Cimahi Selatan
                </span>
                {{-- Mengambil Judul dan Deskripsi dari Database --}}
                <h1 class="mb-3">{{ $settings['hero_title'] ?? 'Es Duren Oya' }}</h1>
                <p class="mb-4">{{ $settings['hero_desc'] ?? '' }}</p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="#menu" class="btn btn-primary-custom"><i class="bi bi-book"></i> Lihat Menu</a>
                    <a href="#kontak" class="btn btn-outline-custom"><i class="bi bi-geo-alt"></i> Lokasi Kami</a>
                </div>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <div style="font-size: 14rem; line-height: 1; color: var(--primary); opacity: .15;">
                    <i class="bi bi-flower1"></i>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ MENU (dari DATABASE) ============ --}}
<section id="menu" style="background: var(--soft);">
    <div class="container">
        <div class="section-title">
            <h2>Menu Es Duren Oya</h2>
            <p>Berbagai pilihan olahan durian yang menggugah selera</p>

            @auth
            @if(Auth::user()->email === 'owner@esdurenoya.com')
            <button class="btn btn-primary-custom mt-3" data-bs-toggle="modal" data-bs-target="#modalTambahMenu">
                <i class="bi bi-plus-circle"></i> Tambah Menu
            </button>
            @endif
            @endauth
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-4">
            @forelse($menus as $menu)
            <div class="col-md-6 col-lg-4">
                <div class="menu-card">
                    @if($menu->foto)
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama }}">
                    @else
                    <div class="placeholder-img"><i class="bi bi-image"></i></div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="mb-2">
                                {{ $menu->nama }}
                                {{-- Tampilkan Badge HABIS jika statusnya true --}}
                                @if($menu->is_sold_out)
                                <span class="badge bg-danger"
                                    style="font-size: 0.6rem; vertical-align: middle;">HABIS</span>
                                @endif
                            </h5>

                            {{-- TOMBOL EDIT & HAPUS (HANYA OWNER) --}}
                            @auth
                            @if(Auth::user()->email === 'owner@esdurenoya.com')
                            <div class="d-flex align-items-center">
                                {{-- TOMBOL TOGGLE SOLD OUT --}}
                                <button onclick="toggleSoldOut({{ $menu->id }})"
                                    class="btn btn-sm {{ $menu->is_sold_out ? 'btn-danger' : 'btn-outline-secondary' }} border-0 me-2"
                                    title="Ubah Status Ketersediaan">
                                    <i class="bi bi-power"></i> {{ $menu->is_sold_out ? 'Habis' : 'Tersedia' }}
                                </button>

                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus menu ini dari database?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger border-0">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                        <p class="desc">{{ $menu->deskripsi }}</p>
                        <div class="price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>

                        @auth
                        @if(Auth::user()->email === 'owner@esdurenoya.com')
                        <!-- Tampilkan Sisa Stok & Form Update -->
                        <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                            <span class="small text-muted me-2">Stok:</span>
                            <form action="{{ route('menu.updateStok', $menu->id) }}" method="POST"
                                class="d-flex align-items-center m-0">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="stok" value="{{ $menu->stok }}"
                                    class="form-control form-control-sm me-1" style="width: 60px;" min="0">
                                <button type="submit" class="btn btn-sm btn-primary py-0 px-2" title="Update Stok">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">Belum ada menu yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ============ VISI & MISI ============ --}}
<section id="visimisi">
    <div class="container">
        <div class="section-title">
            <h2>Visi & Misi</h2>
            <p>Arah dan tujuan Es Duren Oya</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="vm-box">
                    <h4><i class="bi bi-eye-fill"></i> Visi</h4>
                    {{-- Mengambil Visi dari Database --}}
                    <p class="mb-0">{{ $settings['visi'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="vm-box">
                    <h4><i class="bi bi-list-check"></i> Misi</h4>
                    {{-- Mengambil Misi dari Database dan memecahnya per baris --}}
                    <ul class="misi-list">
                        @foreach(explode("\n", $settings['misi'] ?? '') as $misi)
                        @if(trim($misi))
                        <li>{{ trim($misi) }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============ TENTANG ============ --}}
<section id="tentang" style="background: var(--soft);">
    <div class="container">
        <div class="section-title">
            <h2>Tentang Usaha</h2>
            <p>Mengenal lebih dekat Es Duren Oya</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="bg-white p-4 p-md-5" style="border-radius: 18px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
                    {{-- Mengambil Teks Tentang dari Database --}}
                    {!! nl2br(e($settings['tentang'] ?? '')) !!}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ PERAN USAHA ============ --}}
<section id="peran">
    <div class="container">
        <div class="section-title">
            <h2>Peran Usaha</h2>
            <p>Pembagian tugas dalam kegiatan usaha Es Duren Oya</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="role-card">
                    <div class="icon-circle"><i class="bi bi-person-badge-fill"></i></div>
                    <h5>Owner</h5>
                    {{-- Mengambil Peran Owner dari Database --}}
                    <p class="text-muted mb-0">{{ $settings['peran_owner'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="role-card">
                    <div class="icon-circle"><i class="bi bi-people-fill"></i></div>
                    <h5>Server</h5>
                    {{-- Mengambil Peran Server dari Database --}}
                    <p class="text-muted mb-0">{{ $settings['peran_server'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ KONTAK ============ --}}
<section id="kontak" style="background: var(--soft);">
    <div class="container">
        <div class="section-title">
            <h2>Lokasi & Kontak</h2>
            <p>Kunjungi atau hubungi kami</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="contact-card">
                    <div class="icon-circle"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h6>Alamat</h6>
                        <p>Jl. Sadarmanah No. 30, Leuwigajah,<br>
                            Kec. Cimahi Selatan, Kota Cimahi,<br>Jawa Barat 40532</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <div class="icon-circle"><i class="bi bi-whatsapp"></i></div>
                    <div>
                        <h6>WhatsApp / Telepon</h6>
                        {{-- Mengambil Kontak WA dari Database --}}
                        <p><a href="https://wa.me/{{ $settings['kontak_wa'] ?? '' }}" target="_blank"
                                class="text-decoration-none text-dark">
                                +{{ $settings['kontak_wa'] ?? '' }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <div class="icon-circle"><i class="bi bi-instagram"></i></div>
                    <div>
                        <h6>Media Sosial</h6>
                        {{-- Mengambil Kontak IG dari Database --}}
                        <p><a href="#" class="text-decoration-none text-dark">{{ $settings['kontak_ig'] ?? '' }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <div class="icon-circle"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <h6>Jam Operasional</h6>
                        <p>Setiap Hari: 11.00 - 20.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="https://maps.app.goo.gl/xSE2VrtTp22atHYo7" target="_blank" class="btn btn-primary-custom">
                <i class="bi bi-map-fill"></i> Lihat Lokasi di Google Maps
            </a>
        </div>

        <div class="mt-5" style="border-radius: 18px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <iframe src="https://www.google.com/maps?q=Jl.+Sadarmanah+No.30,+Leuwigajah,+Cimahi+Selatan&output=embed"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</section>

{{-- ============ MODAL TAMBAH MENU (HANYA OWNER) ============ --}}
@auth
<div class="modal fade" id="modalTambahMenu" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Tambah Menu Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="harga" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Menu (opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Awal <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control" required min="0" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-save"></i> Simpan ke Database
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

@endsection

@push('scripts')
<script>
function toggleSoldOut(id) {
    fetch(`/kasir/menu/${id}/sold-out`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload(); // Refresh halaman untuk update tampilan
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>
@endpush