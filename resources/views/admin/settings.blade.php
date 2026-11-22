@extends('layouts.app')

@section('title', 'Edit Website - Owner')

@section('content')
<section style="padding: 120px 0 60px; background: var(--soft);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: var(--primary-dark); font-weight: 700;">Pengaturan Website</h2>
            <a href="{{ route('home') }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="row g-4">
                
                <!-- 1. Profil / Hero -->
                <div class="col-md-6">
                    <div class="bg-white p-4" style="border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h5 class="mb-3 text-primary border-bottom pb-2">1. Profil (Hero)</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama Usaha</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="hero_desc" class="form-control" rows="4">{{ $settings['hero_desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. Visi & Misi -->
                <div class="col-md-6">
                    <div class="bg-white p-4" style="border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h5 class="mb-3 text-primary border-bottom pb-2">2. Visi & Misi</h5>
                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea name="visi" class="form-control" rows="3">{{ $settings['visi'] ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Misi (Pisahkan dengan Enter/Baris Baru)</label>
                            <textarea name="misi" class="form-control" rows="5">{{ $settings['misi'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 3. Tentang Usaha -->
                <div class="col-md-12">
                    <div class="bg-white p-4" style="border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h5 class="mb-3 text-primary border-bottom pb-2">3. Tentang Usaha</h5>
                        <div class="mb-3">
                            <label class="form-label">Penjelasan Usaha (Pisahkan paragraf dengan Enter)</label>
                            <textarea name="tentang" class="form-control" rows="5">{{ $settings['tentang'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 4. Peran Usaha -->
                <div class="col-md-6">
                    <div class="bg-white p-4" style="border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h5 class="mb-3 text-primary border-bottom pb-2">4. Peran Usaha</h5>
                        <div class="mb-3">
                            <label class="form-label">Tugas Owner</label>
                            <textarea name="peran_owner" class="form-control" rows="3">{{ $settings['peran_owner'] ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tugas Server</label>
                            <textarea name="peran_server" class="form-control" rows="3">{{ $settings['peran_server'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 5. Kontak -->
                <div class="col-md-6">
                    <div class="bg-white p-4" style="border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <h5 class="mb-3 text-primary border-bottom pb-2">5. Kontak & Sosmed</h5>
                        <div class="mb-3">
                            <label class="form-label">Nomor WhatsApp (Awali dengan 62)</label>
                            <input type="text" name="kontak_wa" class="form-control" value="{{ $settings['kontak_wa'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram (Awali dengan @)</label>
                            <input type="text" name="kontak_ig" class="form-control" value="{{ $settings['kontak_ig'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="kontak_email" class="form-control" value="{{ $settings['kontak_email'] ?? '' }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary-custom px-5 py-3">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection