<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        // Kalau barang sudah ada di keranjang, tambah jumlahnya
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Kalau belum ada, masukkan data baru
            $cart[$id] = [
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $menu->price,
                "category" => $menu->category
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambah!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        return redirect()->back()->with('success', 'Item berhasil dihapus!');
        }
    }

    public function update(Request $request)
    {
        if($request->id && isset($request->quantity)) {
            $cart = session()->get('cart');

            // Kalau user ganti angka jadi 0 atau kurang, hapus aja dari keranjang
            if($request->quantity <= 0) {
                unset($cart[$request->id]);
                $msg = "Item dihapus!";
            } else {
                $cart[$request->id]["quantity"] = $request->quantity;
                $msg = "Jumlah pesanan diperbarui!";
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', $msg);
        }
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // 1. Susun Format Pesanan
        $pesan = "Halo Warkop Digital! Saya mau pesan:\n\n";
        $total = 0;

        foreach($cart as $details) {
            $subtotal = $details['price'] * $details['quantity'];
            $pesan .= "• " . $details['name'] . " (" . $details['quantity'] . "x) = Rp" . number_format($subtotal, 0, ',', '.') . "\n";
            $total += $subtotal;
        }

        $pesan .= "\n*Total Bayar: Rp" . number_format($total, 0, ',', '.') . "*\n";
        $pesan .= "--------------------------\n";
        $pesan .= "Mohon segera diproses ya! ☕";

        // 2. Kosongkan keranjang setelah checkout (opsional, tapi disarankan)
        session()->forget('cart');

        // 3. Arahkan ke WhatsApp
        // Ganti nomor di bawah dengan nomor WA kamu (format: 628xxx)
        $nomorWA = "6281234567890"; 
        $url = "https://wa.me/" . $nomorWA . "?text=" . urlencode($pesan);

        return redirect()->away($url);
    }
}