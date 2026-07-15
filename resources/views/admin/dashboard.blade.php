@extends('admin.layout')

@section('page_title', 'Ringkasan & Statistik')

@section('content')
<div class="space-y-8">
    
    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Game -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 flex items-center justify-between shadow-sm">
            <div class="space-y-2">
                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Total Game</span>
                <h3 class="text-3xl font-black text-slate-800 dark:text-white leading-none">{{ $totalGames }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-violet-50 dark:bg-violet-950/20 text-violet-500 flex items-center justify-center">
                <i data-lucide="gamepad-2" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 2: Total Produk -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 flex items-center justify-between shadow-sm">
            <div class="space-y-2">
                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Total Produk</span>
                <h3 class="text-3xl font-black text-slate-800 dark:text-white leading-none">{{ $totalProducts }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/20 text-indigo-500 flex items-center justify-center">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 3: Produk Aktif -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 flex items-center justify-between shadow-sm">
            <div class="space-y-2">
                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Produk Aktif</span>
                <h3 class="text-3xl font-black text-slate-800 dark:text-white leading-none">{{ $activeProductsCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-500 flex items-center justify-center">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 4: WhatsApp Clicks -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 flex items-center justify-between shadow-sm">
            <div class="space-y-2">
                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Total Klik WhatsApp</span>
                <h3 class="text-3xl font-black text-slate-800 dark:text-white leading-none">{{ $whatsappClicks }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-950/20 text-teal-500 flex items-center justify-center">
                <i data-lucide="phone-call" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Top Products List -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i data-lucide="trending-up" class="w-4 h-4 text-violet-500"></i>
                    Produk Terlaris
                </h3>
                <span class="text-[10px] bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded text-slate-500">Berdasarkan Item Pemesanan</span>
            </div>

            <!-- List -->
            @if(count($topProducts) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="text-xs font-bold uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800 pb-3">
                                <th class="pb-3">Nama Produk</th>
                                <th class="pb-3">Game</th>
                                <th class="pb-3 text-right">Jumlah Pembelian</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($topProducts as $prod)
                                <tr class="text-slate-600 dark:text-slate-300">
                                    <td class="py-4 font-semibold text-slate-800 dark:text-slate-200">{{ $prod->product_name }}</td>
                                    <td class="py-4 text-xs">{{ $prod->game_name }}</td>
                                    <td class="py-4 text-right font-bold text-violet-500 text-base">{{ $prod->total_qty }}x</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="py-12 text-center text-slate-400 text-xs">
                    <i data-lucide="package" class="w-8 h-8 mx-auto mb-3 text-slate-300"></i>
                    Belum ada data penjualan / pemesanan produk.
                </div>
            @endif
        </div>

        <!-- Quick actions / Links -->
        <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">
            <h3 class="text-base font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <i data-lucide="zap" class="w-4 h-4 text-violet-500"></i>
                Pintasan Cepat
            </h3>
            
            <div class="grid grid-cols-1 gap-3 text-sm font-medium">
                <a href="{{ route('admin.games.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 hover:border-violet-500/40 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all group">
                    <span class="flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-violet-500"></i>
                        Tambah Game Baru
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition-transform"></i>
                </a>

                <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 hover:border-violet-500/40 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all group">
                    <span class="flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-indigo-500"></i>
                        Tambah Produk Baru
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition-transform"></i>
                </a>

                <a href="{{ route('admin.banners.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 hover:border-violet-500/40 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all group">
                    <span class="flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-pink-500"></i>
                        Tambah Banner Hero
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
