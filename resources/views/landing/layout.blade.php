<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $setting->store_name ?? 'Gamestore Indonesia') - Top Up Game Instan Terpercaya</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #030712; /* slate-950 */
            color: #f3f4f6; /* slate-100 */
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .glow-hover:hover {
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.4);
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #090d16;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e1b4b;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #312e81;
        }
    </style>
</head>
<body x-data="cartHandler()" x-init="initCart()" class="min-h-screen flex flex-col antialiased bg-[#020617] text-slate-100">

    <!-- Navbar -->
    <nav class="sticky top-0 z-40 bg-[#090d16]/80 backdrop-blur-md border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo / Title -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-violet-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-violet-500/20 group-hover:scale-105 transition-transform duration-300">
                            <i data-lucide="gamepad-2" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-white via-slate-200 to-violet-400 bg-clip-text text-transparent">
                            {{ $setting->store_name ?? 'Gamestore Indonesia' }}
                        </span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-slate-300 hover:text-white transition-colors">Beranda</a>
                    <a href="{{ route('home') }}#games" class="text-slate-300 hover:text-white transition-colors">Daftar Game</a>
                    <a href="{{ route('home') }}#features" class="text-slate-300 hover:text-white transition-colors">Tentang Kami</a>
                    <a href="{{ route('home') }}#cara-order" class="text-slate-300 hover:text-white transition-colors">Cara Order</a>
                    <a href="{{ route('home') }}#testimonials" class="text-slate-300 hover:text-white transition-colors">Ulasan</a>
                </div>

                <!-- Cart Button & Mobile Menu -->
                <div class="flex items-center gap-4">
                    <!-- Cart Indicator Button -->
                    <button @click="openCart = true" class="relative p-2 rounded-xl bg-slate-900/80 hover:bg-slate-800 border border-slate-800 flex items-center justify-center text-slate-300 hover:text-white transition-all glow-hover cursor-pointer">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        <span x-show="cart.length > 0" x-text="cartTotalQuantity()" class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-violet-600 text-white text-[10px] font-bold flex items-center justify-center animate-bounce"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#05070f] border-t border-slate-900 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <!-- Info Section -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-violet-600 to-indigo-600 flex items-center justify-center">
                            <i data-lucide="gamepad-2" class="w-4 h-4 text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-white">{{ $setting->store_name ?? 'Gamestore Indonesia' }}</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        {{ $setting->footer ?? 'Penyedia Top Up Game Instan Terlengkap, Termurah, & Terpercaya di Indonesia.' }}
                    </p>
                    @if($setting->address)
                        <div class="flex gap-2 items-start text-slate-400 text-xs leading-relaxed">
                            <i data-lucide="map-pin" class="w-4 h-4 text-violet-400 flex-shrink-0 mt-0.5"></i>
                            <span>{{ $setting->address }}</span>
                        </div>
                    @endif
                </div>

                <!-- Fast Links -->
                <div class="md:justify-self-center">
                    <h3 class="text-white font-semibold mb-6">Navigasi</h3>
                    <ul class="space-y-3 text-slate-400 text-sm">
                        <li><a href="{{ route('home') }}#games" class="hover:text-violet-400 transition-colors">Daftar Game</a></li>
                        <li><a href="{{ route('home') }}#features" class="hover:text-violet-400 transition-colors">Mengapa Kami</a></li>
                        <li><a href="{{ route('home') }}#cara-order" class="hover:text-violet-400 transition-colors">Cara Order</a></li>
                        <li><a href="{{ route('home') }}#testimonials" class="hover:text-violet-400 transition-colors">Testimoni</a></li>
                    </ul>
                </div>

                <!-- Socials & Channel -->
                <div>
                    <h3 class="text-white font-semibold mb-6">Hubungi Kami & Saluran</h3>
                    <div class="flex gap-3 mb-6">
                        @if($setting->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-violet-600 hover:text-white transition-all text-slate-400">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </a>
                        @endif
                        @if($setting->instagram)
                            <a href="{{ $setting->instagram }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-violet-600 hover:text-white transition-all text-slate-400">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                        @endif
                        @if($setting->facebook)
                            <a href="{{ $setting->facebook }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-violet-600 hover:text-white transition-all text-slate-400">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                        @endif
                        @if($setting->discord)
                            <a href="{{ $setting->discord }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-violet-600 hover:text-white transition-all text-slate-400">
                                <i data-lucide="message-square" class="w-5 h-5"></i>
                            </a>
                        @endif
                    </div>

                    @if($setting->whatsapp_channel)
                        <a href="{{ $setting->whatsapp_channel }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600/10 hover:bg-emerald-600/20 text-emerald-400 px-4 py-2.5 rounded-xl border border-emerald-500/20 text-xs font-semibold tracking-wide transition-all duration-300">
                            <i data-lucide="bell" class="w-4 h-4"></i>
                            Gabung Saluran WhatsApp Testimoni
                        </a>
                    @endif
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-slate-900/60 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <span>&copy; {{ date('Y') }} {{ $setting->store_name ?? 'Gamestore Indonesia' }}. All rights reserved.</span>
                <span class="flex items-center gap-1">Dibuat dengan <i data-lucide="heart" class="w-3.5 h-3.5 text-rose-500 fill-rose-500"></i> untuk Gamers</span>
            </div>
        </div>
    </footer>

    <!-- Shopping Cart Drawer (Alpine.js) -->
    <div x-cloak x-show="openCart" class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background Backdrop -->
            <div x-show="openCart" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="openCart = false" class="absolute inset-0 bg-[#020617]/70 backdrop-blur-sm transition-opacity"></div>

            <!-- Drawer Container -->
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div x-show="openCart" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-[#0b0f19] border-l border-slate-800/80 shadow-2xl">
                        <!-- Drawer Header -->
                        <div class="flex items-center justify-between px-6 py-6 border-b border-slate-800/80 bg-[#090d16]">
                            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                                <i data-lucide="shopping-cart" class="w-5 h-5 text-violet-400"></i>
                                Keranjang Belanja
                            </h2>
                            <button @click="openCart = false" class="p-2 rounded-lg bg-slate-900/85 hover:bg-slate-800 text-slate-400 hover:text-white transition-colors cursor-pointer border border-slate-800/80">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <!-- Drawer Body -->
                        <div class="flex-1 py-6 overflow-y-auto px-6 space-y-4">
                            <!-- Empty Cart State -->
                            <template x-if="cart.length === 0">
                                <div class="h-full flex flex-col items-center justify-center text-center py-12">
                                    <div class="w-16 h-16 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center mb-4 text-slate-600">
                                        <i data-lucide="shopping-bag" class="w-8 h-8"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-300">Keranjang Kosong</h3>
                                    <p class="mt-1 text-xs text-slate-500 max-w-[240px]">Belum ada produk yang ditambahkan. Silakan pilih produk game Anda terlebih dahulu.</p>
                                    <a @click="openCart = false" href="{{ route('home') }}#games" class="mt-6 inline-flex items-center justify-center bg-violet-600 hover:bg-violet-500 text-white font-semibold text-xs py-2.5 px-6 rounded-xl transition-all cursor-pointer">
                                        Lihat Produk Game
                                    </a>
                                </div>
                            </template>

                            <!-- Cart Items List -->
                            <template x-if="cart.length > 0">
                                <div class="space-y-4">
                                    <template x-for="(item, index) in cart" :key="index">
                                        <div class="bg-slate-900/60 border border-slate-800/80 rounded-2xl p-4 flex gap-4 relative overflow-hidden">
                                            <!-- Remove Item Button -->
                                            <button @click="removeItem(index)" class="absolute top-2 right-2 p-1.5 rounded-lg bg-red-950/20 text-red-400 hover:bg-red-950/60 hover:text-red-300 transition-colors border border-red-900/10 cursor-pointer">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>

                                            <!-- Content -->
                                            <div class="flex-grow space-y-2">
                                                <div class="pr-6">
                                                    <h4 class="text-sm font-bold text-white" x-text="item.gameName"></h4>
                                                    <p class="text-xs text-slate-400" x-text="item.productName"></p>
                                                </div>

                                                <!-- Order Meta -->
                                                <div class="grid grid-cols-2 gap-x-2 gap-y-1 bg-slate-950/50 rounded-lg p-2 text-[10px] text-slate-400">
                                                    <div>Username: <span class="text-slate-200 font-medium" x-text="item.username"></span></div>
                                                    <div>UID: <span class="text-slate-200 font-medium" x-text="item.uid"></span></div>
                                                    <template x-if="item.server">
                                                        <div class="col-span-2">Server: <span class="text-slate-200 font-medium" x-text="item.server"></span></div>
                                                    </template>
                                                </div>

                                                <!-- Price & Qty Actions -->
                                                <div class="flex items-center justify-between pt-2">
                                                    <span class="text-xs font-semibold text-violet-400" x-text="formatRupiah(item.price * item.quantity)"></span>
                                                    
                                                    <!-- Quantity Control -->
                                                    <div class="flex items-center gap-1 bg-slate-950 rounded-lg p-1 border border-slate-800">
                                                        <button @click="updateQty(index, -1)" class="w-6 h-6 flex items-center justify-center rounded bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition-all text-xs font-bold cursor-pointer">-</button>
                                                        <span class="w-6 text-center text-xs font-bold text-white" x-text="item.quantity"></span>
                                                        <button @click="updateQty(index, 1)" class="w-6 h-6 flex items-center justify-center rounded bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white transition-all text-xs font-bold cursor-pointer">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Drawer Footer -->
                        <template x-if="cart.length > 0">
                            <div class="border-t border-slate-800/80 bg-[#090d16] px-6 py-6 space-y-6">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-400 font-medium">Total Harga</span>
                                    <span class="text-lg font-bold text-white" x-text="formatRupiah(cartTotalSum())"></span>
                                </div>
                                <button @click="checkoutWhatsApp()" class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-lg shadow-emerald-600/10 cursor-pointer">
                                    <i data-lucide="message-square" class="w-5 h-5 fill-white"></i>
                                    Checkout via WhatsApp
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Widget -->
    <div x-data="{ showFloating: false }" x-init="setTimeout(() => showFloating = true, 1500)" x-show="showFloating" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-10 scale-90" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-3">
        <!-- Floating Dialog Bubble (Toggled on hover or automatically shown) -->
        <div x-data="{ openBubble: true }" x-show="openBubble" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-2 scale-95" class="bg-slate-900 border border-slate-800 p-4 rounded-2xl shadow-xl max-w-[260px] relative">
            <button @click="openBubble = false" class="absolute top-2 right-2 text-slate-500 hover:text-white cursor-pointer">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
            <div class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i data-lucide="message-circle" class="w-4 h-4 text-white"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold text-slate-200">Ada yang ingin ditanyakan?</h5>
                    <p class="text-[10px] text-slate-400 mt-1 leading-relaxed">Konsultasi atau tanyakan mengenai produk kami langsung kepada Admin.</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Halo%20Admin%20saya%20ingin%20tanya%20mengenai%20produk%20game." target="_blank" class="mt-2.5 inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-lg transition-all">
                        <i data-lucide="message-square" class="w-3 h-3"></i>
                        Chat Admin
                    </a>
                </div>
            </div>
        </div>

        <!-- Big Floating Button -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}?text=Halo%20Admin%20saya%20ingin%20tanya%20mengenai%20produk%20game." target="_blank" class="w-14 h-14 rounded-full bg-emerald-600 flex items-center justify-center text-white shadow-2xl hover:bg-emerald-500 hover:scale-105 hover:rotate-6 transition-all duration-300 shadow-emerald-500/20 group relative cursor-pointer">
            <i data-lucide="message-circle" class="w-7 h-7"></i>
            <span class="absolute right-16 scale-90 opacity-0 group-hover:scale-100 group-hover:opacity-100 bg-[#090d16] text-white border border-slate-800 text-xs py-1.5 px-3 rounded-lg font-medium whitespace-nowrap transition-all duration-300 shadow-lg">Chat Admin</span>
        </a>
    </div>

    <!-- Script handlers -->
    <script>
        function cartHandler() {
            return {
                cart: [],
                openCart: false,
                storeWhatsapp: '{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}',
                storeName: '{{ $setting->store_name }}',

                initCart() {
                    let savedCart = localStorage.getItem('gamestore_cart');
                    if (savedCart) {
                        try {
                            this.cart = JSON.parse(savedCart);
                        } catch(e) {
                            this.cart = [];
                        }
                    }
                    this.$watch('cart', value => {
                        localStorage.setItem('gamestore_cart', JSON.stringify(value));
                    });
                },

                addToCart(item) {
                    // item: { gameId, gameName, productId, productName, price, username, uid, server, quantity }
                    let existingIndex = this.cart.findIndex(i => 
                        i.productId === item.productId && 
                        i.username === item.username && 
                        i.uid === item.uid && 
                        i.server === item.server
                    );

                    if (existingIndex !== -1) {
                        this.cart[existingIndex].quantity += item.quantity;
                    } else {
                        this.cart.push(item);
                    }

                    // Open cart drawer immediately to show added item
                    this.openCart = true;

                    // Trigger Lucide icons refresh for dynamically loaded templates
                    setTimeout(() => lucide.createIcons(), 100);
                },

                removeItem(index) {
                    this.cart.splice(index, 1);
                },

                updateQty(index, delta) {
                    let newQty = this.cart[index].quantity + delta;
                    if (newQty > 0) {
                        this.cart[index].quantity = newQty;
                    } else {
                        this.removeItem(index);
                    }
                },

                cartTotalQuantity() {
                    return this.cart.reduce((sum, item) => sum + item.quantity, 0);
                },

                cartTotalSum() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(number);
                },

                checkoutWhatsApp() {
                    if (this.cart.length === 0) return;

                    let message = `*PESANAN BARU - ${this.storeName.toUpperCase()}*\n`;
                    message += `=================================\n`;
                    message += `*Detail Pesanan:*\n\n`;

                    this.cart.forEach((item, index) => {
                        let idx = index + 1;
                        message += `${idx}. *${item.gameName}*\n`;
                        message += `   - Item: ${item.productName} (x${item.quantity})\n`;
                        message += `   - Username: *${item.username}*\n`;
                        message += `   - UID / ID Game: *${item.uid}*\n`;
                        if (item.server) {
                            message += `   - Server: *${item.server}*\n`;
                        }
                        message += `   - Harga: ${this.formatRupiah(item.price)}\n`;
                        message += `   - Subtotal: ${this.formatRupiah(item.price * item.quantity)}\n\n`;
                    });

                    message += `=================================\n`;
                    message += `*TOTAL TAGIHAN: ${this.formatRupiah(this.cartTotalSum())}*\n`;
                    message += `=================================\n\n`;
                    message += `Mohon segera diproses dan kirimkan instruksi pembayarannya. Terima kasih!`;

                    let url = `https://wa.me/${this.storeWhatsapp}?text=${encodeURIComponent(message)}`;
                    window.open(url, '_blank');
                }
            };
        }

        // Initialize Lucide icons & WA Click logger
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Globally listen to WhatsApp clicks
            document.addEventListener('click', (e) => {
                let target = e.target.closest('a');
                if (target && target.href && target.href.includes('wa.me')) {
                    fetch('/log-click', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).catch(err => console.error('Click log failed', err));
                }
            });
        });
    </script>
</body>
</html>
