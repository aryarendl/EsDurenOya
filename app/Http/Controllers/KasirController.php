<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        // Hanya tampilkan menu yang tidak sold out
        $menus = Menu::where('is_sold_out', false)->get();
        return view('kasir.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'total_harga' => 'required|integer',
            'nominal_bayar' => 'required|integer|min:' . $request->total_harga,
            'metode_pembayaran' => 'required|in:cash,qris',
        ]);

        try {
            DB::beginTransaction();

            // Simpan data Order (Induk)
            $order = Order::create([
                'total_harga' => $request->total_harga,
                'nominal_bayar' => $request->nominal_bayar,
                'kembalian' => $request->nominal_bayar - $request->total_harga,
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);

            // Simpan data Order Items (Anak)
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['id'],
                    'nama_menu' => $item['nama'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['harga'] * $item['jumlah'],
                ]);

                // --- LOGIKA PENGURANGAN STOK ---
                $menu = Menu::find($item['id']);
                if ($menu) {
                    $menu->decrement('stok', $item['jumlah']);
                    
                    // Jika stok habis, otomatis jadikan Sold Out
                    if ($menu->stok <= 0) {
                        $menu->update(['is_sold_out' => true]);
                    }
                }
                // -------------------------------
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Transaksi berhasil!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function laporan(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        
        $orders = Order::with('items')
            ->whereDate('created_at', $tanggal)
            ->orderBy('created_at', 'desc')
            ->get();

        $total_pendapatan = $orders->sum('total_harga');
        $total_cash = $orders->where('metode_pembayaran', 'cash')->sum('total_harga');
        $total_qris = $orders->where('metode_pembayaran', 'qris')->sum('total_harga');
        
        $menu_terlaris = OrderItem::whereHas('order', function($q) use ($tanggal) {
            $q->whereDate('created_at', $tanggal);
        })->select('nama_menu', DB::raw('SUM(jumlah) as total_terjual'))
          ->groupBy('nama_menu')
          ->orderByDesc('total_terjual')
          ->take(5)
          ->get();

        return view('kasir.laporan', compact('orders', 'tanggal', 'total_pendapatan', 'total_cash', 'total_qris', 'menu_terlaris'));
    }

    public function toggleSoldOut(Menu $menu)
    {
        $menu->update(['is_sold_out' => !$menu->is_sold_out]);
        return response()->json(['success' => true, 'status' => $menu->is_sold_out]);
    }
}