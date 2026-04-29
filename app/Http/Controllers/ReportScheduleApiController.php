<?php

namespace App\Http\Controllers;

use App\Models\ReportSchedule;
use Illuminate\Http\Request;

class ReportScheduleApiController extends Controller
{
    public function index()
    {
        $schedules = ReportSchedule::latest()->get();
        return response()->json(['success' => true, 'data' => $schedules]);
    }

    public function show($id)
    {
        $schedule = ReportSchedule::find($id);
        if (!$schedule) {
            return response()->json(['success' => false, 'message' => 'Schedule not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $schedule]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:interval,fixed',
            'value_interval' => 'nullable|numeric|min:1',
            'value_fixed' => 'nullable|string',
            'phone_override' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        $finalValue = $validated['type'] === 'interval' 
            ? $validated['value_interval'] 
            : $validated['value_fixed'];

        if (!$finalValue) {
            return response()->json(['success' => false, 'message' => 'Interval or fixed time must be provided'], 400);
        }

        $schedule = ReportSchedule::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'value' => $finalValue,
            'phone_override' => $validated['phone_override'] ?? null,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return response()->json(['success' => true, 'data' => $schedule], 201);
    }

    public function update(Request $request, $id)
    {
        $schedule = ReportSchedule::find($id);
        if (!$schedule) {
            return response()->json(['success' => false, 'message' => 'Schedule not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:100',
            'type' => 'in:interval,fixed',
            'value_interval' => 'nullable|numeric|min:1',
            'value_fixed' => 'nullable|string',
            'phone_override' => 'nullable|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        if (isset($validated['type'])) {
            $finalValue = $validated['type'] === 'interval' 
                ? $validated['value_interval'] 
                : $validated['value_fixed'];
            $schedule->update([
                'type' => $validated['type'],
                'value' => $finalValue,
            ]);
        }

        if (isset($validated['name'])) $schedule->name = $validated['name'];
        if (isset($validated['phone_override'])) $schedule->phone_override = $validated['phone_override'];
        if (isset($validated['is_active'])) $schedule->is_active = $validated['is_active'];
        
        $schedule->save();

        return response()->json(['success' => true, 'data' => $schedule]);
    }

    public function destroy($id)
    {
        $schedule = ReportSchedule::find($id);
        if (!$schedule) {
            return response()->json(['success' => false, 'message' => 'Schedule not found'], 404);
        }
        $schedule->delete();
        return response()->json(['success' => true, 'message' => 'Schedule deleted successfully']);
    }
}
