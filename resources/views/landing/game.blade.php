@extends('landing.layout')

@section('title', $game->name)

@section('content')
<div class="pt-6 pb-12 bg-bg-dark min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Link -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-primary text-xs font-semibold tracking-wide transition-colors group">
                <i class="fas fa-arrow-left transform group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Beranda
            </a>
        </div>

        <div x-data="gameOrderHandler('{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}', '{{ $game->name }}', {{ $game->id }})" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Game Info Banner & Help Card (4 Cols) -->
            <div class="lg:col-span-4 space-y-6 game-fade-left">
                <!-- Game Detail Card -->
                <div class="bg-bg-card border border-white/10 rounded-3xl p-6 overflow-hidden shadow-2xl relative">
                    <!-- Subtle glow effect inside -->
                    <div class="absolute -top-12 -left-12 w-32 h-32 bg-primary/10 rounded-full blur-2xl pointer-events-none"></div>

                    <!-- Banner Graphic -->
                    <div class="w-full h-44 rounded-2xl overflow-hidden relative mb-6 border border-white/5">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 hover:scale-105" 
                             style="background-image: @if($game->banner && file_exists(public_path('img/' . $game->banner))) url('{{ asset('img/' . $game->banner) }}') @else linear-gradient(to right, #00AEEF, #0077B5) @endif ;"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4 z-10">
                            <span class="inline-flex w-fit items-center gap-1 px-2.5 py-1 rounded-lg bg-primary/20 border border-primary/30 text-primary text-[9px] font-extrabold tracking-wider uppercase mb-2">
                                ⚡ Top Up Instan
                            </span>
                            <h2 class="text-xl font-heading font-black text-white leading-tight">{{ $game->name }}</h2>
                        </div>
                    </div>

                    <p class="text-xs text-gray-400 leading-relaxed mb-6">
                        {{ $game->description ?? 'Top Up game instan 24 jam murah, aman, dan legal di ' . ($setting->store_name ?? 'Gamestore') }}
                    </p>

                    <!-- Instruction Card helper -->
                    <div class="bg-bg-dark border border-white/5 rounded-2xl p-5 space-y-3.5">
                        <h4 class="text-xs font-bold text-white flex items-center gap-2">
                            <i class="fas fa-info-circle text-primary"></i>
                            Petunjuk Pengisian ID:
                        </h4>
                        <ul class="text-[11px] text-gray-400 space-y-2.5 list-none">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 shrink-0"></span>
                                <span>Masukkan <strong>Username</strong> karakter Anda dengan benar.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 shrink-0"></span>
                                <span>Masukkan <strong>UID / ID Game</strong> Anda.</span>
                            </li>
                            @if(in_array($game->slug, ['mobile-legends', 'genshin-impact', 'honkai-star-rail']))
                                <li class="flex items-start gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 shrink-0"></span>
                                    <span>Pilih atau masukkan <strong>Server / Zone ID</strong> game Anda.</span>
                                </li>
                            @else
                                <li class="flex items-start gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 shrink-0"></span>
                                    <span>Kolom <strong>Server</strong> bersifat opsional (bisa dikosongkan).</span>
                                </li>
                            @endif
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 shrink-0"></span>
                                <span>Pilih nominal produk dan tentukan jumlah pembelian.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Forms & Product Grid (8 Cols) -->
            <div class="lg:col-span-8 space-y-6 game-fade-right">
                <!-- STEP 1: Choose Product -->
                <div class="bg-bg-card border border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                    <h3 class="text-lg font-heading font-bold text-white flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-xs font-black text-white shadow-[0_0_15px_rgba(0,174,239,0.3)]">1</span>
                        Pilih Nominal Produk
                    </h3>

                    <!-- Products Grid -->
                    <div class="product-grid grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($game->products as $product)
                            <button 
                                @click="selectProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})"
                                :class="selectedProduct && selectedProduct.id === {{ $product->id }} ? 'border-primary bg-primary/5 text-white shadow-[0_0_15px_rgba(0,174,239,0.1)]' : 'border-white/10 bg-bg-dark text-gray-300'"
                                class="border rounded-2xl p-4 text-left hover:border-primary/40 transition-all duration-200 relative overflow-hidden flex flex-col justify-between h-28 cursor-pointer group"
                            >
                                <span class="text-xs font-bold block line-clamp-2 leading-snug group-hover:text-white" :class="selectedProduct && selectedProduct.id === {{ $product->id }} ? 'text-white' : 'text-gray-300'">
                                    {{ $product->name }}
                                </span>
                                
                                <span class="text-[11px] font-bold text-primary mt-2 block" :class="selectedProduct && selectedProduct.id === {{ $product->id }} ? 'text-primary' : 'text-primary/80'">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>

                                <!-- Selected Checkmark Badge -->
                                <div x-cloak x-show="selectedProduct && selectedProduct.id === {{ $product->id }}" class="absolute bottom-3 right-3 text-primary">
                                    <i class="fas fa-check-circle text-lg"></i>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- STEP 2: Input Player Details & Quantity -->
                <div class="bg-bg-card border border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                    <h3 class="text-lg font-heading font-bold text-white flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-xs font-black text-white shadow-[0_0_15px_rgba(0,174,239,0.3)]">2</span>
                        Data Akun & Jumlah
                    </h3>

                    <!-- Error Alert -->
                    <div x-cloak x-show="validationError" class="bg-rose-950/20 border border-rose-500/30 text-rose-400 p-4 rounded-2xl text-xs flex gap-2 items-center">
                        <i class="fas fa-exclamation-circle text-sm shrink-0"></i>
                        <span x-text="validationError"></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Username Karakter</label>
                            <input x-model="username" type="text" placeholder="Masukkan Username" class="w-full bg-bg-dark border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-primary transition-colors">
                        </div>

                        <!-- UID -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">UID / Player ID</label>
                            <input x-model="uid" type="text" placeholder="Masukkan UID" class="w-full bg-bg-dark border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-primary transition-colors">
                        </div>

                        <!-- Server (Condition check based on game type) -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Server / Zone ID <span class="text-gray-500 text-[10px] lowercase font-normal">(opsional)</span></label>
                            <input x-model="server" type="text" placeholder="Masukkan Server / Zone ID" class="w-full bg-bg-dark border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-primary transition-colors">
                        </div>

                        <!-- Quantity -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Jumlah Pembelian</label>
                            <div class="flex items-center gap-2 bg-bg-dark border border-white/10 rounded-xl p-1 max-w-[150px]">
                                <button @click="updateFormQty(-1)" class="w-9 h-9 flex items-center justify-center rounded-lg bg-bg-card hover:bg-white/5 border border-white/5 text-gray-300 transition-colors cursor-pointer font-bold">-</button>
                                <span class="flex-1 text-center font-bold text-white text-sm" x-text="quantity"></span>
                                <button @click="updateFormQty(1)" class="w-9 h-9 flex items-center justify-center rounded-lg bg-bg-card hover:bg-white/5 border border-white/5 text-gray-300 transition-colors cursor-pointer font-bold">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Buy Now Action & Add to Cart -->
                    <div class="pt-5 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <span class="text-gray-400 text-xs">Total Pembayaran</span>
                            <div class="text-2xl font-black text-white mt-0.5" x-text="formatRupiah(calculateTotal())"></div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                            <button @click="addCurrentToCart()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary/10 hover:bg-primary/20 border border-primary/30 text-primary font-bold px-5 py-3.5 rounded-2xl transition-all hover:scale-105 cursor-pointer">
                                <i class="fas fa-cart-plus text-base"></i>
                                <span>+ Keranjang</span>
                            </button>

                            <button @click="buyNowWhatsApp()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-7 py-3.5 rounded-2xl transition-all shadow-lg shadow-emerald-600/10 hover:scale-105 cursor-pointer">
                                <i class="fab fa-whatsapp text-lg"></i>
                                <span>Beli Langsung</span>
                            </button>
                        </div>
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

            addCurrentToCart() {
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

                this.$dispatch('add-to-cart', {
                    gameId: gameId,
                    gameName: this.gameName,
                    productId: this.selectedProduct.id,
                    productName: this.selectedProduct.name,
                    price: this.selectedProduct.price,
                    username: this.username.trim(),
                    uid: this.uid.trim(),
                    server: this.server.trim(),
                    quantity: this.quantity
                });
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
