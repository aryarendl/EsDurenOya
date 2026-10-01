@extends('layouts.app')

@section('title', 'Login Owner - Es Duren Oya')

@section('content')
<section style="padding: 140px 0 80px; background: var(--soft); min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <div class="text-center mb-4">
                    <div style="font-size: 3rem; color: var(--primary);">
                        <i class="bi bi-person-lock"></i>
                    </div>
                    <h3 class="mt-2" style="color: var(--primary-dark); font-weight: 700;">Login Owner</h3>
                    <p class="text-muted">Masuk untuk mengelola menu Es Duren Oya</p>
                </div>

                <div class="bg-white p-4 p-md-5" style="border-radius: 18px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-envelope-fill" style="color: var(--primary);"></i>
                                </span>
                                <input type="email" name="email" class="form-control"
                                       placeholder="owner@esdurenoya.com"
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-lock-fill" style="color: var(--primary);"></i>
                                </span>
                                <input type="password" name="password" class="form-control"
                                       placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 mt-2">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </button>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary);">
                                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection


// owner@esdurenoya.com = owner123 
