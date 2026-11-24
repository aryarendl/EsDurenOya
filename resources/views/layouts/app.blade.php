@php
    // Mengambil data setting secara global agar bisa dipakai di footer & halaman lain
    $settings = \App\Models\Setting::all()->pluck('value', 'key');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Es Duren Oya')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- PANGGIL FILE CSS KUSTOM DI SINI -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">  
        <a class="navbar-brand" href="{{ url('/') }}#beranda">
            <i class="bi bi-flower1"></i> Es Duren Oya
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#visimisi">Visi & Misi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#peran">Peran Usaha</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#kontak">Kontak</a></li>
                
                @auth
                    {{-- Tombol Khusus Owner --}}
                    @if(Auth::user()->email === 'owner@esdurenoya.com')
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                            <a href="{{ route('kasir.index') }}" class="btn btn-outline-custom btn-sm w-100">
                                <i class="bi bi-calculator"></i> Kasir
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a href="{{ route('admin.settings') }}" class="btn btn-primary-custom btn-sm w-100">
                                <i class="bi bi-gear-fill"></i> Edit Website
                            </a>
                        </li>
                    @endif
                    
                    {{-- Tombol Logout (Semua user yang login) --}}
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100 m-0">
                            @csrf
                            <button class="btn btn-outline-custom btn-sm w-100">Logout</button>
                        </form>
                    </li>
                @else
                    {{-- Tombol Login jika belum masuk --}}
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-outline-custom btn-sm w-100">
                            <i class="bi bi-person-lock"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Konten Utama -->
@yield('content')

<!-- Footer -->
<footer style="background-color: #1f5a37; color: #ffffff; padding: 50px 0 20px; margin-top: 40px;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 style="color: #ffffff; font-weight: 600; margin-bottom: 16px;">
                    <i class="bi bi-flower1" style="color: #f5c542;"></i> Es Duren Oya
                </h5>
                <p style="color: #e2e8f0; font-size: 0.95rem; line-height: 1.6;">
                    Usaha kuliner olahan durian dengan cita rasa autentik dan bahan berkualitas, berlokasi di Cimahi Selatan.
                </p>
            </div>
            
            <div class="col-md-4">
                <h5 style="color: #ffffff; font-weight: 600; margin-bottom: 16px;">Alamat</h5>
                <p style="color: #e2e8f0; font-size: 0.95rem; line-height: 1.6;">
                    <i class="bi bi-geo-alt-fill" style="color: #f5c542;"></i> Jl. Sadarmanah No. 30, Leuwigajah,<br>
                    Kec. Cimahi Selatan, Kota Cimahi,<br>Jawa Barat 40532
                </p>
            </div>
            
            <div class="col-md-4">
                <h5 style="color: #ffffff; font-weight: 600; margin-bottom: 16px;">Kontak</h5>
                <p style="color: #e2e8f0; margin-bottom: 8px;">
                    <i class="bi bi-whatsapp" style="color: #f5c542;"></i> 
                    <a href="https://wa.me/{{ $settings['kontak_wa'] ?? '' }}" target="_blank" style="color: #e2e8f0; text-decoration: none;">+{{ $settings['kontak_wa'] ?? '' }}</a>
                </p>
                <p style="color: #e2e8f0; margin-bottom: 8px;">
                    <i class="bi bi-instagram" style="color: #f5c542;"></i> 
                    <a href="#" style="color: #e2e8f0; text-decoration: none;">{{ $settings['kontak_ig'] ?? '' }}</a>
                </p>
                <p style="color: #e2e8f0; margin-bottom: 8px;">
                    <i class="bi bi-envelope-fill" style="color: #f5c542;"></i> 
                    <a href="mailto:{{ $settings['kontak_email'] ?? '' }}" style="color: #e2e8f0; text-decoration: none;">{{ $settings['kontak_email'] ?? '' }}</a>
                </p>
            </div>
        </div>
        
        <div style="border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 20px; margin-top: 30px; text-align: center;">
            <p style="color: #e2e8f0; font-size: 0.85rem; margin: 0;">
                &copy; {{ date('Y') }} Es Duren Oya. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.navbar-nav a.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const nav = document.getElementById('navbarNav');
            if (nav.classList.contains('show')) {
                new bootstrap.Collapse(nav).hide();
            }
        });
    });

    window.addEventListener('scroll', () => {
        const nav = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            nav.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
        } else {
            nav.style.boxShadow = '0 2px 12px rgba(0,0,0,0.06)';
        }
    });
</script>

{{-- PENTING: Ini agar script dari halaman Kasir & Home bisa berjalan --}}
@stack('scripts')
</body>
</html>