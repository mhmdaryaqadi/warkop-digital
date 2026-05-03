<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kita isi menu standar warkop lagi di sini
        Menu::create([
            'name' => 'Kopi Hitam',
            'price' => 5000,
            'category' => 'Minuman',
            'description' => 'Kopi robusta pilihan, pahitnya pas kayak janji mantan.',
            'image' => null
        ]);

        Menu::create([
            'name' => 'Indomie Goreng',
            'price' => 10000,
            'category' => 'Makanan',
            'description' => 'Pake telor setengah mateng, mantap pol.',
            'image' => null
        ]);

        Menu::create([
            'name' => 'Es Teh Manis',
            'price' => 4000,
            'category' => 'Minuman',
            'description' => 'Seger banget buat nemenin nugas.',
            'image' => null
        ]);
    }
}