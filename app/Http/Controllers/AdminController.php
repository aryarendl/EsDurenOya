<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel settings
        $settings = Setting::all()->pluck('value', 'key');
        
        // Mengarah ke file view resources/views/admin/settings.blade.php
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        // Mengambil semua input dari form kecuali token CSRF
        $data = $request->except('_token');
        
        // Melakukan perulangan untuk update data ke database
        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}

