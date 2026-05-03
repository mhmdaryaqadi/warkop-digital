<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Digital - Comic Edition</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FFDE00] font-sans text-black antialiased pb-24">

    <!-- CONTAINER UTAMA -->
    <div class="max-w-2xl mx-auto bg-white min-h-screen border-x-4 border-black relative shadow-[20px_0px_0px_0px_rgba(0,0,0,1)]">
        
        <!-- HEADER & SEARCH -->
        <header class="p-6 border-b-4 border-black bg-white sticky top-0 z-40">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-4xl font-black italic uppercase tracking-tighter">
                        Warkop<span class="text-red-600">.</span>Digital
                    </h1>
                    <p class="text-[10px] font-bold tracking-widest uppercase">Rawageni Tech Hub // Depok</p>
                </div>
                <!-- Status Open -->
                <div class="bg-lime-400 border-2 border-black px-2 py-1 text-[10px] font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    OPEN
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <!-- SEARCH BAR -->
                <form action="/" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="CARI MENU..." 
                           class="w-full bg-white border-4 border-black p-3 font-black placeholder-gray-400 focus:outline-none focus:bg-cyan-300 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                </form>

                <!-- KATEGORI (HORIZONTAL SCROLL) -->
                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide pt-2">
                    <!-- Tombol Semua -->
                    <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" 
                    class="{{ !request('category') ? 'bg-black text-white' : 'bg-white text-black' }} border-2 border-black px-4 py-1 text-xs font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] whitespace-nowrap transition-all">
                    SEMUA
                    </a>

                    <!-- Tombol Makanan -->
                    <a href="{{ request()->fullUrlWithQuery(['category' => 'makanan']) }}" 
                    class="{{ request('category') == 'makanan' ? 'bg-black text-white' : 'bg-white text-black' }} border-2 border-black px-4 py-1 text-xs font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] whitespace-nowrap hover:bg-cyan-300 transition-all">
                    MAKANAN
                    </a>

                    <!-- Tombol Minuman -->
                    <a href="{{ request()->fullUrlWithQuery(['category' => 'minuman']) }}" 
                    class="{{ request('category') == 'minuman' ? 'bg-black text-white' : 'bg-white text-black' }} border-2 border-black px-4 py-1 text-xs font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] whitespace-nowrap hover:bg-cyan-300 transition-all">
                    MINUMAN
                    </a>

                    <!-- Tombol Cemilan -->
                    <a href="{{ request()->fullUrlWithQuery(['category' => 'cemilan']) }}" 
                    class="{{ request('category') == 'cemilan' ? 'bg-black text-white' : 'bg-white text-black' }} border-2 border-black px-4 py-1 text-xs font-black uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] whitespace-nowrap hover:bg-cyan-300 transition-all">
                    CEMILAN
                    </a>
                </div>
            </div>
        </header>

        <!-- DAFTAR MENU -->
        <main class="p-6">
            @if(session('success'))
                <div class="mb-6 bg-lime-300 border-4 border-black p-3 font-black text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col gap-8">
                @foreach($menus as $item)
                <div class="flex justify-between items-center gap-4 group">
                    <!-- INFO KIRI -->
                    <div class="flex-1">
                        <span class="text-[10px] font-black uppercase text-red-600 tracking-tighter">{{ $item->category }}</span>
                        <h3 class="text-xl font-black uppercase italic leading-none mb-1">{{ $item->name }}</h3>
                        <p class="text-xs font-bold text-gray-600 line-clamp-2 mb-2">{{ $item->description }}</p>
                        <p class="text-lg font-black tracking-tight italic">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- GAMBAR KANAN -->
                    <div class="relative w-24 h-24 flex-shrink-0 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-gray-200 overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black opacity-20 italic">NO PIC</div>
                        @endif

                        <!-- Tombol Tambah (+) -->
                        <form action="{{ route('cart.add', $item->id) }}" method="POST" class="absolute bottom-0 right-0">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white w-8 h-8 flex items-center justify-center border-t-4 border-l-4 border-black hover:bg-black transition-colors">
                                <span class="font-black text-xl">+</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </main>

        <!-- FLOATING CART (STICKY BOTTOM) -->
        @if(session('cart') && count(session('cart')) > 0)
            @php 
                $total_qty = 0;
                $total_price = 0;
                foreach(session('cart') as $details) {
                    $total_qty += $details['quantity'];
                    $total_price += $details['price'] * $details['quantity'];
                }
            @endphp
            <div class="fixed bottom-6 left-1/2 -translate-x-1/2 w-full max-w-lg px-6 z-50">
                <a href="{{ route('cart.index') }}" class="flex items-center justify-between bg-cyan-400 border-4 border-black p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                    <div class="flex flex-col">
                        <span class="font-black text-xs uppercase">{{ $total_qty }} PESANAN</span>
                        <span class="font-bold text-[10px] tracking-widest uppercase opacity-70">Warkop Digital</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xl font-black italic">Rp{{ number_format($total_price, 0, ',', '.') }}</span>
                        <span class="text-2xl font-black">➔</span>
                    </div>
                </a>
            </div>
        @endif

    </div>

</body>
</html>