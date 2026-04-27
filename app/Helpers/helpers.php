<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get a setting value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null) {
        $setting = \App\Models\Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}

if (!function_exists('setSetting')) {
    /**
     * Set a setting value
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    function setSetting($key, $value) {
        Setting::set($key, $value);
    }
}

if (!function_exists('imageUrl')) {
    /**
     * Get proper image URL - checks if it's already a full URL or local path
     *
     * @param string|null $path
     * @return string|null
     */
    function imageUrl($path) {
        if (!$path) return null;
        
        // If already a full URL (starts with http:// or https://), return as is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        
        // Otherwise treat as local storage path
        return asset('storage/' . $path);
    }
}
