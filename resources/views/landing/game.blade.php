@extends('landing.layout')

@section('title', $game->name)

@section('content')
<div class="py-12 bg-[#020617] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Link -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-xs font-semibold tracking-wide transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Beranda
            </a>
        </div>

        <div x-data="gameOrderHandler('{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}', '{{ $game->name }}', {{ $game->id }})" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Game Info Banner & Help Card -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Game Detail Card -->
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl p-6 overflow-hidden shadow-2xl relative">
                    <!-- Banner Graphic -->
                    <div class="w-full h-40 rounded-2xl overflow-hidden relative mb-6">
                        <div class="absolute inset-0 bg-cover bg-center" 
                             style="background-image: @if($game->banner && file_exists(public_path('img/' . $game->banner))) url('{{ asset('img/' . $game->banner) }}') @else linear-gradient(to right, #6d28d9, #4f46e5) @endif ;"></div>
                        <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-4 z-10">
                            <span class="inline-flex w-fit items-center gap-1.5 px-2 py-0.5 rounded bg-violet-600 text-white text-[9px] font-extrabold tracking-wider uppercase mb-1">
                                TOP UP INSTAN
                            </span>
                            <h2 class="text-lg font-black text-white leading-tight">{{ $game->name }}</h2>
                        </div>
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ $game->description ?? 'Top Up game instan 24 jam murah dan legal di ' . ($setting->store_name ?? 'Gamestore') }}
                    </p>

                    <!-- Instruction Card helper -->
                    <div class="mt-6 bg-[#05070f] border border-slate-800/60 rounded-2xl p-4 space-y-3">
                        <h4 class="text-xs font-bold text-white flex items-center gap-1.5">
                            <i data-lucide="info" class="w-4 h-4 text-violet-400"></i>
                            Petunjuk Pengisian ID:
                        </h4>
                        <ul class="text-[10px] text-slate-400 space-y-2 list-disc list-inside">
                            <li>Masukkan <strong>Username</strong> karakter Anda dengan benar.</li>
                            <li>Masukkan <strong>UID / ID Game</strong> Anda.</li>
                            @if(in_array($game->slug, ['mobile-legends', 'genshin-impact', 'honkai-star-rail']))
                                <li>Pilih atau masukkan <strong>Server / Zone ID</strong> game Anda.</li>
                            @else
                                <li>Kolom <strong>Server</strong> bersifat opsional atau dapat dikosongkan jika game tidak memerlukannya.</li>
                            @endif
                            <li>Pilih nominal produk dan tentukan jumlah pembelian.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Forms & Product Grid -->
            <div class="lg:col-span-2 space-y-6">
                <!-- STEP 1: Choose Product -->
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-violet-600 flex items-center justify-center text-xs font-extrabold text-white">1</span>
                        Pilih Nominal Produk
                    </h3>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($game->products as $product)
                            <button 
                                @click="selectProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})"
                                :class="selectedProduct && selectedProduct.id === {{ $product->id }} ? 'border-violet-500 bg-violet-600/10 text-white' : 'border-slate-800/80 bg-[#05070f] text-slate-300'"
                                class="border rounded-2xl p-4 text-left hover:border-violet-500/40 transition-all duration-200 relative overflow-hidden flex flex-col justify-between h-28 cursor-pointer group"
                            >
                                <span class="text-xs font-bold block line-clamp-2 leading-snug group-hover:text-white" :class="selectedProduct && selectedProduct.id === {{ $product->id }} ? 'text-white' : 'text-slate-300'">
                                    {{ $product->name }}
                                </span>
                                
                                <span class="text-[10px] font-bold text-violet-400 mt-2 block" :class="selectedProduct && selectedProduct.id === {{ $product->id }} ? 'text-violet-400' : 'text-violet-400/80'">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>

                                <!-- Selected Checkmark Badge -->
                                <div x-show="selectedProduct && selectedProduct.id === {{ $product->id }}" class="absolute bottom-2 right-2 text-violet-400">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 fill-violet-600 text-white"></i>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- STEP 2: Input Player Details & Quantity -->
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-violet-600 flex items-center justify-center text-xs font-extrabold text-white">2</span>
                        Data Akun & Jumlah
                    </h3>

                    <!-- Error Alert -->
                    <div x-cloak x-show="validationError" class="bg-red-950/20 border border-red-500/30 text-red-400 p-4 rounded-2xl text-xs flex gap-2 items-center">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span x-text="validationError"></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Username Karakter</label>
                            <input x-model="username" type="text" placeholder="Masukkan Username" class="w-full bg-[#05070f] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-violet-500 transition-colors">
                        </div>

                        <!-- UID -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">UID / Player ID</label>
                            <input x-model="uid" type="text" placeholder="Masukkan UID" class="w-full bg-[#05070f] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-violet-500 transition-colors">
                        </div>

                        <!-- Server (Condition check based on game type) -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Server / Zone ID <span class="text-slate-500 text-[10px] lowercase font-normal">(opsional)</span></label>
                            <input x-model="server" type="text" placeholder="Masukkan Server / Zone ID" class="w-full bg-[#05070f] border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-violet-500 transition-colors">
                        </div>

                        <!-- Quantity -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">Jumlah Pembelian</label>
                            <div class="flex items-center gap-2 bg-[#05070f] border border-slate-800 rounded-xl p-1 max-w-[150px]">
                                <button @click="updateFormQty(-1)" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-300 transition-colors cursor-pointer">-</button>
                                <span class="flex-1 text-center font-bold text-white text-sm" x-text="quantity"></span>
                                <button @click="updateFormQty(1)" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-300 transition-colors cursor-pointer">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Buy Now Action -->
                    <div class="pt-4 border-t border-slate-800/40 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <span class="text-slate-400 text-xs">Total Pembayaran</span>
                            <div class="text-xl font-bold text-white mt-0.5" x-text="formatRupiah(calculateTotal())"></div>
                        </div>
                        
                        <button @click="buyNowWhatsApp()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-8 py-4 rounded-2xl transition-all shadow-lg shadow-emerald-500/20 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Beli via WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function gameOrderHandler(waNumber, gameName, gameId) {
        return {
            selectedProduct: null,
            username: '',
            uid: '',
            server: '',
            quantity: 1,
            validationError: '',
            waNumber: waNumber,
            gameName: gameName,

            selectProduct(id, name, price) {
                this.selectedProduct = { id, name, price };
                this.validationError = '';
            },

            updateFormQty(delta) {
                let next = this.quantity + delta;
                if (next > 0) {
                    this.quantity = next;
                }
            },

            calculateTotal() {
                if (!this.selectedProduct) return 0;
                return this.selectedProduct.price * this.quantity;
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(number);
            },

            buyNowWhatsApp() {
                if (!this.selectedProduct) {
                    this.validationError = 'Silakan pilih salah satu produk/nominal terlebih dahulu.';
                    return;
                }
                if (!this.username.trim()) {
                    this.validationError = 'Silakan masukkan Username Karakter Anda.';
                    return;
                }
                if (!this.uid.trim()) {
                    this.validationError = 'Silakan masukkan UID / Player ID Anda.';
                    return;
                }

                this.validationError = '';

                let total = this.formatRupiah(this.selectedProduct.price * this.quantity);
                let harga = this.formatRupiah(this.selectedProduct.price);

                let msg = `*PESANAN BARU*\n`;
                msg += `=================================\n`;
                msg += `*Game:* ${this.gameName}\n`;
                msg += `*Item:* ${this.selectedProduct.name} (x${this.quantity})\n`;
                msg += `\n*Data Akun:*\n`;
                msg += `• Username: *${this.username.trim()}*\n`;
                msg += `• UID / ID Game: *${this.uid.trim()}*\n`;
                if (this.server.trim()) {
                    msg += `• Server: *${this.server.trim()}*\n`;
                }
                msg += `\n*Harga Satuan:* ${harga}\n`;
                msg += `*Jumlah:* ${this.quantity}x\n`;
                msg += `*TOTAL: ${total}*\n`;
                msg += `=================================\n\n`;
                msg += `Mohon segera diproses. Terima kasih! 🙏`;

                // Log click to DB
                fetch('/log-click', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).catch(err => console.error('Click log failed', err));

                let url = `https://wa.me/${this.waNumber}?text=${encodeURIComponent(msg)}`;
                window.open(url, '_blank');
            }
        }
    }
</script>
@endsection
