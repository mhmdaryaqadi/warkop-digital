<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Digital - Ar</title>
    <!-- Ini bagian paling penting: Memanggil Vite untuk Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans">

    <!-- Navbar Minimalis -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black text-orange-600 tracking-tight">
                ☕ WARKOP<span class="text-slate-800">DIGITAL</span>
            </h1>
            <div class="hidden md:flex space-x-8 text-slate-600 font-semibold">
                <a href="#" class="hover:text-orange-500 transition">Menu</a>
                <a href="#" class="hover:text-orange-500 transition">Promo</a>
                <a href="#" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition">Pesanan Saya</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-slate-900 py-20 text-center overflow-hidden">
        <div class="relative z-10 max-w-3xl mx-auto px-6">
            <h2 class="text-5xl font-extrabold text-white mb-4 leading-tight">
                Ngopi di Rawageni, <br> <span class="text-orange-500">Pesan dari Hati.</span>
            </h2>
            <p class="text-slate-400 text-lg mb-8">Nikmati sensasi warkop legendaris dengan kemudahan digital. Tanpa antri, tinggal klik, pesanan sampai di meja.</p>
        </div>
        <!-- Hiasan Background -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    </header>

    <!-- Daftar Menu -->
    <main class="max-w-6xl mx-auto px-6 py-16">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-3xl font-bold text-slate-800">Menu Andalan</h3>
                <div class="h-1.5 w-20 bg-orange-500 mt-2 rounded-full"></div>
            </div>
        </div>
        
        <!-- Bar Pencarian & Filter -->
        <div class="mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
            <form action="/" method="GET" class="w-full md:w-1/2 flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari kopi favoritmu..." 
                    class="w-full px-5 py-3 rounded-2xl border border-slate-200 outline-none focus:ring-2 focus:ring-orange-500 shadow-sm transition">
                <button type="submit" class="bg-orange-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-orange-700 transition">
                    Cari
                </button>
            </form>

            <div class="flex gap-2 overflow-x-auto pb-2 w-full md:w-auto">
                <a href="/" class="px-5 py-2 rounded-full border {{ request('category') == '' ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-600 border-slate-200' }} font-bold text-sm whitespace-nowrap transition">
                    Semua
                </a>
                @foreach(['Minuman', 'Makanan', 'Snack'] as $cat)
                    <a href="/?category={{ $cat }}" 
                    class="px-5 py-2 rounded-full border {{ request('category') == $cat ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-600 border-slate-200' }} font-bold text-sm whitespace-nowrap transition">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Grid Kartu Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($menus as $item)
            <div class="group bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <!-- Area Gambar (Placeholder) -->
                <div class="h-56 bg-slate-200 relative flex items-center justify-center overflow-hidden">
                    @if($item->image)
                        <!-- Jika ada foto, tampilkan dari storage -->
                        <img src="{{ asset('storage/' . $item->image) }}" 
                            alt="{{ $item->name }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <!-- Jika tidak ada foto, tampilkan teks placeholder -->
                        <span class="text-slate-400 font-bold italic group-hover:scale-110 transition-transform">
                            📸 Foto {{ $item->name }}
                        </span>
                    @endif

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md text-slate-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                            {{ $item->category }}
                        </span>
                    </div>
                </div>
                
                <!-- Detail Menu -->
                <div class="p-8">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-xl font-bold text-slate-800 group-hover:text-orange-600 transition-colors">
                            {{ $item->name }}
                        </h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2">
                        {{ $item->description }}
                    </p>
                    
                    <div class="flex items-center justify-between mt-auto">
                        <div>
                            <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Harga</p>
                            <p class="text-2xl font-black text-slate-900">
                                <span class="text-sm font-bold">Rp</span>{{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button class="bg-slate-900 text-white p-4 rounded-2xl hover:bg-orange-600 transition-all shadow-lg active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-12 text-center">
        <p class="text-slate-400 text-sm font-medium italic">
            Built with Passion by <span class="text-slate-800 font-bold">Arya Alqadi</span> &bull; 2026
        </p>
    </footer>

</body>
</html>