<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function adminIndex()
    {
        $menus = Menu::orderBy('id', 'asc')->get();
        return view('admin.menus', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'stok' => 'required|integer|min:0', // <-- Validasi stok
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('menu', 'public');
        }

        Menu::create($data);

        return redirect()->back()->with('success', 'Menu baru berhasil ditambahkan.');
    }

    // METHOD INI YANG PALING PENTING
    public function updateStok(Request $request, Menu $menu)
    {
        $request->validate([
            'stok' => 'required|integer|min:0'
        ]);
        
        // Paksa update ke database
        $menu->stok = $request->stok;
        $menu->is_sold_out = $request->stok <= 0; // Otomatis habis jika 0
        $menu->save();

        return redirect()->back()->with('success', 'Stok berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }
}