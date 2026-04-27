<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $baseUrl;
    protected $apiKey;
    protected $ownerNumber;

    public function __construct()
    {
        $this->baseUrl = config('services.whatsapp.base_url', 'https://api.fonnte.com/send');
        $this->apiKey = config('services.whatsapp.api_key');
        $this->ownerNumber = config('services.whatsapp.owner_number');
    }

    // Method ini yang dipanggil oleh Command Report Otomatis
    public function send($phone, $message)
    {
        if (empty($this->apiKey)) {
            Log::warning('WhatsApp API key kosong. Cek file .env');
            return false;
        }

        $phone = $this->formatPhone($phone);
        Log::info("📤 Mengirim WA ke: {$phone}");

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
            ])->asForm()->post($this->baseUrl, [
                'target' => $phone,
                'message' => $message,
            ]);

            $data = $response->json();
            
            if ($response->successful() && isset($data['status']) && $data['status'] == true) {
                Log::info('✅ WhatsApp berhasil terkirim');
                return true;
            }

            Log::error('❌ Gagal kirim WA: ' . ($data['reason'] ?? $response->body()));
            return false;
        } catch (\Exception $e) {
            Log::error('❌ Error koneksi WA: ' . $e->getMessage());
            return false;
        }
    }

    // Method ini dipakai di ProductController & PosController untuk notif stok
    public function sendLowStockAlert($product)
    {
        $status = $product->stock == 0 ? '❌ STOK HABIS' : '⚠️ STOK MENIPIS';
        $msg = "🚨 *{$status} - MIGU STORE*\n\n";
        $msg .= "📦 Produk: *{$product->name}*\n";
        $msg .= "🏷️ SKU: `{$product->sku}`\n";
        $msg .= "📉 Sisa Stok: *{$product->stock} pcs*\n\n";
        $msg .= "👉 Segera lakukan restock!";

        return $this->send($this->ownerNumber, $msg);
    }

    protected function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            return '62' . substr($phone, 1);
        }
        return substr($phone, 0, 2) === '62' ? $phone : '62' . $phone;
    }
}