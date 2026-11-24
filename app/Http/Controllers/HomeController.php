<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Halaman utama — data menu diambil dari database
     */
    public function index()
    {
        // Cek apakah user yang login adalah Owner
        $isOwner = Auth::check() && Auth::user()->email === 'owner@esdurenoya.com';

        if ($isOwner) {
            // Jika Owner: Tampilkan SEMUA menu (termasuk yang habis) agar bisa dikelola
            $menus = Menu::orderBy('created_at', 'desc')->get();
        } else {
            // Jika Pelanggan/Guest: Hanya tampilkan menu yang TERSEDIA (is_sold_out = 0)
            $menus = Menu::where('is_sold_out', false)
                         ->orderBy('created_at', 'desc')
                         ->get();
        }
        
        // Ambil semua setting dari database
        $settings = Setting::all()->pluck('value', 'key');

        return view('home', compact('menus', 'settings'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Berhasil login sebagai owner.');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}