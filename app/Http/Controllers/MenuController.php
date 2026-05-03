<?php

namespace App\Http\Controllers;

use App\Models\Menu; // Jangan lupa baris ini untuk panggil model Menu
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel menus
        $menus = Menu::all(); 
        
        // Kirim data ke file tampilan bernama 'welcome'
        return view('welcome', compact('menus'));
    }
}