<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total_harga', 'nominal_bayar', 'kembalian', 'metode_pembayaran'];

    // Relasi ke detail barang yang dibeli
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
