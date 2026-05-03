<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 py-12 px-6">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-black text-slate-800 mb-8">EDIT <span class="text-orange-600">MENU</span></h2>

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100">
            <form action="{{ route('admin.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- WAJIB untuk update data -->
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Menu</label>
                        <input type="text" name="name" value="{{ $menu->name }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                            <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200">
                                <option value="Minuman" {{ $menu->category == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Makanan" {{ $menu->category == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Snack" {{ $menu->category == 'Snack' ? 'selected' : '' }}>Snack</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ $menu->price }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="3" required class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-orange-500">{{ $menu->description }}</textarea>
                    </div>

                    <!-- Input Foto Baru -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Ganti Foto (Opsional)</label>
                        
                        @if($menu->image)
                            <div class="mb-3">
                                <p class="text-xs text-slate-400 mb-1">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $menu->image) }}" class="w-32 h-32 object-cover rounded-xl border">
                            </div>
                        @endif

                        <input type="file" name="image" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none">
                        <p class="text-xs text-slate-400 mt-1">*Format: JPG, PNG, JPEG (Max 2MB)</p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-orange-600 text-white font-black py-4 rounded-2xl hover:bg-orange-700 transition-all">SIMPAN PERUBAHAN</button>
                        <a href="{{ route('admin.menus') }}" class="px-8 py-4 bg-slate-200 text-slate-700 font-bold rounded-2xl hover:bg-slate-300 flex items-center">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>