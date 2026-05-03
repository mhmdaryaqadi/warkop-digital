<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query
        $query = Menu::query();

        // Filter berdasarkan Kategori jika ada di URL
        if ($request->has('category') && $request->category != null) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan Search jika ada
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $query->get();

        return view('welcome', compact('menus'));
    }
}