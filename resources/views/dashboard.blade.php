@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl gradient-primary p-6 lg:p-8 text-white shadow-2xl shadow-cyan-500/20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl lg:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-cyan-100 text-sm lg:text-base">Ini adalah ringkasan performa toko \App\Models\Setting::get('store_name', 'Migu POS') hari ini.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        @php
            $todaySales = number_format($stats['today_sales'] ?? 0, 0, ',', '.');
            $products = $stats['products'] ?? 0;
            $lowStock = $stats['low_stock'] ?? 0;
            $todayCount = $stats['today_count'] ?? 0;
            
            $cards = [
                ['title' => 'Total Produk', 'value' => $products, 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'cyan', 'change' => '+12%'],
                ['title' => 'Stok Menipis', 'value' => $lowStock, 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'color' => 'rose', 'change' => '-3%'],
                ['title' => 'Penjualan Hari Ini', 'value' => 'Rp ' . $todaySales, 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'emerald', 'change' => '+23%'],
                ['title' => 'Total Transaksi', 'value' => $todayCount . 'x', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'indigo', 'change' => '+8%']
            ];
        @endphp

        @foreach($cards as $c)
        <div class="group bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-soft hover:shadow-2xl hover:-translate-y-1 smooth relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $c['color'] }}-500/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 smooth"></div>
            
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">{{ $c['title'] }}</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $c['value'] }}</p>
                        <div class="flex items-center gap-1 mt-2">
                            <span class="flex items-center gap-0.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-full">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                {{ $c['change'] }}
                            </span>
                            <span class="text-xs text-slate-400 dark:text-slate-500">vs kemarin</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-{{ $c['color'] }}-50 dark:bg-{{ $c['color'] }}-900/30 flex items-center justify-center text-{{ $c['color'] }}-600 dark:text-{{ $c['color'] }}-400 group-hover:scale-110 smooth">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['icon'] }}"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Charts & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sales Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Grafik Penjualan</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Analisis penjualan 7 hari terakhir</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 rounded-xl bg-cyan-500 text-white text-xs font-semibold shadow-lg shadow-cyan-500/30">Minggu</button>
                    <button class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-medium hover:bg-slate-200 dark:hover:bg-slate-700 smooth">Bulan</button>
                    <button class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-medium hover:bg-slate-200 dark:hover:bg-slate-700 smooth">Tahun</button>
                </div>
            </div>
            <div class="p-6">
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="gradient-dark rounded-3xl p-6 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-cyan-500/20 rounded-full -mr-20 -mt-20 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-blue-500/20 rounded-full -ml-16 -mb-16 blur-xl"></div>
            
            <div class="relative z-10">
                <h3 class="text-lg font-bold mb-1">Quick Actions</h3>
                <p class="text-sm text-slate-300 mb-5">Akses cepat fitur penting</p>
                
                <div class="space-y-3">
                    <a href="{{ route('pos.index') }}" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/10 hover:bg-cyan-500 hover:text-black backdrop-blur-sm border border-white/10 hover:border-cyan-400 smooth group">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/20 group-hover:bg-black/10 flex items-center justify-center smooth">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold">Buka Kasir</p>
                            <p class="text-xs text-slate-300 group-hover:text-black/70">Mulai transaksi</p>
                        </div>
                        <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 group-hover:translate-x-1 smooth" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('products.index') }}" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/10 hover:bg-white hover:text-slate-900 backdrop-blur-sm border border-white/10 hover:border-white smooth group">
                        <div class="w-10 h-10 rounded-xl bg-white/10 group-hover:bg-slate-900/10 flex items-center justify-center smooth">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold">Kelola Produk</p>
                            <p class="text-xs text-slate-300 group-hover:text-slate-600">Tambah & edit</p>
                        </div>
                        <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 group-hover:translate-x-1 smooth" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('reports.sales') }}" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/10 hover:bg-white hover:text-slate-900 backdrop-blur-sm border border-white/10 hover:border-white smooth group">
                        <div class="w-10 h-10 rounded-xl bg-white/10 group-hover:bg-slate-900/10 flex items-center justify-center smooth">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold">Laporan</p>
                            <p class="text-xs text-slate-300 group-hover:text-slate-600">Analisis data</p>
                        </div>
                        <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 group-hover:translate-x-1 smooth" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Mini Stats -->
                <div class="mt-6 pt-6 border-t border-white/10 grid grid-cols-2 gap-3">
                    <div class="text-center p-3 rounded-2xl bg-white/5 backdrop-blur">
                        <p class="text-2xl font-bold text-cyan-400">98%</p>
                        <p class="text-xs text-slate-400 mt-1">Uptime</p>
                    </div>
                    <div class="text-center p-3 rounded-2xl bg-white/5 backdrop-blur">
                        <p class="text-2xl font-bold text-emerald-400">4.9</p>
                        <p class="text-xs text-slate-400 mt-1">Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Category Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aktivitas Terbaru</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Transaksi terkini</p>
                </div>
                <a href="{{ route('transactions.index') }}" class="text-sm font-semibold text-cyan-600 dark:text-cyan-400 hover:text-cyan-700">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800 max-h-96 overflow-y-auto scroll-custom">
                @forelse(\App\Models\Transaction::with('user')->latest()->limit(5)->get() as $transaction)
                <div class="px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 smooth flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center text-white shadow-lg shadow-cyan-500/30 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">Transaksi #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $transaction->created_at->diffForHumans() }} • {{ $transaction->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-900 dark:text-white">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">Selesai</p>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center text-slate-400">
                    <svg class="w-16 h-16 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-sm">Belum ada transaksi</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Category Performance -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Penjualan per Kategori</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Distribusi produk terlaris</p>
            </div>
            <div class="p-6">
                <canvas id="categoryChart" height="200"></canvas>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    @foreach(\App\Models\Category::withCount('products')->limit(4)->get() as $cat)
                    <div class="flex items-center gap-2 p-2 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                        <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
                        <span class="text-xs text-slate-600 dark:text-slate-400">{{ $cat->name }} ({{ $cat->products_count }})</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function dashboard() {
    return {
        salesChart: null,
        categoryChart: null,
        initCharts() {
            if (this.salesChart) this.salesChart.destroy();
            if (this.categoryChart) this.categoryChart.destroy();

            const isDark = document.documentElement.classList.contains('dark');
            const textColor = isDark ? '#94a3b8' : '#64748b';
            const gridColor = isDark ? '#334155' : '#e2e8f0';
            
            const salesCtx = document.getElementById('salesChart');
            if(salesCtx) {
                this.salesChart = new Chart(salesCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [{
                            label: 'Penjualan',
                            data: [1200000, 1900000, 1500000, 2200000, 1800000, 2800000, 2400000],
                            borderColor: '#06b6d4',
                            backgroundColor: 'rgba(6, 182, 212, 0.1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#06b6d4',
                            pointBorderColor: isDark ? '#1e293b' : '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#1e293b' : '#fff',
                                titleColor: isDark ? '#f1f5f9' : '#0f172a',
                                bodyColor: isDark ? '#cbd5e1' : '#475569',
                                borderColor: isDark ? '#334155' : '#e2e8f0',
                                borderWidth: 1,
                                padding: 12,
                                displayColors: false,
                                callbacks: { label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { color: textColor, callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'Jt', font: { size: 10 } },
                                grid: { color: gridColor, drawBorder: false }
                            },
                            x: { ticks: { color: textColor, font: { size: 10 } }, grid: { display: false, drawBorder: false } }
                        }
                    }
                });
            }

            const categoryCtx = document.getElementById('categoryChart');
            if(categoryCtx) {
                this.categoryChart = new Chart(categoryCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Kaos', 'Hoodie', 'Celana', 'Jaket', 'Aksesoris'],
                        datasets: [{
                            data: [35, 25, 20, 15, 5],
                            backgroundColor: ['#06b6d4', '#8b5cf6', '#10b981', '#f59e0b', '#ec4899'],
                            borderWidth: 0,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '70%',
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#1e293b' : '#fff',
                                titleColor: isDark ? '#f1f5f9' : '#0f172a',
                                bodyColor: isDark ? '#cbd5e1' : '#475569',
                                borderColor: isDark ? '#334155' : '#e2e8f0',
                                borderWidth: 1,
                                padding: 12,
                                titleFont: { size: 11 },
                                bodyFont: { size: 10 },
                                callbacks: { label: ctx => ctx.parsed + '%' }
                            }
                        }
                    }
                });
            }
        }
    }
}
window.dashboardInstance = dashboard();
document.addEventListener('theme-changed', () => setTimeout(() => window.dashboardInstance?.initCharts(), 150));
</script>
@endsection