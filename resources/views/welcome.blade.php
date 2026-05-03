<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-50 font-sans text-gray-900 antialiased">
    
    <!-- CONTAINER UTAMA -->
    <div class="max-w-5xl mx-auto bg-white min-h-screen pb-24 shadow-sm relative">
        
        <!-- 1. BANNER TOKO -->
        <div class="w-full h-48 bg-slate-800 relative overflow-hidden">
            <!-- Bisa diganti link foto banner warkop kamu nanti -->
            <div class="absolute inset-0 opacity-40 bg-[url('https://images.unsplash.com/photo-1554118811-1e0d58224f24')] bg-cover bg-center"></div>
        </div>

        <!-- 2. PROFIL TOKO -->
        <div class="px-6 relative pb-4 border-b border-gray-200">
            <div class="flex justify-between items-end -mt-12 mb-4">
                <div class="flex items-end gap-4">
                    <!-- Logo Kotak -->
                    <div class="w-24 h-24 bg-white rounded-2xl p-1.5 shadow-md relative z-10 border border-gray-100">
                        <div class="w-full h-full bg-blue-50 rounded-xl flex items-center justify-center text-center font-black text-blue-600 text-[11px] leading-tight border border-blue-100">
                            WARKOP<br>DIGITAL
                        </div>
                    </div>
                    <!-- Nama Toko -->
                    <div class="mb-2">
                        <h1 class="text-xl md:text-2xl font-bold flex items-center gap-2">
                            Warkop Rawageni 
                            <span class="bg-green-50 text-green-600 text-[10px] px-2 py-0.5 rounded flex items-center gap-1 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Open
                            </span>
                        </h1>
                    </div>
                </div>
            </div>

            <!-- 3. NAVIGASI KATEGORI & SEARCH -->
            <div class="flex items-center gap-4 mt-6 overflow-x-auto pb-1 scrollbar-hide">
                <!-- Icon Search & Menu -->
                <div class="flex gap-2 flex-shrink-0">
                    <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-50 text-gray-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                    <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-50 text-gray-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
                
                <!-- Deretan Kategori -->
                <div class="flex gap-6 font-bold text-xs uppercase tracking-wide whitespace-nowrap pt-1">
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-2">SEMUA</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 pb-2">MIE</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 pb-2">KOPI</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 pb-2">CEMILAN</a>
                </div>
            </div>
        </div>

        <!-- 4. DAFTAR MENU -->
        <div class="px-6 py-6">
            <h2 class="text-sm font-bold mb-6 text-gray-900">SEMUA MENU</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                @foreach($menus as $item)
                <div class="flex justify-between items-start group">
                    
                    <!-- Kiri: Teks Nama & Harga -->
                    <div class="pr-4 flex-1">
                        <h3 class="text-sm font-medium text-gray-900 mb-1 leading-snug">{{ $item->name }}</h3>
                        <p class="text-[13px] font-medium text-gray-700">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Kanan: Gambar & Tombol Plus -->
                    <div class="relative w-[100px] h-[100px] flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-2xl">🍽️</div>
                        @endif

                        <!-- Tombol Tambah (+) Melayang di pojok kanan bawah -->
                        <form action="{{ route('cart.add', $item->id) }}" method="POST" class="absolute bottom-0 right-0">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white w-8 h-8 flex items-center justify-center rounded-tl-xl hover:bg-blue-700 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
        
        <!-- 5. FLOATING CART (Muncul kalau ada barang) -->
        @if(session('cart') && count(session('cart')) > 0)
            @php 
                $total_qty = 0;
                $total_price = 0;
                foreach(session('cart') as $details) {
                    $total_qty += $details['quantity'];
                    $total_price += $details['price'] * $details['quantity'];
                }
            @endphp
            <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 z-50">
                <div class="max-w-5xl mx-auto flex justify-end">
                    <a href="{{ route('cart.index') }}" class="w-full md:w-80 bg-blue-600 text-white rounded-xl py-3 px-5 flex items-center justify-between shadow-lg hover:bg-blue-700 transition-colors">
                        <div class="flex flex-col">
                            <span class="font-bold text-sm">{{ $total_qty }} Items</span>
                            <span class="text-[10px] text-blue-200 uppercase tracking-wide">Lihat Keranjang</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-base">Rp {{ number_format($total_price, 0, ',', '.') }}</span>
                        </div>
                    </a>
                </div>
            </div>
        @endif

    </div>
</body>
</html>