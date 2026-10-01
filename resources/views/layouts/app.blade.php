<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Es Duren Oya')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2f7a4d;
            --primary-dark: #1f5a37;
            --accent: #f5c542;
            --cream: #fdf8ee;
            --soft: #f5f7f4;
        }
        * { font-family: 'Poppins', sans-serif; }
        body { background: #fff; color: #2b2b2b; }

        .navbar {
            background: rgba(255,255,255,0.98);
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .navbar-brand { font-weight: 700; color: var(--primary) !important; font-size: 1.4rem; }
        .navbar-brand i { color: var(--accent); }
        .nav-link { color: #444 !important; font-weight: 500; }
        .nav-link:hover { color: var(--primary) !important; }

        .btn-primary-custom {
            background: var(--primary); border: none; color: #fff;
            padding: 10px 28px; border-radius: 30px; font-weight: 500;
            transition: .3s;
        }
        .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; transform: translateY(-2px); }

        .btn-outline-custom {
            border: 2px solid var(--primary); color: var(--primary);
            padding: 8px 26px; border-radius: 30px; font-weight: 500;
            background: transparent;
        }
        .btn-outline-custom:hover { background: var(--primary); color: #fff; }

        .hero {
            background: linear-gradient(135deg, var(--cream) 0%, #e8f5ec 100%);
            padding: 140px 0 90px;
        }
        .hero h1 { font-size: 3rem; font-weight: 700; color: var(--primary-dark); }
        .hero h1 span { color: var(--accent); }

        .section-title { text-align: center; margin-bottom: 50px; }
        .section-title h2 {
            font-weight: 700; color: var(--primary-dark); font-size: 2rem;
            position: relative; display: inline-block; padding-bottom: 12px;
        }
        .section-title h2::after {
            content: ''; position: absolute; bottom: 0; left: 50%;
            transform: translateX(-50%); width: 60px; height: 3px;
            background: var(--accent); border-radius: 3px;
        }
        .section-title p { color: #777; margin-top: 12px; }

        section { padding: 80px 0; }

        .menu-card {
            border: none; border-radius: 18px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: .3s;
            height: 100%; background: #fff;
        }
        .menu-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
        .menu-card img, .menu-card .placeholder-img {
            width: 100%; height: 200px; object-fit: cover;
            background: linear-gradient(135deg, #e8f5ec, #fdf8ee);
            display: flex; align-items: center; justify-content: center;
            color: var(--primary); font-size: 3rem;
        }
        .menu-card .card-body { padding: 20px; }
        .menu-card h5 { font-weight: 600; color: #222; margin-bottom: 8px; }
        .menu-card .desc { color: #777; font-size: .9rem; min-height: 42px; }
        .menu-card .price { color: var(--primary); font-weight: 700; font-size: 1.15rem; }

        .badge-owner {
            background: var(--accent); color: #333; padding: 6px 14px;
            border-radius: 20px; font-size: .8rem; font-weight: 600;
        }

        .vm-box {
            background: var(--soft); border-radius: 18px; padding: 30px;
            height: 100%; border-left: 5px solid var(--primary);
        }
        .vm-box h4 { color: var(--primary-dark); font-weight: 600; margin-bottom: 16px; }
        .misi-list { list-style: none; padding: 0; }
        .misi-list li { padding: 8px 0 8px 32px; position: relative; color: #555; }
        .misi-list li::before {
            content: '\F26E'; font-family: 'bootstrap-icons';
            position: absolute; left: 0; top: 8px; color: var(--primary); font-weight: bold;
        }

        .role-card {
            background: #fff; border-radius: 18px; padding: 30px; text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); height: 100%;
            transition: .3s; border-top: 5px solid var(--primary);
        }
        .role-card:hover { transform: translateY(-6px); }
        .role-card .icon-circle {
            width: 70px; height: 70px; background: var(--cream);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; margin: 0 auto 18px;
            font-size: 1.8rem; color: var(--primary);
        }
        .role-card h5 { color: var(--primary-dark); font-weight: 600; }

        .contact-card {
            background: var(--soft); border-radius: 18px; padding: 24px;
            display: flex; align-items: flex-start; gap: 16px; height: 100%;
        }
        .contact-card .icon-circle {
            min-width: 50px; height: 50px; background: var(--primary); color: #fff;
            border-radius: 12px; display: flex; align-items: center;
            justify-content: center; font-size: 1.3rem;
        }
        .contact-card h6 { font-weight: 600; color: var(--primary-dark); margin-bottom: 4px; }
        .contact-card p { margin: 0; color: #666; font-size: .9rem; }

        footer { background: var(--primary-dark); color: #d8e8dd; padding: 50px 0 20px; margin-top: 40px; }
        footer h5 { color: #fff; font-weight: 600; margin-bottom: 16px; }
        footer a { color: #d8e8dd; text-decoration: none; }
        footer a:hover { color: var(--accent); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px; margin-top: 30px; text-align: center; font-size: .85rem;
        }

        .modal-content { border-radius: 18px; border: none; }
        .modal-header { background: var(--primary); color: #fff; border-radius: 18px 18px 0 0; }
        .modal-header .btn-close { filter: invert(1); }

        @media (max-width: 768px) {
            .hero { padding: 110px 0 60px; text-align: center; }
            .hero h1 { font-size: 2rem; }
            section { padding: 60px 0; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#beranda"><i class="bi bi-flower1"></i> Es Duren Oya</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#visimisi">Visi & Misi</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#peran">Peran Usaha</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                @auth
                    <li class="nav-item ms-lg-3">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-custom btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-custom btn-sm">
                            <i class="bi bi-person-lock"></i> Login Owner
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5><i class="bi bi-flower1"></i> Es Duren Oya</h5>
                <p>Usaha kuliner olahan durian dengan cita rasa autentik dan bahan berkualitas, berlokasi di Cimahi Selatan.</p>
            </div>
            <div class="col-md-4">
                <h5>Alamat</h5>
                <p><i class="bi bi-geo-alt-fill"></i> Jl. Sadarmanah No. 30, Leuwigajah,<br>
                   Kec. Cimahi Selatan, Kota Cimahi,<br>Jawa Barat 40532</p>
            </div>
            <div class="col-md-4">
                <h5>Kontak</h5>
                <p><i class="bi bi-whatsapp"></i> <a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a></p>
                <p><i class="bi bi-instagram"></i> <a href="#">@esdurenoya</a></p>
                <p><i class="bi bi-envelope-fill"></i> <a href="mailto:info@esdurenoya.com">info@esdurenoya.com</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Es Duren Oya. All rights reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.navbar-nav a.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const nav = document.getElementById('navbarNav');
            if (nav.classList.contains('show')) new bootstrap.Collapse(nav).hide();
        });
    });
</script>
</body>
</html>