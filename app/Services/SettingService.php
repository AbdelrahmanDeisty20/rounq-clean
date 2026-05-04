<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }
        return $setting->value;
    }

    public function set($key, $value)
    {
        return Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function updateHomeSettings(array $data)
    {
        return $this->set('homeSettings', $data);
    }

    public function updateContactSettings(array $data)
    {
        return $this->set('contactSettings', $data);
    }
}
