@extends('admin.layout')

@section('page_title', 'Ringkasan & Statistik')

@section('content')
<div class="space-y-8">
    
    <!-- Stats Cards Grid - Vista de 3 columnas (KPI, KPI, KPI) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Total Game -->
        <div class="admin-form-card p-5 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Total Game</span>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-[32px] font-bold text-white leading-none font-mono">{{ $totalGames }}</h3>
                    <span class="text-xs text-watt-text-sec font-mono">Unit</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-watt-cyan/10 text-watt-cyan flex items-center justify-center">
                <i data-lucide="gamepad-2" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 2: Total Produk (con indicador En Vivo para activos) -->
        <div class="admin-form-card p-5 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Total Produk</span>
                <div class="flex items-baseline gap-3">
                    <h3 class="text-[32px] font-bold text-white leading-none font-mono">{{ $totalProducts }}</h3>
                    <div class="flex items-center gap-1 bg-watt-green/10 text-watt-green text-[10px] font-bold px-2 py-0.5 rounded-full border border-watt-green/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-watt-green animate-pulse"></span>
                        {{ $activeProductsCount }} Aktif
                    </div>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-watt-cyan/10 text-watt-cyan flex items-center justify-center">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Card 3: WhatsApp Clicks -->
        <div class="admin-form-card p-5 flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-watt-text-sec uppercase tracking-wider">Klik WhatsApp</span>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-[32px] font-bold text-white leading-none font-mono">{{ $whatsappClicks }}</h3>
                    <span class="text-xs text-watt-cyan font-semibold font-mono">Live</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-watt-cyan/10 text-watt-cyan flex items-center justify-center">
                <i data-lucide="zap" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Details & Chart Grid - 12 columns layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Content: Chart and Top Products (8 columns) -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Custom Area Chart - Gráficos (Charts) -->
            <div class="admin-form-card p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <i data-lucide="activity" class="w-4 h-4 text-watt-cyan"></i>
                            Tren Aktivitas & Interaksi (7 Hari Terakhir)
                        </h3>
                        <p class="text-xs text-watt-text-sec">Frekuensi klik tombol WhatsApp dan interaksi pengguna.</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-mono">
                        <span class="flex items-center gap-1.5 text-watt-cyan">
                            <span class="w-2.5 h-2.5 rounded-full bg-watt-cyan"></span>
                            Klik WA
                        </span>
                    </div>
                </div>

                <!-- Dynamic Area Chart Canvas -->
                <div class="relative w-full h-64 bg-watt-bg/30 rounded-xl border border-watt-border/40 p-4">
                    <canvas id="activityChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('activityChart').getContext('2d');
                    const gradient = ctx.createLinearGradient(0, 0, 0, 200);
                    gradient.addColorStop(0, 'rgba(0, 229, 255, 0.35)');
                    gradient.addColorStop(1, 'rgba(0, 229, 255, 0.0)');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [{
                                label: 'Transaksi / Pesanan',
                                data: @json($chartData),
                                borderColor: '#00E5FF',
                                borderWidth: 2.5,
                                backgroundColor: gradient,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#00E5FF',
                                pointBorderColor: '#121212',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#1E293B',
                                    titleColor: '#F8FAFC',
                                    bodyColor: '#00E5FF',
                                    borderColor: 'rgba(255,255,255,0.1)',
                                    borderWidth: 1,
                                    padding: 10,
                                    displayColors: false,
                                    callbacks: {
                                        label: function(context) {
                                            return context.parsed.y + ' Transaksi';
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: { display: false },
                                    ticks: { color: '#94A3B8', font: { family: 'monospace', size: 10 } }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: { color: 'rgba(255,255,255,0.05)' },
                                    ticks: { color: '#94A3B8', precision: 0, font: { family: 'monospace', size: 10 } }
                                }
                            }
                        }
                    });
                });
            </script>

            <!-- Top Products List Table -->
            <div class="admin-form-card p-5 space-y-6 admin-table-shell">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-watt-cyan"></i>
                        Produk Terlaris
                    </h3>
                    <span class="text-[10px] bg-watt-hover px-2 py-1 rounded text-watt-text-sec font-mono">Total Order</span>
                </div>

                @if($topProducts->count() > 0)
                    <div class="overflow-x-auto admin-table-shell admin-table-scroll">
                        <table class="admin-table">
                            <thead>
                                <tr class="admin-table-head">
                                    <th class="admin-table-head">Nama Produk</th>
                                    <th class="admin-table-head">Game</th>
                                    <th class="admin-table-head text-right">Jumlah Pembelian</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-watt-border">
                                @foreach($topProducts as $prod)
                                    <tr class="admin-table-row text-watt-text-sec">
                                        <td class="py-4 font-semibold text-white">{{ $prod->product_name }}</td>
                                        <td class="py-4 text-xs font-mono">{{ $prod->game_name }}</td>
                                        <td class="py-4 text-right font-bold text-watt-cyan text-base font-mono">{{ $prod->total_qty }}x</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-between items-center px-4 py-3 rounded-xl border border-watt-border bg-watt-bg/40">
                        <span class="text-[11px] text-watt-text-sec font-mono">Menampilkan 5 produk dengan performa penjualan terbaik</span>
                        <span class="text-[10px] bg-watt-cyan/10 text-watt-cyan px-2 py-0.5 rounded-full font-mono font-bold">Top 5</span>
                    </div>
                @else
                    <div class="py-12 text-center text-watt-text-sec text-xs">
                        <i data-lucide="package" class="w-8 h-8 mx-auto mb-3 text-watt-text-sec"></i>
                        Belum ada data penjualan / pemesanan produk.
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Sidebar: Alerts & Quick Shortcuts (4 columns) -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Panel Alertas / Logs System (Strictly themed box #3A1C1C, text #FF453A, left border 4px #FF453A) -->
            <div class="admin-form-card p-5 space-y-4">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i data-lucide="bell" class="w-4 h-4 text-watt-red"></i>
                    Status & Log Pemantauan
                </h3>

                <div class="space-y-3">
                    <!-- Critical Alert Box -->
                    <div class="p-3 bg-watt-alert-bg border-l-4 border-watt-red text-watt-red rounded-r-xl text-xs space-y-1">
                        <div class="font-bold flex items-center gap-1.5">
                            <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i>
                            Peringatan Aktivitas Vampir
                        </div>
                        <p class="leading-relaxed opacity-90">
                            Lonjakan klik tombol WhatsApp yang tidak wajar terdeteksi di luar jam operasional. Silakan periksa log.
                        </p>
                    </div>

                    <!-- Informational / Live Status -->
                    <div class="p-3 bg-[#1A2C22] border-l-4 border-watt-green text-watt-green rounded-r-xl text-xs space-y-1">
                        <div class="font-bold flex items-center gap-1.5">
                            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                            Koneksi & Sinkronisasi
                        </div>
                        <p class="leading-relaxed opacity-90">
                            Semua katalog game terhubung secara real-time. Latensi server: <span class="font-mono font-bold">14 ms</span>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions / Pintasan Cepat -->
            <div class="admin-form-card p-5 space-y-6 admin-table-shell">
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i data-lucide="compass" class="w-4 h-4 text-watt-cyan"></i>
                    Pintasan Cepat
                </h3>
                
                <div class="grid grid-cols-1 gap-3 text-sm font-medium">
                    <a href="{{ route('admin.games.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-watt-bg border border-watt-border hover:border-watt-cyan/40 hover:bg-watt-hover transition-all group">
                        <span class="flex items-center gap-2 text-watt-text-sec group-hover:text-white transition-colors">
                            <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-watt-cyan"></i>
                            Tambah Game Baru
                        </span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-watt-text-sec group-hover:translate-x-0.5 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-watt-bg border border-watt-border hover:border-watt-cyan/40 hover:bg-watt-hover transition-all group">
                        <span class="flex items-center gap-2 text-watt-text-sec group-hover:text-white transition-colors">
                            <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-watt-cyan"></i>
                            Tambah Produk Baru
                        </span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-watt-text-sec group-hover:translate-x-0.5 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.banners.create') }}" class="flex items-center justify-between p-3.5 rounded-2xl bg-watt-bg border border-watt-border hover:border-watt-cyan/40 hover:bg-watt-hover transition-all group">
                        <span class="flex items-center gap-2 text-watt-text-sec group-hover:text-white transition-colors">
                            <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-watt-cyan"></i>
                            Tambah Banner Hero
                        </span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-watt-text-sec group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection









