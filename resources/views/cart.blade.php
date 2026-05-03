<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Saya - Warkop Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans">

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-slate-800">PESANAN <span class="text-orange-600">KAMU</span> ☕</h2>
            <a href="/" class="text-slate-500 hover:text-orange-600 font-bold transition">← Tambah Menu Lagi</a>
        </div>
        
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden p-8 border border-slate-100">
            @if(session('cart') && count(session('cart')) > 0)
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="pb-6 text-slate-400 uppercase text-xs tracking-widest">Menu</th>
                            <th class="pb-6 text-slate-400 uppercase text-xs tracking-widest text-center">Harga</th>
                            <th class="pb-6 text-slate-400 uppercase text-xs tracking-widest text-center">Jumlah</th>
                            <th class="pb-6 text-slate-400 uppercase text-xs tracking-widest text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr class="border-b border-slate-50 last:border-0">
                                <!-- 1. Kolom Menu & Hapus -->
                                <td class="py-6">
                                    <p class="font-bold text-slate-800 text-lg">{{ $details['name'] }}</p>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="text-red-500 text-xs font-bold hover:underline">
                                            Hapus Item
                                        </button>
                                    </form>
                                </td>

                                <!-- 2. Kolom Harga Satuan -->
                                <td class="py-6 text-center text-slate-600 font-medium">
                                    Rp{{ number_format($details['price'], 0, ',', '.') }}
                                </td>

                                <!-- 3. Kolom Jumlah (Input Step 7) -->
                                <td class="py-6 text-center">
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center justify-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" 
                                            min="1" onchange="this.form.submit()" 
                                            class="w-16 text-center border border-slate-200 rounded-lg font-bold p-1 focus:ring-2 focus:ring-orange-500 outline-none">
                                    </form>
                                </td>

                                <!-- 4. Kolom Total Harga -->
                                <td class="py-6 text-right font-black text-slate-900 text-lg">
                                    Rp{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Bagian Total & Tombol Checkout -->
                <div class="mt-10 pt-8 border-t-2 border-dashed border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <p class="text-slate-400 text-sm">Total yang harus dibayar:</p>
                        <p class="text-4xl font-black text-slate-900">Rp{{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                    
                    <!-- Langsung pakai tag <a> saja, buat apa pakai <button> lagi? -->
                    <a href="{{ route('cart.checkout') }}" 
                    class="w-full md:w-auto bg-green-500 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-green-600 hover:shadow-lg hover:shadow-green-200 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <span>✅ Pesan via WhatsApp</span>
                    </a>
                </div>
            @else
                <div class="py-12 text-center">
                    <div class="text-6xl mb-4">🛒</div>
                    <p class="text-slate-400 text-lg font-medium">Wah, keranjang kamu masih kosong nih, Ar.</p>
                    <a href="/" class="inline-block mt-6 bg-orange-600 text-white px-8 py-3 rounded-xl font-bold">Cari Kopi Dulu</a>
                </div>
            @endif
        </div>
    </div>

</body>
</html>