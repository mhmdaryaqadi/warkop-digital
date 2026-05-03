<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAFAFA] text-black font-sans selection:bg-yellow-200">

    <!-- NAVBAR BERSIIH & TEGAS -->
    <nav class="border-b-2 border-black bg-white p-4 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black uppercase tracking-tight">
                ☕ Warkop<span class="text-yellow-500">Digital</span>
            </h1>
            <a href="{{ route('cart.index') }}" class="bg-white border-2 border-black px-5 py-2 font-black text-sm uppercase shadow-[4px_4px_0_0_#000] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                🛒 Pesanan ({{ session('cart') ? count(session('cart')) : 0 }})
            </a>
        </div>
    </nav>

    <!-- HEADER SIMPEL -->
    <header class="py-16 px-6 text-center max-w-3xl mx-auto">
        <h2 class="text-4xl md:text-5xl font-black uppercase mb-4">
            Pesan dari Meja,<br>Biar Kami yang Kerja.
        </h2>
        
        <!-- SEARCH BAR -->
        <form action="/" method="GET" class="mt-8 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu warkop..." 
                   class="w-full border-2 border-black bg-white px-4 py-3 font-bold outline-none focus:bg-yellow-50 shadow-[4px_4px_0_0_#000]">
            <button type="submit" class="bg-yellow-400 border-2 border-black px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                CARI
            </button>
        </form>
    </header>

    <!-- MENU LIST (LIST MENYAMPING BUKAN KOTAK RAKSASA) -->
    <main class="max-w-5xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($menus as $item)
            <div class="bg-white border-2 border-black p-4 flex gap-4 shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
                
                <!-- KOTAK GAMBAR JURUS PAKSA -->
                <div style="width: 120px; height: 120px; flex-shrink: 0; overflow: hidden; border: 2px solid black; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                    @if($item->image)
                        <!-- Gambar dipaksa penuh mengikuti ukuran 120x120px dan dipotong rapi (cover) -->
                        <img src="{{ asset('storage/' . $item->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="font-size: 1.5rem; font-weight: 900; color: #cbd5e1;">NO PIC</span>
                    @endif
                </div>
                
                <!-- INFO MENU -->
                <div class="flex flex-col justify-between flex-1">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h4 class="text-lg font-black uppercase leading-tight">{{ $item->name }}</h4>
                            <span class="bg-yellow-400 border-2 border-black px-2 py-0.5 text-[10px] font-black uppercase">{{ $item->category }}</span>
                        </div>
                        <p class="text-xs font-bold text-slate-500 line-clamp-2">{{ $item->description }}</p>
                    </div>
                    
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-lg font-black">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button class="bg-white border-2 border-black w-8 h-8 flex items-center justify-center font-black shadow-[2px_2px_0_0_#000] hover:bg-yellow-400 hover:translate-y-0.5 hover:translate-x-0.5 hover:shadow-none transition-all">
                                +
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>