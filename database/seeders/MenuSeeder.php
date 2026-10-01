<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'nama' => 'Es Duren Original',
                'deskripsi' => 'Es durian klasik dengan daging durian asli pilihan.',
                'harga' => 15000,
                'foto' => null,
            ],
            [
                'nama' => 'Es Duren Keju',
                'deskripsi' => 'Es durian dengan topping keju melimpah.',
                'harga' => 20000,
                'foto' => null,
            ],
            [
                'nama' => 'Es Duren Coklat',
                'deskripsi' => 'Es durian dengan saus coklat premium.',
                'harga' => 18000,
                'foto' => null,
            ],
            [
                'nama' => 'Es Duren Mix Topping',
                'deskripsi' => 'Es durian dengan aneka topping (keju, coklat, kacang).',
                'harga' => 25000,
                'foto' => null,
            ],
            [
                'nama' => 'Pancake Durian',
                'deskripsi' => 'Pancake lembut dengan isian durian asli.',
                'harga' => 22000,
                'foto' => null,
            ],
            [
                'nama' => 'Durian Segar (per porsi)',
                'deskripsi' => 'Daging durian segar tanpa campuran.',
                'harga' => 30000,
                'foto' => null,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}