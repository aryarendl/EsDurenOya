<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class HomeController extends Controller
{
    /**
     * Halaman utama — data menu diambil dari database
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        
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