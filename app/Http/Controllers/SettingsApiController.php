<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsApiController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return response()->json(['success' => true, 'data' => $settings]);
    }

    public function show($key)
    {
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $setting]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:settings',
            'value' => 'nullable|string',
        ]);

        $setting = Setting::create($validated);
        return response()->json(['success' => true, 'data' => $setting], 201);
    }

    public function update(Request $request, $key)
    {
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
        }

        $validated = $request->validate([
            'value' => 'nullable|string',
        ]);

        $setting->update($validated);
        return response()->json(['success' => true, 'data' => $setting]);
    }

    public function destroy($key)
    {
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
        }
        $setting->delete();
        return response()->json(['success' => true, 'message' => 'Setting deleted successfully']);
    }
}
