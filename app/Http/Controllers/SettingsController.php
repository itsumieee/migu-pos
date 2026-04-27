<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        try {
            $validated = $request->validate([
                'store_name'    => 'required|string|max:255',
                'store_address' => 'nullable|string|max:500',
                'store_phone'   => 'nullable|string|max:20',
                'store_email'   => 'nullable|email|max:255',
                'tax_rate'      => 'nullable|numeric|min:0|max:100',
                'logo'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            foreach ($validated as $key => $value) {
                if ($key !== 'logo') Setting::set($key, $value);
            }

            if ($request->hasFile('logo')) {
                $old = Setting::get('store_logo');
                if ($old && Storage::disk('public')->exists($old)) Storage::disk('public')->delete($old);
                Setting::set('store_logo', $request->file('logo')->store('logos', 'public'));
            }

            return back()->with('success', 'Pengaturan umum berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Settings General Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function updateQris(Request $request)
    {
        try {
            $request->validate([
                'qris_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $old = Setting::get('qris_image');
            if ($old && Storage::disk('public')->exists($old)) Storage::disk('public')->delete($old);

            Setting::set('qris_image', $request->file('qris_image')->store('qris', 'public'));
            return back()->with('success', 'QR Code berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Settings QRIS Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal update QR: ' . $e->getMessage());
        }
    }

    public function updateSystem(Request $request)
    {
        try {
            $validated = $request->validate([
                'default_payment' => 'required|in:cash,debit,qris,ewallet',
                'auto_print' => 'nullable',
                'enable_notifications' => 'nullable',
            ]);

            Setting::set('default_payment', $validated['default_payment']);
            Setting::set('auto_print', isset($validated['auto_print']) ? '1' : '0');
            Setting::set('enable_notifications', isset($validated['enable_notifications']) ? '1' : '0');

            return back()->with('success', 'Pengaturan sistem berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Settings System Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan sistem: ' . $e->getMessage());
        }
    }

    public function updateEwallet(Request $request)
    {
        try {
            $validated = $request->validate([
                'ewallet_dana_number' => 'nullable|string|max:50',
                'ewallet_dana_description' => 'nullable|string|max:255',
                'ewallet_gopay_number' => 'nullable|string|max:50',
                'ewallet_gopay_description' => 'nullable|string|max:255',
                'ewallet_ovo_number' => 'nullable|string|max:50',
                'ewallet_ovo_description' => 'nullable|string|max:255',
                'ewallet_shopeepay_number' => 'nullable|string|max:50',
                'ewallet_shopeepay_description' => 'nullable|string|max:255',
            ]);

            foreach ($validated as $key => $value) {
                Setting::set($key, $value);
            }

            return back()->with('success', 'Pengaturan E-Wallet berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Settings E-Wallet Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
}