<?php

namespace App\Http\Controllers;

use App\Models\ReportSchedule;
use Illuminate\Http\Request;

class ReportScheduleController extends Controller
{
    public function index()
    {
        $schedules = ReportSchedule::latest()->get();
        return view('settings.report-schedules', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:interval,fixed',
            'value_interval' => 'nullable|numeric|min:1',
            'value_fixed' => 'nullable|string',
            'phone_override' => 'nullable|string|max:20',
        ]);

        // Handle checkbox is_active
        $isActive = $request->has('is_active');

        $finalValue = $validated['type'] === 'interval' 
            ? $validated['value_interval'] 
            : $validated['value_fixed'];

        if (!$finalValue) {
            return back()->withInput()->with('error', 'Isi interval (menit) atau waktu (jam:menit) terlebih dahulu!');
        }

        ReportSchedule::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'value' => $finalValue,
            'phone_override' => $validated['phone_override'] ?: null,
            'is_active' => $isActive, // Convert ke boolean
        ]);

        return redirect()->back()->with('success', '✅ Jadwal laporan berhasil ditambahkan!');
    }

    public function update(Request $request, ReportSchedule $schedule)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:interval,fixed',
            'value_interval' => 'nullable|numeric|min:1',
            'value_fixed' => 'nullable|string',
            'phone_override' => 'nullable|string|max:20',
        ]);

        // Handle checkbox is_active
        $isActive = $request->has('is_active');

        $finalValue = $validated['type'] === 'interval' 
            ? $validated['value_interval'] 
            : $validated['value_fixed'];

        $schedule->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'value' => $finalValue,
            'phone_override' => $validated['phone_override'] ?: null,
            'is_active' => $isActive, // Convert ke boolean
        ]);

        return redirect()->back()->with('success', '✅ Jadwal laporan berhasil diperbarui!');
    }

    public function destroy(ReportSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', '🗑️ Jadwal laporan dihapus.');
    }
}