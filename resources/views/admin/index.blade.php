<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Warkop Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 p-10">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Manajemen Menu Warkop</h1>
            <a href="{{ route('admin.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold">+ Tambah Menu</a>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="p-4">Menu</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $m)
                    <tr class="border-b hover:bg-slate-50 transition">
                        <!-- Kolom 1: Gambar & Nama Menu Digabung (Versi Jurus Paksa) -->
                        <td class="p-4 flex items-center gap-4">
                            @if($m->image)
                                <!-- Kotak gambar dipaksa 64x64px -->
                                <div style="width: 64px; height: 64px; flex-shrink: 0; overflow: hidden; border-radius: 8px; border: 2px solid #e2e8f0; background-color: #f8fafc; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('storage/' . $m->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                <!-- Kotak no-pic dipaksa 64x64px -->
                                <div style="width: 64px; height: 64px; flex-shrink: 0; border-radius: 8px; border: 2px dashed #cbd5e1; background-color: #f8fafc; display: flex; align-items: center; justify-content: center;">
                                    <span style="font-size: 10px; font-weight: bold; color: #94a3b8;">NO PIC</span>
                                </div>
                            @endif
                            
                            <!-- Nama Menu -->
                            <span class="font-bold text-slate-700 text-lg">{{ $m->name }}</span>
                        </td>
                        
                        <td class="p-4 text-slate-500">{{ $m->category }}</td>
                        <td class="p-4 font-black text-slate-900">Rp{{ number_format($m->price, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.edit', $m->id) }}" class="text-blue-600 hover:underline font-bold">Edit</a>
                                <form action="{{ route('admin.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus, Ar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-bold">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>