<?php

namespace App\Console\Commands;

use App\Models\ReportSchedule;
use App\Models\Transaction;
use App\Services\WhatsAppService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendAutoReport extends Command
{
    protected $signature = 'report:auto';
    protected $description = 'Send automated sales report via WhatsApp';

    public function handle()
    {
        $this->info('🔍 Memeriksa database jadwal...');
        
        $schedules = \DB::table('report_schedules')->where('is_active', 1)->get();
        $this->info("📦 Ditemukan {$schedules->count()} jadwal aktif.");

        if ($schedules->isEmpty()) {
            $this->warn('⚠️ TABEL KOSONG! Pastikan Anda sudah menyimpan jadwal dengan status AKTIF.');
            return 0;
        }

        $now = now();
        $sentCount = 0;

        foreach ($schedules as $schedule) {
            $this->line("📅 [ID: {$schedule->id}] Nama: {$schedule->name} | Tipe: {$schedule->type} | Nilai: {$schedule->value}");

            $shouldSend = false;
            $lastSent = $schedule->last_sent_at ? Carbon::parse($schedule->last_sent_at) : now()->subDays(1);

            if ($schedule->type === 'interval') {
                $minutes = (int) $schedule->value;
                // FIX: Gunakan abs() agar tidak terpengaruh timezone negatif
                $diff = abs($now->diffInMinutes($lastSent));
                
                $this->line("   ⏱️ Interval: {$minutes} menit | Terakhir: {$lastSent->format('Y-m-d H:i:s')} | Selisih: {$diff} menit");
                
                if ($diff >= $minutes) {
                    $shouldSend = true;
                    $this->info("   ✅ Waktunya kirim! (Selisih {$diff} menit >= {$minutes} menit)");
                } else {
                    $this->warn("   ❌ Belum waktunya. Kurang " . ($minutes - $diff) . " menit lagi.");
                }
            } 
            elseif ($schedule->type === 'fixed') {
                $parts = explode(':', $schedule->value);
                $target = now()->setTime($parts[0], $parts[1] ?? 0);
                $isToday = !$lastSent || $lastSent->format('Y-m-d') !== $now->format('Y-m-d');
                
                if ($now >= $target && $isToday) {
                    $shouldSend = true;
                    $this->info("   ✅ Waktunya kirim! (Jam tercapai & belum dikirim hari ini)");
                } else {
                    $this->warn("   ❌ Belum waktunya atau sudah dikirim hari ini.");
                }
            }

            if ($shouldSend) {
                try {
                    $this->info("   📤 Memanggil WhatsApp Service...");
                    $stats = $this->getStats($lastSent);
                    $msg = $this->buildMessage($schedule->name, $stats, $schedule->type === 'interval');
                    $phone = $schedule->phone_override ?: config('services.whatsapp.owner_number');
                    
                    $wa = new WhatsAppService();
                    $result = $wa->send($phone, $msg);
                    
                    if ($result) {
                        \DB::table('report_schedules')->where('id', $schedule->id)->update([
                            'last_sent_at' => now()
                        ]);
                        $this->info("   ✅ SUKSES! Laporan terkirim ke {$phone}");
                        $sentCount++;
                    } else {
                        $this->error("   ❌ Gagal kirim (Cek log/laravel.log untuk detail API)");
                    }
                } catch (\Exception $e) {
                    $this->error("   ❌ Exception: " . $e->getMessage());
                }
            }
            $this->line("   --------------------------");
        }

        $this->info("🏁 Selesai. Total laporan terkirim: {$sentCount}");
        return 0;
    }

    protected function getStats(Carbon $lastSent)
    {
        $query = Transaction::where('created_at', '>', $lastSent);
        $revenue = $query->sum('total_amount');
        $count = $query->count();
        
        $profit = 0;
        $query->with('transactionItems')->get()->each(function($trx) use (&$profit) {
            $profit += $trx->transactionItems->sum('profit');
        });

        return [
            'revenue' => $revenue,
            'count' => $count,
            'profit' => $profit,
            'period' => $lastSent->format('d M H:i') . ' s/d Sekarang'
        ];
    }

    protected function buildMessage($name, $stats, $isInterval)
    {
        return "📊 *LAPORAN OTOMATIS - MIGU STORE*\n" .
               "📌 Jadwal: *{$name}*\n" .
               "🕒 Periode: {$stats['period']}\n\n" .
               "🛒 Transaksi: {$stats['count']}\n" .
               "💰 Pendapatan: Rp " . number_format($stats['revenue'], 0, ',', '.') . "\n" .
               "💵 Laba Bersih: Rp " . number_format($stats['profit'], 0, ',', '.') . "\n\n" .
               ($isInterval ? "🔄 Laporan berikutnya sesuai interval." : "⏰ Laporan besok akan dikirim ulang.");
    }
}