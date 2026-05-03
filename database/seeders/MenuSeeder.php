<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'name' => 'Kopi Hitam Tubruk',
            'description' => 'Kopi hitam mantap kental kafein tinggi.',
            'price' => 5000,
            'category' => 'Minuman',
            'is_available' => true,
        ]);

        Menu::create([
            'name' => 'Indomie Goreng Telur',
            'description' => 'Indomie goreng legendaris pake telur mata sapi.',
            'price' => 12000,
            'category' => 'Makanan',
            'is_available' => true,
        ]);

        Menu::create([
            'name' => 'Gorengan Bakwan',
            'description' => 'Bakwan sayur renyah isi 3.',
            'price' => 5000,
            'category' => 'Snack',
            'is_available' => true,
        ]);
    }
}