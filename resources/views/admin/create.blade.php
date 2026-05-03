<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu Baru - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 py-12 px-6">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-3xl font-black text-slate-800">TAMBAH <span class="text-orange-600">MENU</span></h2>
            <a href="{{ route('admin.menus') }}" class="text-slate-500 hover:text-slate-800 font-bold transition">← Batal</a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100">
            <!-- Form mengarah ke route admin.store -->
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Nama Menu -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Nama Menu</label>
                        <input type="text" name="name" required placeholder="Contoh: Kopi Susu Aren"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition">
                    </div>

                    <!-- Kategori & Harga -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Kategori</label>
                            <select name="category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition">
                                <option value="Minuman">Minuman</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Harga (Rp)</label>
                            <input type="number" name="price" required placeholder="15000"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" required placeholder="Jelaskan rasa atau keunikan menu ini..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-orange-600 text-white font-black py-4 rounded-2xl hover:bg-orange-700 hover:shadow-lg hover:shadow-orange-200 transition-all active:scale-[0.98]">
                        SIMPAN MENU BARU
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>