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
                        <th class="p-4">Nama Menu</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $m)
                    <tr class="border-b hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <!-- Preview Gambar -->
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-200 flex-shrink-0">
                                @if($m->image)
                                    <img src="{{ asset('storage/' . $m->image) }}" 
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-slate-400 font-bold uppercase">
                                        No Pic
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Nama Menu -->
                            <span class="font-bold text-slate-700">{{ $m->name }}</span>
                        </td>
                        <td class="p-4 text-slate-500">{{ $m->category }}</td>
                        <td class="p-4 font-black text-slate-900">Rp{{ number_format($m->price, 0, ',', '.') }}</td>
                        <td class="p-4 flex gap-3">
                            <a href="{{ route('admin.edit', $m->id) }}" class="text-blue-600 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus, Ar?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>