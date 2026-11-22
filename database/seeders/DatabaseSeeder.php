<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Gunakan firstOrCreate agar tidak error jika akun sudah ada
        User::firstOrCreate(
            ['email' => 'owner@esdurenoya.com'], 
            [
                'name' => 'Owner Es Duren Oya',
                'password' => Hash::make('owner123'),
            ]
        );

        // 2. Panggil MenuSeeder
        $this->call([
            MenuSeeder::class,
        ]);

        // 3. Data default website (Gunakan updateOrCreate agar aman dijalankan berulang kali)
        $settings = [
            ['key' => 'hero_title', 'value' => 'Es Duren Oya'],
            ['key' => 'hero_desc', 'value' => 'Nikmati sensasi olahan durian segar dengan cita rasa autentik dan bahan pilihan. Es Duren Oya hadir untuk memanjakan lidah Anda dengan berbagai varian menu durian yang lezat.'],
            ['key' => 'visi', 'value' => 'Menjadi usaha kuliner olahan durian yang terpercaya dan digemari masyarakat, dengan menyajikan produk berkualitas, higienis, dan bercita rasa khas.'],
            ['key' => 'misi', 'value' => "Menyajikan olahan durian dengan bahan segar dan berkualitas.\nMemberikan pelayanan yang ramah dan cepat kepada pelanggan.\nMenjaga kebersihan dan higienitas produk.\nMengembangkan varian menu yang inovatif dan sesuai selera pelanggan.\nMenjalin hubungan baik dengan pelanggan dan masyarakat sekitar."],
            ['key' => 'tentang', 'value' => "Es Duren Oya merupakan usaha yang bergerak di bidang kuliner, khususnya makanan dan minuman berbahan dasar durian. Berlokasi di Jl. Sadarmanah No. 30, Leuwigajah, Kecamatan Cimahi Selatan, Kota Cimahi, Jawa Barat.\n\nUsaha ini hadir dengan tujuan memberikan produk olahan durian yang lezat, segar, dan terjangkau bagi masyarakat. Kami berkomitmen untuk menggunakan bahan-bahan pilihan serta menjaga kualitas rasa di setiap penyajian."],
            ['key' => 'peran_owner', 'value' => 'Bertanggung jawab mengelola usaha secara keseluruhan, serta membeli dan menyediakan bahan-bahan yang diperlukan untuk kegiatan produksi.'],
            ['key' => 'peran_server', 'value' => 'Bertugas melayani pelanggan, menerima pembayaran, dan membuat produk sesuai pesanan pelanggan dengan cepat dan ramah.'],
            ['key' => 'kontak_wa', 'value' => '6281234567890'],
            ['key' => 'kontak_ig', 'value' => '@esdurenoya'],
            ['key' => 'kontak_email', 'value' => 'info@esdurenoya.com'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']], 
                ['value' => $setting['value']]
            );
        }
    }
}