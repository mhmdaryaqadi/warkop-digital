<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus')->with('success', 'Menu baru berhasil ditambah!');
    }

    // Menampilkan halaman edit
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.edit', compact('menu'));
    }

    // Memproses perubahan data
    public function update(Request $request, $id)
    {
        // 1. Ambil data menu yang mau di-edit
        $menu = Menu::findOrFail($id);

        // 2. Validasi input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // 3. Ambil semua input teks dulu
        $input = $request->all();

        // 4. CEK: Apakah ada file gambar yang diupload?
        if ($request->hasFile('image')) {
            // Hapus foto lama kalau ada biar gak menuhin storage
            if ($menu->image && file_exists(storage_path('app/public/' . $menu->image))) {
                unlink(storage_path('app/public/' . $menu->image));
            }

            // Simpan foto baru ke folder 'menus' di dalam storage/app/public
            $path = $request->file('image')->store('menus', 'public');
            
            // Masukkan path gambar ke dalam array input yang akan diupdate
            $input['image'] = $path;
        } else {
            // Kalau gak upload gambar baru, tetap pakai gambar yang lama
            $input['image'] = $menu->image;
        }

        // 5. Eksekusi Update ke Database
        $menu->update($input);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil diupdate!');
    }

    // Menghapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus!');
    }
}