<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Warkop Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAFAFA] text-black font-sans selection:bg-yellow-200">

    <nav class="border-b-2 border-black bg-white p-4 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black uppercase tracking-tight">Checkout.</h1>
            <a href="/" class="text-sm font-bold border-2 border-black px-4 py-1 hover:bg-yellow-400 transition-colors shadow-[2px_2px_0_0_#000]">
                ← KEMBALI
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        @if(session('cart') && count(session('cart')) > 0)
            <div class="bg-white border-2 border-black shadow-[8px_8px_0_0_#000] p-6 md:p-10">
                
                <h2 class="text-2xl font-black uppercase mb-6 border-b-4 border-yellow-400 inline-block">Pesanan Kamu</h2>

                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    
                    <div class="flex flex-col md:flex-row items-center justify-between border-b-2 border-dashed border-slate-300 py-4 gap-4">
                        <div class="flex-1 text-center md:text-left">
                            <p class="font-black text-lg uppercase">{{ $details['name'] }}</p>
                            <p class="font-bold text-slate-500 text-sm">Rp{{ number_format($details['price'], 0, ',', '.') }}</p>
                        </div>
                        
                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                            @csrf @method('PATCH')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" onchange="this.form.submit()" 
                                   class="w-16 border-2 border-black p-2 font-black text-center outline-none focus:bg-yellow-100 shadow-[2px_2px_0_0_#000]">
                        </form>

                        <p class="font-black text-xl w-32 text-center md:text-right">Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                        
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf @method('DELETE')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="bg-white text-red-500 border-2 border-black px-3 py-1 font-black shadow-[2px_2px_0_0_#000] hover:bg-red-500 hover:text-white transition-colors">
                                X
                            </button>
                        </form>
                    </div>
                @endforeach

                <!-- TOTAL BAYAR -->
                <div class="mt-8 bg-yellow-400 border-2 border-black p-6 flex flex-col md:flex-row justify-between items-center gap-6 shadow-[4px_4px_0_0_#000]">
                    <div class="text-center md:text-left">
                        <p class="font-bold uppercase text-sm mb-1">Total Pembayaran:</p>
                        <p class="text-3xl font-black">Rp{{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('cart.checkout') }}" class="w-full md:w-auto bg-white border-2 border-black px-8 py-3 text-lg font-black uppercase shadow-[4px_4px_0_0_#000] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all text-center">
                        Pesan via WA ➔
                    </a>
                </div>

            </div>
        @else
            <div class="bg-white border-2 border-black shadow-[8px_8px_0_0_#000] p-12 text-center">
                <div class="text-5xl mb-4">🛒</div>
                <p class="text-2xl font-black uppercase mb-4">Keranjang Kosong</p>
                <a href="/" class="bg-yellow-400 border-2 border-black px-6 py-3 font-black uppercase shadow-[4px_4px_0_0_#000] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all inline-block">
                    Cari Menu Dulu
                </a>
            </div>
        @endif
    </main>
</body>
</html>